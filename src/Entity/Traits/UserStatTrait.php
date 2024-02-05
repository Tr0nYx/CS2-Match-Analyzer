<?php


namespace App\Entity\Traits;

use App\Entity\User;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

trait UserStatTrait
{
    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: "matches")]
    private User $user;

    #[ORM\Column(type: Types::INTEGER, nullable: true)]
    private $kills;

    #[ORM\Column(type: Types::INTEGER, nullable: true)]
    private $mvps;

    #[ORM\Column(type: Types::INTEGER, nullable: true)]
    private $deaths;

    #[ORM\Column(type: Types::INTEGER, nullable: true)]
    private $assists;

    #[ORM\Column(type: Types::FLOAT)]
    private float $kd = 0;

    #[ORM\Column(type: Types::FLOAT)]
    private float $adr;

    #[ORM\Column(type: Types::FLOAT)]
    private float $hs = 0;

    #[ORM\Column(type: Types::FLOAT)]
    private float $hspercent = 0;

    #[ORM\Column(type: Types::FLOAT)]
    private float $hltvrating = 0;

    #[ORM\Column(type: Types::FLOAT)]
    private float $hltv2rating = 0;

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    /**
     * @return int|null
     */
    public function getKills(): ?int
    {
        return $this->kills;
    }

    /**
     * @param int|null $kills
     */
    public function setKills(?int $kills): void
    {
        $this->kills = $kills;
    }

    /**
     * @return int|null
     */
    public function getMvps(): ?int
    {
        return $this->mvps;
    }

    /**
     * @param int|null $mvps
     */
    public function setMvps(?int $mvps): void
    {
        $this->mvps = $mvps;
    }

    /**
     * @return int|null
     */
    public function getDeaths(): ?int
    {
        return $this->deaths;
    }

    /**
     * @param int|null $deaths
     */
    public function setDeaths(?int $deaths): void
    {
        $this->deaths = $deaths;
    }

    /**
     * @return int|null
     */
    public function getAssists(): ?int
    {
        return $this->assists;
    }

    /**
     * @param int|null $assists
     */
    public function setAssists(?int $assists): void
    {
        $this->assists = $assists;
    }

    /**
     * @return float|null
     */
    public function getKd(): ?float
    {
        return $this->kd;
    }

    /**
     * @param float|null $kd
     */
    public function setKd(?float $kd): void
    {
        $this->kd = $kd;
    }

    /**
     * @return float
     */
    public function getAdr(): float
    {
        return $this->adr;
    }

    /**
     * @param float $adr
     */
    public function setAdr(float $adr): void
    {
        $this->adr = $adr;
    }

    /**
     * @return int|null
     */
    public function getHs(): ?int
    {
        return $this->hs;
    }

    /**
     * @param int|null $hs
     */
    public function setHs(?int $hs): void
    {
        $this->hs = $hs;
    }

    /**
     * @return float|null
     */
    public function getHspercent(): ?float
    {
        return $this->hspercent;
    }

    /**
     * @param float|null $hspercent
     */
    public function setHspercent(?float $hspercent): void
    {
        $this->hspercent = $hspercent;
    }

    /**
     * @return float
     */
    public function getHltvrating(): float
    {
        return $this->hltvrating;
    }

    /**
     * @param float $hltvrating
     */
    public function setHltvrating(float $hltvrating): void
    {
        $this->hltvrating = $hltvrating;
    }

    /**
     * @return float
     */
    public function getHltv2rating(): float
    {
        return $this->hltv2rating;
    }

    /**
     * @param float $hltv2rating
     */
    public function setHltv2rating(float $hltv2rating): void
    {
        $this->hltv2rating = $hltv2rating;
    }
}