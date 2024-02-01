<?php


namespace App\Entity;


use App\Entity\Traits\IdTrait;
use App\Repository\MatchRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Class Match
 * @package App\Entity
 */
#[ORM\Entity(repositoryClass: MatchRepository::class, readOnly: false)]
#[UniqueEntity('knownCode')]
#[ORM\Table(name: '`match`')]
#[ORM\Index(columns: ['match_time', 'created_at'], name: 'matchtime_idx')]
#[ORM\Cache('NONSTRICT_READ_WRITE')]
class Matches
{
    use IdTrait;
    use TimestampableEntity;

    #[ORM\OneToMany(mappedBy: 'matches', targetEntity: MatchUserScoreboard::class)]
    private Collection $MatchUserScoreboard;

    #[ORM\Column(type: Types::BOOLEAN)]
    private bool $downloaded = false;

    #[ORM\Column(type: Types::BOOLEAN)]
    private bool $analyzed = false;

    #[ORM\Column(type: Types::BOOLEAN)]
    private bool $saved = false;

    #[ORM\Column(type: Types::BOOLEAN)]
    private bool $heatmap = false;

    #[ORM\Column(type: Types::STRING, nullable: true)]
    private ?string $map = null;

    #[ORM\Column(type: Types::STRING, unique: true)]
    private string $shareCode;

    #[ORM\Column(type: Types::STRING)]
    private string $matchId = '';

    #[ORM\Column(type: Types::STRING)]
    private string $outcomeId = '';

    #[ORM\Column(type: Types::INTEGER)]
    private int $tokenId = 0;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private ?\DateTimeImmutable $matchTime = null;

    #[ORM\Column(type: Types::STRING)]
    private string $team_one = '';

    #[ORM\Column(type: Types::STRING)]
    private string $team_two = '';

    #[ORM\Column(type: Types::INTEGER)]
    private int $tickrate = 64;

    #[ORM\Column(type: Types::DATEINTERVAL, nullable: true)]
    private ?\DateInterval $length = null;

    #[ORM\Column(type: Types::INTEGER, nullable: true)]
    private ?int $totalRounds = 0;

    #[ORM\Column(type: Types::BOOLEAN)]
    private bool $corrupt = false;

    public function __construct()
    {
        $this->MatchUserScoreboard = new ArrayCollection();
    }

    /**
     * @return Collection
     */
    public function getScoreboard(): Collection
    {
        return $this->MatchUserScoreboard;
    }


    /**
     * @return Collection<int, MatchUserScoreboard>
     */
    public function getMatchUserScoreboard(): Collection
    {
        return $this->MatchUserScoreboard;
    }

    public function addMatchUserScoreboard(MatchUserScoreboard $matchUserScoreboard): static
    {
        if (!$this->MatchUserScoreboard->contains($matchUserScoreboard)) {
            $this->MatchUserScoreboard->add($matchUserScoreboard);
            $matchUserScoreboard->setMatches($this);
        }

        return $this;
    }

    public function removeMatchUserScoreboard(MatchUserScoreboard $matchUserScoreboard): static
    {
        if ($this->MatchUserScoreboard->removeElement($matchUserScoreboard)) {
            // set the owning side to null (unless already changed)
            if ($matchUserScoreboard->getMatches() === $this) {
                $matchUserScoreboard->setMatches(null);
            }
        }

        return $this;
    }

    /**
     * @return bool
     */
    public function isDownloaded(): bool
    {
        return $this->downloaded;
    }

    /**
     * @param bool $downloaded
     */
    public function setDownloaded(bool $downloaded): void
    {
        $this->downloaded = $downloaded;
    }

    public function isHeatmap(): bool
    {
        return $this->heatmap;
    }

    public function setHeatmap(bool $heatmap): void
    {
        $this->heatmap = $heatmap;
    }

    /**
     * @return string|null
     */
    public function getMap(): ?string
    {
        return $this->map;
    }

    /**
     * @param string|null $map
     */
    public function setMap(?string $map): void
    {
        $this->map = $map;
    }

    /**
     * @return string
     */
    public function getShareCode(): string
    {
        return $this->shareCode;
    }

    /**
     * @param string $shareCode
     */
    public function setShareCode(string $shareCode): void
    {
        $this->shareCode = $shareCode;
    }

    /**
     * @return string|null
     */
    public function getMatchId(): ?string
    {
        return $this->matchId;
    }

    /**
     * @param string|null $matchId
     */
    public function setMatchId(?string $matchId): void
    {
        $this->matchId = $matchId;
    }

    /**
     * @return string|null
     */
    public function getOutcomeId(): ?string
    {
        return $this->outcomeId;
    }

    /**
     * @param string|null $outcomeId
     */
    public function setOutcomeId(?string $outcomeId): void
    {
        $this->outcomeId = $outcomeId;
    }

    /**
     * @return int|null
     */
    public function getTokenId(): ?int
    {
        return $this->tokenId;
    }

    /**
     * @param int|null $tokenId
     */
    public function setTokenId(?int $tokenId): void
    {
        $this->tokenId = $tokenId;
    }

    /**
     * @return \DateTimeImmutable|null
     */
    public function getMatchTime(): ?\DateTimeImmutable
    {
        return $this->matchTime;
    }

    /**
     * @param \DateTimeImmutable $matchTime
     */
    public function setMatchTime(\DateTimeImmutable $matchTime): void
    {
        $this->matchTime = $matchTime;
    }

    /**
     * @return string|null
     */
    public function getTeamOne(): ?string
    {
        return $this->team_one;
    }

    /**
     * @param string|null $team_one
     */
    public function setTeamOne(?string $team_one): void
    {
        $this->team_one = $team_one;
    }

    /**
     * @return string|null
     */
    public function getTeamTwo(): ?string
    {
        return $this->team_two;
    }

    /**
     * @param string|null $team_two
     */
    public function setTeamTwo(?string $team_two): void
    {
        $this->team_two = $team_two;
    }

    /**
     * @return int|null
     */
    public function getTickrate(): ?int
    {
        return $this->tickrate;
    }

    /**
     * @param int|null $tickrate
     */
    public function setTickrate(?int $tickrate): void
    {
        $this->tickrate = $tickrate;
    }

    /**
     * @return bool
     */
    public function isAnalyzed(): bool
    {
        return $this->analyzed;
    }

    /**
     * @param bool $analyzed
     */
    public function setAnalyzed(bool $analyzed): void
    {
        $this->analyzed = $analyzed;
    }

    /**
     * @return bool
     */
    public function isSaved(): bool
    {
        return $this->saved;
    }

    /**
     * @param bool $saved
     */
    public function setSaved(bool $saved): void
    {
        $this->saved = $saved;
    }

    /**
     * @return \DateInterval
     */
    public function getLength(): \DateInterval
    {
        return $this->length;
    }

    /**
     * @param \DateInterval $length
     */
    public function setLength(\DateInterval $length): void
    {
        $this->length = $length;
    }

    public function getTotalRounds(): ?int
    {
        return $this->totalRounds;
    }

    public function setTotalRounds(int $totalRounds): void
    {
        $this->totalRounds = $totalRounds;
    }

    public function isCorrupt(): bool
    {
        return $this->corrupt;
    }

    public function setCorrupt(bool $corrupt): void
    {
        $this->corrupt = $corrupt;
    }
}