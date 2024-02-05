<?php

namespace App\Entity;

use App\Entity\Traits\IdTrait;
use App\Entity\Traits\UserMatchWeaponsTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class UserMatchHitsWeapons
 * @package App\Entity
 */
#[ORM\Table]
#[ORM\Entity]
#[ORM\UniqueConstraint(name: 'IDX_USER_MATCH_WEAPON', columns: ['user_id', 'match_id', 'weapon'])]
#[ORM\Cache('NONSTRICT_READ_WRITE')]
class UserMatchHitsWeapons
{
    use IdTrait;
    use UserMatchWeaponsTrait;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: "UserMatchHitsWeapons")]
    private User $user;


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
