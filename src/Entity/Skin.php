<?php

namespace App\Entity;

use App\Entity\Traits\IdTrait;
use App\Repository\SkinRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

#[ORM\Entity(repositoryClass: SkinRepository::class)]
#[ORM\Cache]
class Skin
{
    use IdTrait;
    use TimestampableEntity;

    #[ORM\Column]
    private ?int $appid = null;

    #[ORM\Column(length: 255)]
    private ?string $classid = null;

    #[ORM\Column(length: 255)]
    private ?string $instanceid = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $market_name = null;

    #[ORM\Column(length: 255)]
    private ?string $MarketHashName = null;

    #[ORM\Column(nullable: true)]
    private ?float $lowestPrice = null;

    #[ORM\Column(nullable: true)]
    private ?float $medianPrice = null;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private ?\DateTimeImmutable $lastPriceCheck = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $image = null;

    public function getAppid(): ?int
    {
        return $this->appid;
    }

    public function setAppid(int $appid): static
    {
        $this->appid = $appid;

        return $this;
    }

    public function getClassid(): ?string
    {
        return $this->classid;
    }

    public function setClassid(string $classid): static
    {
        $this->classid = $classid;

        return $this;
    }

    public function getInstanceid(): ?string
    {
        return $this->instanceid;
    }

    public function setInstanceid(string $instanceid): static
    {
        $this->instanceid = $instanceid;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getMarketName(): ?string
    {
        return $this->market_name;
    }

    public function setMarketName(string $market_name): static
    {
        $this->market_name = $market_name;

        return $this;
    }

    public function getMarketHashName(): ?string
    {
        return $this->MarketHashName;
    }

    public function setMarketHashName(string $MarketHashName): static
    {
        $this->MarketHashName = $MarketHashName;

        return $this;
    }

    public function getLowestPrice(): ?float
    {
        return $this->lowestPrice;
    }

    public function setLowestPrice(?float $lowestPrice): static
    {
        $this->lowestPrice = $lowestPrice;

        return $this;
    }

    public function getMedianPrice(): ?float
    {
        return $this->medianPrice;
    }

    public function setMedianPrice(?float $medianPrice): static
    {
        $this->medianPrice = $medianPrice;

        return $this;
    }

    public function getLastPriceCheck(): ?\DateTimeImmutable
    {
        return $this->lastPriceCheck;
    }

    public function setLastPriceCheck(?\DateTimeImmutable $lastPriceCheck): static
    {
        $this->lastPriceCheck = $lastPriceCheck;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

        return $this;
    }
}
