<?php


namespace App\Entity\Traits;


use App\Entity\Matches;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Trait UserMatchWeaponsTrait
 * @package App\Entity\Traits
 */
trait UserMatchWeaponsTrait
{
    #[ORM\ManyToOne(targetEntity: Matches::class)]
    private Matches $match;

    #[ORM\Column(type: Types::FLOAT)]
    private float $value;

    #[ORM\Column(type: Types::STRING)]
    private string $weapon;

    #[Gedmo\Timestampable(on: "create")]
    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    protected $createdAt;

    /**
     * @return Matches
     */
    public function getMatch(): Matches
    {
        return $this->match;
    }

    /**
     * @param Matches $match
     */
    public function setMatch(Matches $match): void
    {
        $this->match = $match;
    }

    /**
     * @return float
     */
    public function getValue(): float
    {
        return $this->value;
    }

    /**
     * @param float $value
     */
    public function setValue(float $value): void
    {
        $this->value = $value;
    }

    /**
     * @return string|null
     */
    public function getWeapon(): ?string
    {
        return $this->weapon;
    }

    /**
     * @param string|null $weapon
     */
    public function setWeapon(?string $weapon): void
    {
        $this->weapon = $weapon;
    }
}