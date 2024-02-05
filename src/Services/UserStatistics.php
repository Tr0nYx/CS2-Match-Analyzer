<?php

namespace App\Services;

use App\Entity\User;
use App\Entity\UserAchievements;
use App\Entity\UserStatistic;
use Doctrine\ORM\EntityManagerInterface;
use Steam\Command\User\GetPlayerSummaries;
use Steam\Command\UserStats\GetPlayerAchievements;
use Steam\Command\UserStats\GetUserStatsForGame;
use Steam\Steam;

/**
 * Class UserStatistics
 * @package App\Services
 */
readonly class UserStatistics
{
    /**
     * UserStatistics constructor.
     * @param Steam $steam
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(private Steam $steam, private EntityManagerInterface $entityManager)
    {
    }

    /**
     * @param User $user
     * @throws \Exception
     */
    public function getSingleUserSummary(User $user): void
    {
        $this->getUserSummary([$user->getSteamId()]);
    }

    /**
     * @param array $steamids
     * @throws \Exception
     */
    public function getUserSummary(array $steamids): void
    {
        $summaryRequest = $this->steam->run(new GetPlayerSummaries($steamids));
        if (null === $summaryRequest) {
            return;
        }
        /*foreach ($steamids as $steamid) {
            if (!in_array($steamid, $summaryRequest["response"]["players"], true)) {
                if ($user = $this->entityManager->getRepository(User::class)->findOneBy(['steamId' => $steamid]
                )) {
                    $this->entityManager->remove($user);
                    $this->entityManager->flush();
                }
            }
        }*/

        foreach ($summaryRequest["response"]["players"] as $player) {
            if (!$user = $this->entityManager->getRepository(User::class)->findOneBy(
                ['steamId' => $player["steamid"]]
            )) {
                $user = new User($player["steamid"]);
            }
            $user->setSteamusername($player["personaname"]);
            $user->setAvatar($player["avatarfull"]);
            if (isset($player["lastlogoff"])) {
                $lastlogoff = new \DateTimeImmutable();
                $lastlogoff = $lastlogoff->setTimestamp($player["lastlogoff"]);
                $user->setLastlogoff($lastlogoff);
            }
            $user->setCommunityvisibilitystate($player["communityvisibilitystate"]);
            $user->setPersonastate($player["personastate"]);

            $user->setProfileurl($player["profileurl"]);
            if ($player["communityvisibilitystate"] == 3) {
                $timecreated = new \DateTimeImmutable();
                $timecreated = $timecreated->setTimestamp($player["timecreated"]);
                $user->setTimecreated($timecreated);
            }
            $this->entityManager->persist($user);
            $this->entityManager->flush();
        }
    }

    /**
     * @param User $user
     * @param int $appid
     * @return array
     * @throws \Exception
     */
    public function getStats(User $user, int $appid = 730)
    {
        $statistics = $this->getStatsForGame($user, $appid);
        $achievements = $this->getAchievementsForGame($user, $appid);

        return ['statistics' => $statistics, 'achievements' => $achievements];
    }

    private function getStatsForGame(User $user, $appid): array|UserStatistic
    {
        $statistics = [];
        $userstats = new GetUserStatsForGame($user->getSteamId(), $appid);
        $stats = $this->steam->run($userstats);

        if (!empty($stats)) {
            /** @var UserStatistic $statistics */
            if (!$statistics = $this->entityManager->getRepository(UserStatistic::class)->findOneBy(
                ['user' => $user]
            )) {
                $statistics = new UserStatistic();
                $statistics->setUser($user);
            }
            if ($user->getSteamId() == "76561198885433313") {
                dd($stats);
            }
            foreach ($stats["playerstats"]["stats"] as $stat) {
                $method = 'set'.$this->dashesToCamelCase($stat['name']);
                if (method_exists(UserStatistic::class, $method)) {
                    $statistics->$method($stat['value']);
                }
            }
            $this->entityManager->persist($statistics);
            $this->entityManager->flush();
        }

        return $statistics;
    }

    /**
     * @param User $user
     * @param $appid
     * @return UserAchievements|null
     */
    private function getAchievementsForGame(User $user, $appid): ?UserAchievements
    {
        $playerAchievementRequest = new GetPlayerAchievements($user->getSteamId(), $appid);
        $playerAchievementRequest->setLanguage('german');
        $achievementRequest = $this->steam->run($playerAchievementRequest);
        if (!$achievementRequest["playerstats"]["success"]) {
            $user->setPersonastate(0);
            $this->entityManager->persist($user);
            $this->entityManager->flush();

            return null;
        }
        /** @var UserAchievements $achievements */
        if (!$achievements = $this->entityManager->getRepository(UserAchievements::class)->findOneBy(
            ['user' => $user]
        )) {
            $achievements = new UserAchievements();
            $achievements->setUser($user);
        }
        foreach ($achievementRequest["playerstats"]["achievements"] as $stat) {
            $method = 'set'.$this->dashesToCamelCase($stat['apiname']);
            if (method_exists(UserAchievements::class, $method)) {
                $date = new \DateTimeImmutable();
                $date = $date->setTimestamp($stat['unlocktime']);
                $achievements->$method($date);
                /*echo '/**<br>';
                echo ' * @var int<br>';
                echo ' * @ORM\Column(type="integer")<br>';
                echo ' *-/<br>';
                echo 'private $'.$stat['name'].' = 0;<br><br>';
                */
            }
        }
        $this->entityManager->persist($achievements);
        $this->entityManager->flush();

        return $achievements;
    }

    /**
     * @param $string
     * @return string|string[]
     */
    private function dashesToCamelCase($string): array|string
    {
        $str = str_replace('_', '', ucwords($string, '_'));

        return ucfirst($str);
    }
}
