<?php


namespace App\Entity;


use App\Entity\Traits\IdTrait;
use App\Entity\Traits\UserStatTrait;
use App\Repository\MatchUserScoreboardRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Class Match
 * @package App\Entity
 */
#[UniqueEntity(fields: ['user_id', 'matches_id'])]
#[ORM\Table(name: 'match_user_scoreboard')]
#[ORM\Entity(repositoryClass: MatchUserScoreboardRepository::class, readOnly: false)]
#[ORM\Index(columns: ['hltvrating', 'rank', 'side'], name: 'matchtime_idx')]
#[ORM\UniqueConstraint(name: 'IDX_USER_MATCH', columns: ['user_id', 'matches_id'])]
#[Gedmo\Loggable]
#[ORM\Cache('NONSTRICT_READ_WRITE')]
class MatchUserScoreboard
{
    use IdTrait;
    use UserStatTrait;

    #[ORM\ManyToOne(inversedBy: 'MatchUserScoreboard')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Matches $matches = null;

    #[ORM\Column(type: Types::INTEGER)]
    private int $rank = 0;

    #[ORM\Column(type: Types::INTEGER)]
    private int $oldRank = 0;

    #[ORM\Column(type: Types::INTEGER)]
    private int $firstkills = 0;

    #[ORM\Column(type: Types::INTEGER)]
    private int $firstdeaths = 0;

    #[ORM\Column(type: Types::INTEGER)]
    private int $tradekills = 0;

    #[ORM\Column(type: Types::INTEGER)]
    private int $tradedeaths = 0;

    #[ORM\Column(type: Types::INTEGER)]
    private int $tradefirstkills = 0;

    #[ORM\Column(type: Types::INTEGER)]
    private int $tradefirstdeaths = 0;

    #[ORM\Column(type: Types::INTEGER)]
    private int $roundswonv5 = 0;

    #[ORM\Column(type: Types::INTEGER)]
    private int $roundswonv4 = 0;

    #[ORM\Column(type: Types::INTEGER)]
    private int $roundswonv3 = 0;

    #[ORM\Column(type: Types::INTEGER)]
    private int $roundswonv2 = 0;

    #[ORM\Column(type: Types::INTEGER)]
    private int $roundswonv1 = 0;

    #[ORM\Column(type: Types::INTEGER)]
    private int $rounds5k = 0;

    #[ORM\Column(type: Types::INTEGER)]
    private int $rounds4k = 0;

    #[ORM\Column(type: Types::INTEGER)]
    private int $rounds3k = 0;

    #[ORM\Column(type: Types::INTEGER)]
    private int $rounds2k = 0;

    #[ORM\Column(type: Types::INTEGER)]
    private int $rounds1k = 0;

    #[ORM\Column(type: Types::INTEGER)]
    private int $damage = 0;

    #[ORM\Column(type: Types::INTEGER)]
    private int $side = 0;

    #[ORM\Column(type: Types::STRING)]
    private string $clantag = '';

    #[ORM\Column(type: Types::INTEGER)]
    private int $killBlinded = 0;

    #[ORM\Column(type: Types::INTEGER)]
    private int $killWallbang = 0;

    #[ORM\Column(type: Types::INTEGER)]
    private int $killSmoke = 0;

    #[ORM\Column(type: Types::INTEGER)]
    private int $killNoScope = 0;

    #[ORM\Column]
    private ?int $roundslostv1 = null;

    #[ORM\Column]
    private ?int $roundslostv2 = null;

    #[ORM\Column]
    private ?int $roundslostv3 = null;

    #[ORM\Column]
    private ?int $roundslostv4 = null;

    #[ORM\Column]
    private ?int $roundslostv5 = null;

    public function __construct()
    {
    }

    public function getRank(): int
    {
        return $this->rank;
    }

    public function setRank(int $rank): void
    {
        $this->rank = $rank;
    }

    public function getOldRank(): int
    {
        return $this->oldRank;
    }

    public function setOldRank(int $oldRank): void
    {
        $this->oldRank = $oldRank;
    }

    public function getFirstkills(): int
    {
        return $this->firstkills;
    }

    public function setFirstkills(int $firstkills): void
    {
        $this->firstkills = $firstkills;
    }

    public function getFirstdeaths(): int
    {
        return $this->firstdeaths;
    }

    public function setFirstdeaths(int $firstdeaths): void
    {
        $this->firstdeaths = $firstdeaths;
    }

    public function getTradekills(): int
    {
        return $this->tradekills;
    }

    public function setTradekills(int $tradekills): void
    {
        $this->tradekills = $tradekills;
    }

    public function getTradedeaths(): int
    {
        return $this->tradedeaths;
    }

    public function setTradedeaths(int $tradedeaths): void
    {
        $this->tradedeaths = $tradedeaths;
    }

    public function getTradefirstkills(): int
    {
        return $this->tradefirstkills;
    }

