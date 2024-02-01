<?php


namespace App\Entity;


use App\Entity\Traits\IdTrait;
use App\Entity\Traits\UserMatchWeaponsTrait;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table]
#[ORM\Entity]
#[ORM\UniqueConstraint(name: 'IDX_USER_MATCH_WEAPON', columns: ['user_id', 'match_id', 'weapon'])]
#[ORM\Cache('NONSTRICT_READ_WRITE')]
class UserMatchKillsWeapons
{
    use IdTrait;
    use UserMatchWeaponsTrait;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: "UserMatchKillsWeapons")]
    private User $user;

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): void
    {
        $this->user = $user;
    }
}