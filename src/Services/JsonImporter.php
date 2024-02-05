<?php

namespace App\Services;

use App\Entity\Matches;
use App\Entity\MatchUserScoreboard;
use App\Entity\User;
use App\Entity\UserMatchAccuracyWeapons;
use App\Entity\UserMatchDamageWeapons;
use App\Entity\UserMatchHeadshotsWeapons;
use App\Entity\UserMatchHitsWeapons;
use App\Entity\UserMatchKillsWeapons;
use App\Entity\UserMatchShotsWeapons;
use App\Entity\UserStatHistory;
use App\Message\UserUpdated;
use App\Repository\MatchUserScoreboardRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;
use Symfony\Component\Messenger\MessageBusInterface;

class JsonImporter
{
    public const AVERAGE_KPR = 0.679; // average kills per round
    public const AVERAGE_SPR = 0.317; // average survived rounds per round
    public const AVERAGE_RMK = 1.277; // average value calculated from rounds with multiple kills

    // HTLV2 rating variables https://flashed.gg/posts/reverse-engineering-hltv-rating/
    public const HLTV2_KAST_MOD = 0.0073; // KAST modifier
    public const HLTV2_KPR_MOD = 0.3591; // KPR modifier
    public const HLTV2_DPR_MOD = -0.5329; // DPR modifier
    public const HLTV2_IMPACT_MOD = 0.2372; // Impact modifier
    public const HLTV2_IMPACT_KPR_MOD = 2.13; //Impact KPR modifier
    public const HLTV2_IMPACT_APR_MOD = 0.42; //Impact AssistPerRound modifier
    public const HLTV2_IMPACT_OFFSET_MOD = -0.41; //Impact base modifier
    public const HLTV2_ADR_MOD = 0.0032; // ADR modifier
    public const HLTV2_OFFSET_MOD = 0.1587; // HLTV2 base modifier

    /**
     * @var string
     */
    protected string $matchesDir;

    /**
     * @var string
     */
    protected string $currentMatchesDir;

    /**
     * @var string
     */
    protected string $matchId;

    /**
     * @var Matches
     */
    private Matches $match;

    /**
     * @var User|null
     */
    private ?User $user;


