<?php

namespace App\Entity;

use App\Repository\UserSkinRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserSkinRepository::class)]
#[ORM\Cache('NONSTRICT_READ_WRITE')]
class UserSkin
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'userSkins')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $User = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Skin $Skin = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $marketLink = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): static
    {
        $this->User = $User;

        return $this;
    }

    public function getSkin(): ?Skin
    {
        return $this->Skin;
    }

    public function setSkin(?Skin $Skin): static
    {
        $this->Skin = $Skin;

        return $this;
    }


    public function getMarketLink(): ?string
    {
        return $this->marketLink;
    }

    public function setMarketLink(?string $marketLink): static
    {
        $this->marketLink = $marketLink;

        return $this;
    }
}
