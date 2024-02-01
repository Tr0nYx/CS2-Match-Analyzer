<?php

namespace App\Entity;


use App\Entity\Traits\IdTrait;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

#[UniqueEntity('steamId')]
#[UniqueEntity('steamKey')]
#[UniqueEntity('knownCode')]
#[ORM\Table]
#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Index(columns: ['avatar', 'created_at'], name: 'latest_idx')]
#[ORM\Cache('NONSTRICT_READ_WRITE')]
class User implements UserInterface
{
    use IdTrait;
    use TimestampableEntity;

    #[ORM\OneToMany(mappedBy: "user", targetEntity: MatchUserScoreboard::class)]
    #[ORM\OrderBy(["id" => "DESC"])]
    private Collection $matches;

    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: "myFriends")]
    private Collection $friendsWithMe;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: "friendsWithMe")]
    #[ORM\JoinTable(name: 'friends')]
    #[ORM\JoinColumn(name: 'user_id', referencedColumnName: 'id')]
    #[ORM\InverseJoinColumn(name: 'friend_user_id', referencedColumnName: 'id')]
    private Collection $myFriends;

    #[ORM\OneToMany(mappedBy: "user", targetEntity: UserMatchAccuracyWeapons::class)]
    private Collection $UserMatchAccuracyWeapons;

    #[ORM\OneToMany(mappedBy: "user", targetEntity: UserMatchDamageWeapons::class)]
    private Collection $UserMatchDamageWeapons;

    #[ORM\OneToMany(mappedBy: "user", targetEntity: UserMatchHeadshotsWeapons::class)]
    private Collection $UserMatchHeadshotsWeapons;

    #[ORM\OneToMany(mappedBy: "user", targetEntity: UserMatchHitsWeapons::class)]
    private Collection $UserMatchHitsWeapons;

    #[ORM\OneToMany(mappedBy: "user", targetEntity: UserMatchKillsWeapons::class)]
    private Collection $UserMatchKillsWeapons;

    #[ORM\OneToMany(mappedBy: "user", targetEntity: UserMatchShotsWeapons::class)]
    private Collection $UserMatchShotsWeapons;

    #[ORM\Column(type: Types::STRING, unique: true)]
    private string $steamId;

    #[ORM\Column(type: Types::STRING, unique: true, nullable: true)]
    private ?string $steamKey = null;

    #[ORM\Column(type: Types::STRING, unique: true, nullable: true)]
    private ?string $knownCode = null;

    #[ORM\Column(type: Types::STRING, nullable: true)]
    private ?string $steamusername = null;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private ?\DateTimeImmutable $vacbanned = null;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private ?\DateTimeImmutable $owbanned = null;

    #[ORM\Column(type: Types::STRING, nullable: true)]
    private ?string $avatar = null;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private ?\DateTimeImmutable $lastlogoff = null;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private ?\DateTimeImmutable $timecreated = null;

    #[ORM\Column(type: Types::STRING, nullable: true)]
    private ?string $profileurl = null;

    #[ORM\Column(type: Types::INTEGER, nullable: true)]
    private ?int $communityvisibilitystate = null;

    #[ORM\Column(type: Types::INTEGER, nullable: true)]
    private ?int $personastate = null;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private ?\DateTimeImmutable $lastdemosearch = null;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private ?\DateTimeImmutable $vaccheck = null;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private ?\DateTimeImmutable $registeredBanAt = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $password = null;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private ?\DateTimeImmutable $lastSteamUpdate = null;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private ?\DateTimeImmutable $lastInventoryUpdate = null;

    #[ORM\Column(name: 'skincolor', type: Types::STRING, length: 14, nullable: false)]
    private string $skincolor = 'light';

    #[ORM\Column(name: 'smallsidebar', type: Types::STRING, length: 8, nullable: false)]
    private string $smallsidebar = 'normal';

    #[ORM\Column(name: 'sidebarexpand', type: Types::BOOLEAN, nullable: false)]
    private bool $sidebarexpand = false;

    #[ORM\Column(name: 'layout', type: Types::STRING, length: 8, nullable: false)]
    private string $layout = 'fixed';

    #[ORM\Column(name: 'shadow', type: Types::STRING, length: 15, nullable: false)]
    private string $shadow = 'shadow-none';

    #[ORM\Column(name: 'smalltext', type: Types::BOOLEAN, nullable: false)]
    private bool $smalltext = true;

    #[ORM\OneToMany(mappedBy: 'User', targetEntity: UserSkin::class)]
    private Collection $userSkins;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $lastDemoFound = null;

    /**
     * User constructor.
     * @param $steamId
     */
    public function __construct($steamId)
    {
        $this->steamId = $steamId;
        $this->friendsWithMe = new ArrayCollection();
        $this->myFriends = new ArrayCollection();
        $this->UserMatchAccuracyWeapons = new ArrayCollection();
        $this->UserMatchDamageWeapons = new ArrayCollection();
        $this->UserMatchHeadshotsWeapons = new ArrayCollection();
        $this->UserMatchHitsWeapons = new ArrayCollection();
        $this->UserMatchKillsWeapons = new ArrayCollection();
        $this->UserMatchShotsWeapons = new ArrayCollection();
        $this->userSkins = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getSteamId(): string
    {
        return $this->steamId;
    }

    /**
     * @param string $steamId
     */
    public function setSteamId(string $steamId): void
    {
        $this->steamId = $steamId;
    }

    /**
     * @return string|null
     */
    public function getSteamKey(): ?string
    {
        return $this->steamKey;
    }

    /**
     * @param string $steamKey
     */
    public function setSteamKey(string $steamKey): void
    {
        $this->steamKey = $steamKey;
    }

    /**
     * @return string|null
     */
    public function getKnownCode(): ?string
    {
        return $this->knownCode;
    }

    /**
     * @param string|null $knownCode
     */
    public function setKnownCode(?string $knownCode): void
    {
        $this->knownCode = $knownCode;
    }

    /**
     * @return string|null
     */
    public function getSteamusername(): ?string
    {
        return $this->steamusername;
    }

    /**
     * @param string $steamusername
     */
    public function setSteamusername(string $steamusername): void
    {
        $this->steamusername = $steamusername;
    }

    /**
     * @return Collection
     */
    public function getFriendsWithMe(): Collection
    {
        return $this->friendsWithMe;
    }

    /**
     * @param Collection $friendsWithMe
     */
    public function setFriendsWithMe(Collection $friendsWithMe): void
    {
        $this->friendsWithMe = $friendsWithMe;
    }

    /**
     * @return Collection
     */
    public function getMyFriends(): Collection
    {
        return $this->myFriends;
    }

    /**
     * @param Collection $myFriends
     */
    public function setMyFriends(Collection $myFriends): void
    {
        $this->myFriends = $myFriends;
    }

    /**
     * @return string|null
     */
    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    /**
     * @param string $avatar
     */
    public function setAvatar(string $avatar): void
    {
        $this->avatar = $avatar;
    }

    /**
     * @return \DateTimeImmutable|null
     */
    public function getLastlogoff(): ?\DateTimeImmutable
    {
        return $this->lastlogoff;
    }

    /**
     * @param \DateTimeImmutable $lastlogoff
     */
    public function setLastlogoff(\DateTimeImmutable $lastlogoff): void
    {
        $this->lastlogoff = $lastlogoff;
    }

    /**
     * @return \DateTimeImmutable|null
     */
    public function getTimecreated(): ?\DateTimeImmutable
    {
        return $this->timecreated;
    }

    /**
     * @param \DateTimeImmutable $timecreated
     */
    public function setTimecreated(\DateTimeImmutable $timecreated): void
    {
        $this->timecreated = $timecreated;
    }

    /**
     * @return string|null
     */
    public function getProfileurl(): ?string
    {
        return $this->profileurl;
    }

    /**
     * @param string $profileurl
     */
    public function setProfileurl(string $profileurl): void
    {
        $this->profileurl = $profileurl;
    }

    /**
     * @return int|null
     */
    public function getCommunityvisibilitystate(): ?int
    {
        return $this->communityvisibilitystate;
    }

    /**
     * @param int $communityvisibilitystate
     */
    public function setCommunityvisibilitystate(int $communityvisibilitystate): void
    {
        $this->communityvisibilitystate = $communityvisibilitystate;
    }

    /**
     * @return int|null
     */
    public function getPersonastate(): ?int
    {
        return $this->personastate;
    }

    /**
     * @param int $personastate
     */
    public function setPersonastate(int $personastate): void
    {
        $this->personastate = $personastate;
    }

    /**
     * @return \DateTimeImmutable|null
     */
    public function getLastdemosearch(): ?\DateTimeImmutable
    {
        return $this->lastdemosearch;
    }

    /**
     * @param \DateTimeImmutable|null $lastdemosearch
     */
    public function setLastdemosearch(?\DateTimeImmutable $lastdemosearch): void
    {
        $this->lastdemosearch = $lastdemosearch;
    }

    /**
     * @return \DateTimeImmutable|null
     */
    public function getVaccheck(): ?\DateTimeImmutable
    {
        return $this->vaccheck;
    }

    /**
     * @param \DateTimeImmutable|null $vaccheck
     */
    public function setVaccheck(?\DateTimeImmutable $vaccheck): void
    {
        $this->vaccheck = $vaccheck;
    }

    /**
     * @return \DateTimeImmutable|null
     */
    public function getVacbanned(): ?\DateTimeImmutable
    {
        return $this->vacbanned;
    }

    /**
     * @param \DateTimeImmutable|null $vacbanned
     */
    public function setVacbanned(?\DateTimeImmutable $vacbanned): void
    {
        $this->vacbanned = $vacbanned;
    }

    /**
     * @return \DateTimeImmutable|null
     */
    public function getOwbanned(): ?\DateTimeImmutable
    {
        return $this->owbanned;
    }

    /**
     * @param \DateTimeImmutable|null $owbanned
     */
    public function setOwbanned(?\DateTimeImmutable $owbanned): void
    {
        $this->owbanned = $owbanned;
    }

    /**
     * @return \DateTimeImmutable|null
     */
    public function getRegisteredBanAt(): ?\DateTimeImmutable
    {
        return $this->registeredBanAt;
    }

    /**
     * @param \DateTimeImmutable|null $registeredBanAt
     */
    public function setRegisteredBanAt(?\DateTimeImmutable $registeredBanAt): void
    {
        $this->registeredBanAt = $registeredBanAt;
    }

    /**
     * @return PersistentCollection
     */
    public function getMatches(): PersistentCollection
    {
        return $this->matches;
    }

    /**
     * @param PersistentCollection $matches
     */
    public function setMatches(PersistentCollection $matches): void
    {
        $this->matches = $matches;
    }

    /**
     * @return UserMatchAccuracyWeapons[]|PersistentCollection
     */
    public function getUserMatchAccuracyWeapons()
    {
        return $this->UserMatchAccuracyWeapons;
    }

    /**
     * @param UserMatchAccuracyWeapons[]|PersistentCollection $UserMatchAccuracyWeapons
     */
    public function setUserMatchAccuracyWeapons($UserMatchAccuracyWeapons): void
    {
        $this->UserMatchAccuracyWeapons = $UserMatchAccuracyWeapons;
    }

    /**
     * @return UserMatchDamageWeapons[]|PersistentCollection
     */
    public function getUserMatchDamageWeapons()
    {
        return $this->UserMatchDamageWeapons;
    }

    /**
     * @param UserMatchDamageWeapons[]|PersistentCollection $UserMatchDamageWeapons
     */
    public function setUserMatchDamageWeapons($UserMatchDamageWeapons): void
    {
        $this->UserMatchDamageWeapons = $UserMatchDamageWeapons;
    }

    /**
     * @return UserMatchHeadshotsWeapons[]|PersistentCollection
     */
    public function getUserMatchHeadshotsWeapons()
    {
        return $this->UserMatchHeadshotsWeapons;
    }

    /**
     * @param UserMatchHeadshotsWeapons[]|PersistentCollection $UserMatchHeadshotsWeapons
     */
    public function setUserMatchHeadshotsWeapons($UserMatchHeadshotsWeapons): void
    {
        $this->UserMatchHeadshotsWeapons = $UserMatchHeadshotsWeapons;
    }

    /**
     * @return UserMatchHitsWeapons[]|PersistentCollection
     */
    public function getUserMatchHitsWeapons()
    {
        return $this->UserMatchHitsWeapons;
    }

    /**
     * @param UserMatchHitsWeapons[]|PersistentCollection $UserMatchHitsWeapons
     */
    public function setUserMatchHitsWeapons($UserMatchHitsWeapons): void
    {
        $this->UserMatchHitsWeapons = $UserMatchHitsWeapons;
    }

    /**
     * @return UserMatchKillsWeapons[]|PersistentCollection
     */
    public function getUserMatchKillsWeapons()
    {
        return $this->UserMatchKillsWeapons;
    }

    /**
     * @param UserMatchKillsWeapons[]|PersistentCollection $UserMatchKillsWeapons
     */
    public function setUserMatchKillsWeapons($UserMatchKillsWeapons): void
    {
        $this->UserMatchKillsWeapons = $UserMatchKillsWeapons;
    }

    /**
     * @return UserMatchShotsWeapons[]|PersistentCollection
     */
    public function getUserMatchShotsWeapons()
    {
        return $this->UserMatchShotsWeapons;
    }

    /**
     * @param UserMatchShotsWeapons[]|PersistentCollection $UserMatchShotsWeapons
     */
    public function setUserMatchShotsWeapons($UserMatchShotsWeapons): void
    {
        $this->UserMatchShotsWeapons = $UserMatchShotsWeapons;
    }

    /**
     * @param $friend
     */
    public function addFriend($friend)
    {
        if (!$this->myFriends->contains($friend)) {
            $this->myFriends->add($friend);
        }
    }

    /**
     * @param $friend
     */
    public function removeFriend($friend)
    {
        if ($this->myFriends->contains($friend)) {
            $this->myFriends->remove($friend);
        }
    }

    public function setPassword(string $password)
    {
        $this->password = $password;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function getRoles(): array
    {
        return ['ROLE_USER'];
    }

    public function eraseCredentials(): void
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function getUserIdentifier(): string
    {
        return $this->steamId;
    }

    public function hasFriend($friend)
    {
        return $this->friendsWithMe->contains($friend);
    }

    public function getLastSteamUpdate(): ?\DateTimeImmutable
    {
        return $this->lastSteamUpdate;
    }

    public function setLastSteamUpdate(?\DateTimeImmutable $lastSteamUpdate): void
    {
        $this->lastSteamUpdate = $lastSteamUpdate;
    }

    public function getLastInventoryUpdate(): ?\DateTimeImmutable
    {
        return $this->lastInventoryUpdate;
    }

    public function setLastInventoryUpdate(?\DateTimeImmutable $lastInventoryUpdate): void
    {
        $this->lastInventoryUpdate = $lastInventoryUpdate;
    }

    public function getSkincolor(): string
    {
        return $this->skincolor;
    }

    public function setSkincolor(string $skincolor): void
    {
        $this->skincolor = $skincolor;
    }

    public function getSmallsidebar(): string
    {
        return $this->smallsidebar;
    }

    public function setSmallsidebar(string $smallsidebar): void
    {
        $this->smallsidebar = $smallsidebar;
    }

    public function isSidebarexpand(): bool
    {
        return $this->sidebarexpand;
    }

    public function setSidebarexpand(?bool $sidebarexpand): void
    {
        $this->sidebarexpand = $sidebarexpand;
    }

    public function getLayout(): string
    {
        return $this->layout;
    }

    public function setLayout(string $layout): void
    {
        $this->layout = $layout;
    }

    public function isSmalltext(): bool
    {
        return $this->smalltext;
    }

    public function setSmalltext(bool $smalltext): void
    {
        $this->smalltext = $smalltext;
    }

    public function getShadow(): string
    {
        return $this->shadow;
    }

    public function setShadow(string $shadow): void
    {
        $this->shadow = $shadow;
    }

    /**
     * @return Collection<int, UserSkin>
     */
    public function getUserSkins(): Collection
    {
        return $this->userSkins;
    }

    public function addUserSkin(UserSkin $userSkin): static
    {
        if (!$this->userSkins->contains($userSkin)) {
            $this->userSkins->add($userSkin);
            $userSkin->setUser($this);
        }

        return $this;
    }

    public function removeUserSkin(UserSkin $userSkin): static
    {
        if ($this->userSkins->removeElement($userSkin)) {
            // set the owning side to null (unless already changed)
            if ($userSkin->getUser() === $this) {
                $userSkin->setUser(null);
            }
        }

        return $this;
    }

    public function getLastDemoFound(): ?\DateTimeImmutable
    {
        return $this->lastDemoFound;
    }

    public function setLastDemoFound(?\DateTimeImmutable $lastDemoFound): static
    {
        $this->lastDemoFound = $lastDemoFound;

        return $this;
    }

}