    /**
     * JsonImporter constructor.
     * @param EntityManagerInterface $entityManager
     * @param MessageBusInterface $bus
     * @param string $matchesDir
     */
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly MessageBusInterface $bus,
        string $matchesDir
    ) {
        $this->matchesDir = $matchesDir;
    }

    /**
     * @param string $matchId
     */
    public function run(string $matchId): void
    {
        $this->matchId = $matchId;
        $this->currentMatchesDir = $this->matchesDir.$this->matchId;
        $this->importMatchFiles();
    }

    public function importMatchFiles(): void
    {
        $finder = new Finder();
        $finder->in($this->currentMatchesDir)->ignoreDotFiles(true)->name('*.json');
        foreach ($finder as $file) {
            $type = $file->getBasename('.'.$file->getExtension());
            switch ($type) {
                case 'stats':
                    $this->importMatch($file);
                    $this->importStats($file);
                    //$this->importRounds($file);
                    break;
            }
            if (is_dir($this->currentMatchesDir)) {
                $this->recursiveRemove($this->currentMatchesDir);
            }
        }
    }

    /**
     * @param SplFileInfo $file
     * @throws \Exception
     */
    private function importMatch(SplFileInfo $file): void
    {
        $json = json_decode($file->getContents());
        $this->match = $this->entityManager->getRepository(Matches::class)->find($this->matchId);
        //$this->match->setTickrate($json->general->tick_rate);
        $this->match->setMap($json->general->map_name);
        $interval = $this->secondsToTime((int)$json->general->match_duration);
        $this->match->setLength($interval);
        $this->match->setTeamOne($json->general->score_team_one);
        $this->match->setTeamTwo($json->general->score_team_two);
        $this->match->setTotalRounds($json->general->totalRounds);
        $this->entityManager->persist($this->match);
        $this->entityManager->flush();

        //unlink($file->getPathname());
    }

    /**
     * @param $seconds
     * @return \DateInterval|false
     * @throws \Exception
     */
    private function secondsToTime($seconds): \DateInterval|false
    {
        $dtF = new \DateTime("@0");
        $dtT = new \DateTime("@$seconds");

        return $dtF->diff($dtT);
    }

    /**
     * @param SplFileInfo $file
     */
    private function importStats(SplFileInfo $file): void
    {
        $json = json_decode($file->getContents());

        /** @var Matches $match */
        $this->match = $this->entityManager->getRepository(Matches::class)->find($this->matchId);
        foreach ($json->players as $player) {
            if ($player->steamid64 == "0") {
                continue;
            }
            if (!$this->user = $this->entityManager->getRepository(User::class)->findOneBy(
                ['steamId' => $player->steamid64]
            )) {
                $this->user = new User($player->steamid64);
                $this->entityManager->persist($this->user);
                $this->entityManager->flush();
                $userUpdated = new UserUpdated($this->user->getId());
                $this->bus->dispatch($userUpdated);
            }
            $this->user->setSteamusername($player->userName);
            $this->entityManager->persist($this->user);
            $this->entityManager->flush();
            $this->importMatchScoreBoard($player);
            $this->importWeaponKills($player);
            $this->importWeaponHeadshots($player);
            $this->importWeaponAccuracy($player);
            $this->importWeaponDamage($player);
            $this->importWeaponShots($player);
            $this->importWeaponHits($player);
        }
    }

    private function importMatchScoreBoard($player): void
    {

        /** @var MatchUserScoreboard $matchUser */
        if (!$matchUser = $this->entityManager->getRepository(MatchUserScoreboard::class)->findOneBy(
            ['matches' => $this->match, 'user' => $this->user]
        )) {
            $matchUser = new MatchUserScoreboard();
        }
        $damage = $player->damage;

        $hltv = $this->computeHltvOrgRating(
            $this->match->getTeamOne() + $this->match->getTeamTwo(),
            $player->kills,
            $player->deaths,
            [$player->rounds1k, $player->rounds2k, $player->rounds3k, $player->rounds4k, $player->rounds5k]
        );
        $hltv2 = $this->computeHltvTwoRating($player);
        $matchUser->setUser($this->user);
        $matchUser->setMatches($this->match);
        $matchUser->setAdr($player->adr);
        $matchUser->setDamage($damage);
        $matchUser->setKills($player->kills);
        $matchUser->setDeaths($player->deaths);
        $matchUser->setAssists($player->assists);
        $matchUser->setRank($player->rank);
        $matchUser->setOldRank($player->rankold);
        if ($player->deaths == 0) {
            $kd = $player->kills / 1;
        } else {
            $kd = $player->kills / $player->deaths;
        }
        $matchUser->setKd($kd);
        $matchUser->setMvps($player->mvps);
        $matchUser->setHspercent($player->hspercent);
        $matchUser->setHs($player->headshots);
        $matchUser->setFirstkills($player->firstkills);
        $matchUser->setFirstdeaths($player->firstdeaths);
        $matchUser->setTradekills($player->tradekills);
        $matchUser->setTradedeaths($player->tradedeaths);
        $matchUser->setTradefirstkills($player->tradefirstkills);
        $matchUser->setTradefirstdeaths($player->tradefirstdeaths);
        $matchUser->setRoundswonv5($player->roundswonv5);
        $matchUser->setRoundswonv4($player->roundswonv4);
        $matchUser->setRoundswonv3($player->roundswonv3);
        $matchUser->setRoundswonv2($player->roundswonv2);
        $matchUser->setRoundswonv1($player->roundswonv1);
        $matchUser->setRoundslostv1($player->roundslostv1);
        $matchUser->setRoundslostv2($player->roundslostv2);
        $matchUser->setRoundslostv3($player->roundslostv3);
        $matchUser->setRoundslostv4($player->roundslostv4);
        $matchUser->setRoundslostv5($player->roundslostv5);
        $matchUser->setRounds5k($player->rounds5k);
        $matchUser->setRounds4k($player->rounds4k);
        $matchUser->setRounds3k($player->rounds3k);
        $matchUser->setRounds2k($player->rounds2k);
        $matchUser->setRounds1k($player->rounds1k);
        $matchUser->setHltvrating($hltv);
        $matchUser->setHltv2rating($hltv2);
        $matchUser->setClantag($player->clantag);
        $matchUser->setSide($player->team);
        $matchUser->setKillBlinded($player->KillBlinded);
        $matchUser->setKillWallbang($player->KillWallbang);
        $matchUser->setKillSmoke($player->KillThruSmoke);
        $matchUser->setKillNoScope($player->NoScope);
        $this->entityManager->persist($matchUser);
        $this->entityManager->flush();
        $this->addHistory($this->user);
    }

    private function importRounds(SplFileInfo $file)
    {
        $json = json_decode($file->getContents());
        $rounds = $json->rounds;
        foreach ($rounds as $round) {
            $killsClan = $round->kills_clan ? count($round->kills_clan) : null;
            $killsEnemy = $round->kills_enemy ? count($round->kills_enemy) : null;

            foreach ($round->kills_enemy as $killed) {
                dump($killed->killer->team);
            }

        }
        dd();
    }

    private function addHistory(User $user): void
    {
        /** @var MatchUserScoreboardRepository $rMatches */
        $rMatches = $this->entityManager->getRepository(MatchUserScoreboard::class);
        $matches = $rMatches->findBy(['user' => $user]);
        if (empty($matches)) {
            return;
        }
        $count = count($matches);
        $adr = 0;
        $hltv = 0;
        $hltv2 = 0;
        $kd = 0;
        $hs = 0;
        $hspercent = 0;
        $kills = 0;
        $deaths = 0;
        $assists = 0;
        $mvps = 0;
        foreach ($matches as $match) {
            $adr += $match->getAdr();
            $hltv += $match->getHltvrating();
            $hltv2 += $match->getHltv2rating();
            $kd += $match->getKd();
            $hs += $match->getHs();
            $hspercent += $match->getHspercent();
            $kills += $match->getKills();
            $deaths += $match->getDeaths();
            $assists += $match->getDeaths();
            $mvps += $match->getMvps();
        }
        $userstathistory = new UserStatHistory();
        $userstathistory->setUser($user);
        $userstathistory->setAdr($adr / $count);
        $userstathistory->setHltvrating($hltv / $count);
        $userstathistory->setHltv2rating($hltv2 / $count);
        $userstathistory->setKd($kd / $count);
        $userstathistory->setKills($kills / $count);
        $userstathistory->setDeaths($deaths / $count);
        $userstathistory->setAssists($assists / $count);
        $userstathistory->setHs($hs / $count);
        $userstathistory->setHspercent($hspercent / $count);
        $userstathistory->setMvps($mvps / $count);
        $userstathistory->setMatchTime($this->match->getMatchTime());
        $this->entityManager->persist($userstathistory);
        $this->entityManager->flush();
    }

    /**
     * @param int $roundCount
     * @param int $kills
     * @param int $deaths
     * @param array $nKills
     * @return false|float
     */
    private function computeHltvOrgRating(
        int $roundCount,
        int $kills,
        int $deaths,
        array $nKills
    ): float|false {
        // Kills/Rounds/AverageKPR
        $killRating = $kills / $roundCount / self::AVERAGE_KPR;
        // (Rounds-Deaths)/Rounds/AverageSPR
        $survivalRating = ($roundCount - $deaths) / $roundCount / self::AVERAGE_SPR;
        // (1K + 4*2K + 9*3K + 16*4K + 25*5K)/Rounds/AverageRMK
        $roundsWithMultipleKillsRating = ($nKills[0] + 4 * $nKills[1] + 9 * $nKills[2] + 16 * $nKills[3] + 25 * $nKills[4]) / $roundCount / self::AVERAGE_RMK;

        return round(($killRating + 0.7 * $survivalRating + $roundsWithMultipleKillsRating) / 2.7, 3);
    }

    /**
     * https://flashed.gg/posts/reverse-engineering-hltv-rating/
     */
    private function computeHltvTwoRating($player): float|false
    {
        //0.0073*KAST + 0.3591*KPR + -0.5329*DPR + 0.2372*Impact + 0.0032*ADR + 0.1587 = Rating 2.0
        //KAST: Percentage of rounds in which the player either had a kill, assist, survived or was traded.
        //KPR / Kill Rating: kills per round.
        //DPR / Survival Rating: deaths per round.
        //Impact: measures the impact made from multikills, opening kills, and clutches.
        // 2.13*KPR + 0.42*Assist per Round -0.41 ≈ Impact
        //ADR / Damage Rating: average damage per round.

        $rounds = $this->match->getTotalRounds();
        $killPerRound = $player->kills / $rounds;
        $assistPerRound = $player->assists / $rounds;
        $KAST = self::HLTV2_KAST_MOD * (($player->kastRounds / $rounds) * 100);
        $KPR = self::HLTV2_KPR_MOD * $killPerRound;
        $DPR = self::HLTV2_DPR_MOD * ($player->deaths / $rounds);
        $ADR = self::HLTV2_ADR_MOD * $player->adr;
        $Impact = self::HLTV2_IMPACT_MOD * ((self::HLTV2_IMPACT_KPR_MOD * $killPerRound) + (self::HLTV2_IMPACT_APR_MOD * $assistPerRound) + self::HLTV2_IMPACT_OFFSET_MOD);
        $HLTV2 = $KAST + $KPR + $DPR + $Impact + $ADR + self::HLTV2_OFFSET_MOD;

        return round($HLTV2, 3);
    }


    private function recursiveRemove($dir): void
    {
        $structure = glob(rtrim($dir, "/").'/*');
        if (is_array($structure)) {
            foreach ($structure as $file) {
                if (is_dir($file)) {
                    $this->recursiveRemove($file);
                } elseif (is_file($file)) {
                    unlink($file);
                }
            }
        }
        rmdir($dir);
    }

    private function importWeaponKills($player): void
    {
        foreach ($player->weapon_stats->kills as $weapon => $kills) {

            /** @var UserMatchKillsWeapons $usermatchkillsweapons */
            if (!$usermatchkillsweapons = $this->entityManager->getRepository(UserMatchKillsWeapons::class)->findOneBy(
                ['match' => $this->match, 'user' => $this->user, 'weapon' => $weapon]
            )) {
                $usermatchkillsweapons = new UserMatchKillsWeapons();
            }
            $usermatchkillsweapons->setWeapon($weapon);
            $usermatchkillsweapons->setValue($kills);
            $usermatchkillsweapons->setUser($this->user);
            $usermatchkillsweapons->setMatch($this->match);

            $this->entityManager->persist($usermatchkillsweapons);
            $this->entityManager->flush();
        }
    }

    private function importWeaponHeadshots($player): void
    {
        foreach ($player->weapon_stats->headshots as $weapon => $headshots) {

            /** @var UserMatchHeadshotsWeapons $usermatchheadshotsweapons */
            if (!$usermatchheadshotsweapons = $this->entityManager->getRepository(
                UserMatchHeadshotsWeapons::class
            )->findOneBy(
                ['match' => $this->match, 'user' => $this->user, 'weapon' => $weapon]
            )) {
                $usermatchheadshotsweapons = new UserMatchHeadshotsWeapons();
            }
            $usermatchheadshotsweapons->setWeapon($weapon);
            $usermatchheadshotsweapons->setValue($headshots);
            $usermatchheadshotsweapons->setUser($this->user);
            $usermatchheadshotsweapons->setMatch($this->match);

            $this->entityManager->persist($usermatchheadshotsweapons);
            $this->entityManager->flush();
        }
    }

    private function importWeaponAccuracy($player): void
    {
        foreach ($player->weapon_stats->accuracy as $weapon => $accuracy) {

            /** @var UserMatchAccuracyWeapons $usermatchaccuracyweapons */
            if (!$usermatchaccuracyweapons = $this->entityManager->getRepository(
                UserMatchAccuracyWeapons::class
            )->findOneBy(
                ['match' => $this->match, 'user' => $this->user, 'weapon' => $weapon]
            )) {
                $usermatchaccuracyweapons = new UserMatchAccuracyWeapons();
            }
            $usermatchaccuracyweapons->setWeapon($weapon);
            $usermatchaccuracyweapons->setValue($accuracy);
            $usermatchaccuracyweapons->setUser($this->user);
            $usermatchaccuracyweapons->setMatch($this->match);

            $this->entityManager->persist($usermatchaccuracyweapons);
            $this->entityManager->flush();
        }
    }

    private function importWeaponDamage($player): void
    {
        foreach ($player->weapon_stats->damage as $weapon => $damage) {

            /** @var UserMatchDamageWeapons $usermatchdamageweapons */
            if (!$usermatchdamageweapons = $this->entityManager->getRepository(
                UserMatchDamageWeapons::class
            )->findOneBy(
                ['match' => $this->match, 'user' => $this->user, 'weapon' => $weapon]
            )) {
                $usermatchdamageweapons = new UserMatchDamageWeapons();
            }
            $usermatchdamageweapons->setWeapon($weapon);
            $usermatchdamageweapons->setValue($damage);
            $usermatchdamageweapons->setUser($this->user);
            $usermatchdamageweapons->setMatch($this->match);

            $this->entityManager->persist($usermatchdamageweapons);
            $this->entityManager->flush();
        }
    }

    private function importWeaponShots($player): void
    {
        foreach ($player->weapon_stats->shots as $weapon => $shots) {

            /** @var UserMatchShotsWeapons $usermatchshotsweapons */
            if (!$usermatchshotsweapons = $this->entityManager->getRepository(UserMatchShotsWeapons::class)->findOneBy(
                ['match' => $this->match, 'user' => $this->user, 'weapon' => $weapon]
            )) {
                $usermatchshotsweapons = new UserMatchShotsWeapons();
            }
            $usermatchshotsweapons->setWeapon($weapon);
            $usermatchshotsweapons->setValue($shots);
            $usermatchshotsweapons->setUser($this->user);
            $usermatchshotsweapons->setMatch($this->match);

            $this->entityManager->persist($usermatchshotsweapons);
            $this->entityManager->flush();
        }
    }

    private function importWeaponHits($player): void
    {
        foreach ($player->weapon_stats->hits as $weapon => $hits) {

            /** @var UserMatchHitsWeapons $usermatchhitsweapons */
            if (!$usermatchhitsweapons = $this->entityManager->getRepository(UserMatchHitsWeapons::class)->findOneBy(
                ['match' => $this->match, 'user' => $this->user, 'weapon' => $weapon]
            )) {
                $usermatchhitsweapons = new UserMatchHitsWeapons();
            }
            $usermatchhitsweapons->setWeapon($weapon);
            $usermatchhitsweapons->setValue($hits);
            $usermatchhitsweapons->setUser($this->user);
            $usermatchhitsweapons->setMatch($this->match);

            $this->entityManager->persist($usermatchhitsweapons);
            $this->entityManager->flush();
        }
    }
}