    public function setTradefirstkills(int $tradefirstkills): void
    {
        $this->tradefirstkills = $tradefirstkills;
    }

    public function getTradefirstdeaths(): int
    {
        return $this->tradefirstdeaths;
    }

    public function setTradefirstdeaths(int $tradefirstdeaths): void
    {
        $this->tradefirstdeaths = $tradefirstdeaths;
    }

    public function getRoundswonv5(): int
    {
        return $this->roundswonv5;
    }

    public function setRoundswonv5(int $roundswonv5): void
    {
        $this->roundswonv5 = $roundswonv5;
    }

    public function getRoundswonv4(): int
    {
        return $this->roundswonv4;
    }

    public function setRoundswonv4(int $roundswonv4): void
    {
        $this->roundswonv4 = $roundswonv4;
    }

    public function getRoundswonv3(): int
    {
        return $this->roundswonv3;
    }

    public function setRoundswonv3(int $roundswonv3): void
    {
        $this->roundswonv3 = $roundswonv3;
    }

    public function getRoundswonv2(): int
    {
        return $this->roundswonv2;
    }

    public function setRoundswonv2(int $roundswonv2): void
    {
        $this->roundswonv2 = $roundswonv2;
    }

    public function getRoundswonv1(): int
    {
        return $this->roundswonv1;
    }

    public function setRoundswonv1(int $roundswonv1): void
    {
        $this->roundswonv1 = $roundswonv1;
    }

    public function getRounds5k(): int
    {
        return $this->rounds5k;
    }

    public function setRounds5k(int $rounds5k): void
    {
        $this->rounds5k = $rounds5k;
    }

    public function getRounds4k(): int
    {
        return $this->rounds4k;
    }

    public function setRounds4k(int $rounds4k): void
    {
        $this->rounds4k = $rounds4k;
    }

    public function getRounds3k(): int
    {
        return $this->rounds3k;
    }

    public function setRounds3k(int $rounds3k): void
    {
        $this->rounds3k = $rounds3k;
    }

    public function getRounds2k(): int
    {
        return $this->rounds2k;
    }

    public function setRounds2k(int $rounds2k): void
    {
        $this->rounds2k = $rounds2k;
    }

    public function getRounds1k(): int
    {
        return $this->rounds1k;
    }

    public function setRounds1k(int $rounds1k): void
    {
        $this->rounds1k = $rounds1k;
    }

    public function getDamage(): float
    {
        return $this->damage;
    }

    public function setDamage(float $damage): void
    {
        $this->damage = $damage;
    }

    public function getSide(): int
    {
        return $this->side;
    }

    public function setSide(int $side): void
    {
        $this->side = $side;
    }

    /**
     * @return string
     */
    public function getClantag(): string
    {
        return $this->clantag;
    }

    /**
     * @param string $clantag
     */
    public function setClantag(string $clantag): void
    {
        $this->clantag = $clantag;
    }

    public function getMatches(): ?Matches
    {
        return $this->matches;
    }

    public function setMatches(?Matches $matches): static
    {
        $this->matches = $matches;

        return $this;
    }

    public function getKillBlinded(): int
    {
        return $this->killBlinded;
    }

    public function setKillBlinded(int $killBlinded): void
    {
        $this->killBlinded = $killBlinded;
    }

    public function getKillWallbang(): int
    {
        return $this->killWallbang;
    }

    public function setKillWallbang(int $killWallbang): void
    {
        $this->killWallbang = $killWallbang;
    }

    public function getKillSmoke(): int
    {
        return $this->killSmoke;
    }

    public function setKillSmoke(int $killSmoke): void
    {
        $this->killSmoke = $killSmoke;
    }

    public function getKillNoScope(): int
    {
        return $this->killNoScope;
    }

    public function setKillNoScope(int $killNoScope): void
    {
        $this->killNoScope = $killNoScope;
    }

    public function getRoundslostv1(): ?int
    {
        return $this->roundslostv1;
    }

    public function setRoundslostv1(int $roundslostv1): static
    {
        $this->roundslostv1 = $roundslostv1;

        return $this;
    }

    public function getRoundslostv2(): ?int
    {
        return $this->roundslostv2;
    }

    public function setRoundslostv2(int $roundslostv2): static
    {
        $this->roundslostv2 = $roundslostv2;

        return $this;
    }

    public function getRoundslostv3(): ?int
    {
        return $this->roundslostv3;
    }

    public function setRoundslostv3(int $roundslostv3): static
    {
        $this->roundslostv3 = $roundslostv3;

        return $this;
    }

    public function getRoundslostv4(): ?int
    {
        return $this->roundslostv4;
    }

    public function setRoundslostv4(int $roundslostv4): static
    {
        $this->roundslostv4 = $roundslostv4;

        return $this;
    }

    public function getRoundslostv5(): ?int
    {
        return $this->roundslostv5;
    }

    public function setRoundslostv5(int $roundslostv5): static
    {
        $this->roundslostv5 = $roundslostv5;

        return $this;
    }

}