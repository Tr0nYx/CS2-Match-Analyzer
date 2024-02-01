<?php


namespace App\Entity;


use App\Entity\Traits\IdTrait;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class MatchRound
 * @package App\Entity
 */
#[ORM\Entity]
#[ORM\Cache]
class MatchRound
{
    use IdTrait;

    #[ORM\ManyToOne(targetEntity: Matches::class, cascade: ["remove"])]
    private Matches $match;

    #[ORM\ManyToOne(targetEntity: User::class, cascade: ["remove"])]
    private User $user;

    #[ORM\Column(type: Types::INTEGER)]
    private int $teamwon;

    #[ORM\Column(type: Types::INTEGER)]
    private int $userteam;

    #[ORM\Column(type: Types::INTEGER)]
    private int $killsClan = 0;
    #[ORM\Column(type: Types::INTEGER)]
    private int $killsEnemy = 0;


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
     * @return User
     */
    public function getUser(): User
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

}