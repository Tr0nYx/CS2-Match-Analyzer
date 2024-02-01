<?php


namespace App\Entity;


use App\Entity\Traits\IdTrait;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class UserAchievements
 * @package App\Entity
 */
#[ORM\Entity]
class UserAchievements implements \JsonSerializable
{
    use IdTrait;

    #[ORM\ManyToOne(targetEntity: User::class, cascade: ["remove"])]
    private User $user;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $win_bomb_plant;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $bomb_plant_low;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $bomb_defuse_low;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $kill_enemy_low;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $kill_enemy_med;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $kill_enemy_high;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $bomb_defuse_close_call;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $kill_bomb_defuser;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $win_bomb_defuse;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $bomb_plant_in_25_seconds;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $win_rounds_low;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $win_rounds_med;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $win_rounds_high;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $give_damage_low;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $give_damage_med;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $give_damage_high;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $killing_spree;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $kill_with_own_gun;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $rescue_hostages_low;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $rescue_hostages_med;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $rescue_all_hostages;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $fast_hostage_rescue;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $kill_two_with_one_shot;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $earn_money_low;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $earn_money_med;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $earn_money_high;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $dead_grenade_kill;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $kill_enemy_deagle;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $kill_enemy_glock;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $kill_enemy_elite;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $kill_enemy_fiveseven;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $meta_pistol;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $kill_enemy_awp;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $kill_enemy_ak47;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $kill_enemy_m4a1;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $kill_enemy_aug;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $kill_enemy_famas;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $kill_enemy_g3sg1;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $meta_rifle;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $kill_enemy_p90;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $kill_enemy_mac10;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $kill_enemy_ump45;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $meta_smg;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $kill_enemy_xm1014;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $meta_shotgun;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $kill_enemy_hegrenade;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $kill_enemy_knife;
    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $kill_enemy_m249;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $meta_weaponmaster;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $kill_enemy_team;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $kills_with_multiple_guns;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $kill_hostage_rescuer;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $last_player_alive;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $kill_enemy_last_bullet;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $killing_spree_ender;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $break_windows;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $headshots;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $damage_no_kill;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $kill_low_damage;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $kill_enemy_reloading;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $kill_enemy_blinded;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $kill_enemies_while_blind;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $kills_enemy_weapon;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $kill_with_every_weapon;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $survive_grenade;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $win_knife_fights_low;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $win_knife_fights_high;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $killed_defuser_with_grenade;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $hip_shot;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $kill_sniper_with_sniper;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $kill_sniper_with_knife;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $kill_snipers;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $kill_when_at_low_health;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $grenade_multikill;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $pistol_round_knife_kill;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $fast_round_win;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $win_pistolrounds_low;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $win_pistolrounds_med;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $win_pistolrounds_high;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $bomb_multikill;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $goose_chase;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $win_bomb_plant_after_recovery;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $survive_many_attacks;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $lossless_extermination;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $flawless_victory;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $win_dual_duel;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $unstoppable_force;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $immovable_object;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $headshots_in_round;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $win_map_cs_italy;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $win_map_cs_office;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $win_map_de_aztec;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $win_map_de_dust;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $win_map_de_dust2;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $win_map_de_inferno;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $win_map_de_nuke;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $win_map_de_shorttrain;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $kill_while_in_air;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $kill_enemy_in_air;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $killer_and_enemy_in_air;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $silent_win;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $bloodless_victory;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $donate_weapons;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $win_rounds_without_buying;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $defuse_defense;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $kill_bomb_pickup;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $dominations_low;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $dominations_high;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $domination_overkills_low;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $domination_overkills_high;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $revenges_low;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $revenges_high;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $concurrent_dominations;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $domination_overkills_match;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $extended_domination;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $kill_enemies_while_blind_hard;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $cause_friendly_fire_with_flashbang;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $avenge_friend;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $gun_game_kill_knifer;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $win_every_gungame_map;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $win_map_ar_shoots;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $tr_bomb_plant_low;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $tr_bomb_defuse_low;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $win_map_de_lake;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $win_map_de_safehouse;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $win_map_de_sugarcane;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $win_map_de_stmarc;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $gun_game_knife_kill_knifer;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $gun_game_smg_kill_knifer;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $gun_game_rounds_low;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $gun_game_rounds_med;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $gun_game_rounds_high;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $win_gun_game_rounds_low;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $win_gun_game_rounds_med;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $win_gun_game_rounds_high;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $win_gun_game_rounds_extreme;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $win_gun_game_rounds_ultimate;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $play_every_gungame_map;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $gun_game_rampage;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $gun_game_first_kill;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $gun_game_first_thing_first;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $gun_game_target_secured;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $one_shot_one_kill;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $gun_game_conservationist;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $base_scamper;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $born_ready;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $still_alive;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $medalist;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $win_map_de_bank;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $win_map_ar_baggage;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $kill_enemy_bizon;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $kill_enemy_tec9;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $kill_enemy_taser;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $kill_enemy_hkp2000;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $kill_enemy_p250;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $kill_enemy_scar20;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $kill_enemy_sg556;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $kill_enemy_ssg08;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $kill_enemy_mp7;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $kill_enemy_mp9;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $kill_enemy_mag7;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $kill_enemy_sawedoff;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $kill_enemy_nova;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $kill_enemy_negev;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $kill_enemy_molotov;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $win_map_de_train;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $kill_enemy_galilar;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private \DateTimeImmutable $play_cs2;

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

    /**
     * @return \DateTimeImmutable
     */
    public function getWinBombPlant(): \DateTimeImmutable
    {
        return $this->win_bomb_plant;
    }

    /**
     * @param \DateTimeImmutable $win_bomb_plant
     */
    public function setWinBombPlant(\DateTimeImmutable $win_bomb_plant): void
    {
        $this->win_bomb_plant = $win_bomb_plant;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getBombPlantLow(): \DateTimeImmutable
    {
        return $this->bomb_plant_low;
    }

    /**
     * @param \DateTimeImmutable $bomb_plant_low
     */
    public function setBombPlantLow(\DateTimeImmutable $bomb_plant_low): void
    {
        $this->bomb_plant_low = $bomb_plant_low;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getBombDefuseLow(): \DateTimeImmutable
    {
        return $this->bomb_defuse_low;
    }

    /**
     * @param \DateTimeImmutable $bomb_defuse_low
     */
    public function setBombDefuseLow(\DateTimeImmutable $bomb_defuse_low): void
    {
        $this->bomb_defuse_low = $bomb_defuse_low;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getKillEnemyLow(): \DateTimeImmutable
    {
        return $this->kill_enemy_low;
    }

    /**
     * @param \DateTimeImmutable $kill_enemy_low
     */
    public function setKillEnemyLow(\DateTimeImmutable $kill_enemy_low): void
    {
        $this->kill_enemy_low = $kill_enemy_low;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getKillEnemyMed(): \DateTimeImmutable
    {
        return $this->kill_enemy_med;
    }

    /**
     * @param \DateTimeImmutable $kill_enemy_med
     */
    public function setKillEnemyMed(\DateTimeImmutable $kill_enemy_med): void
    {
        $this->kill_enemy_med = $kill_enemy_med;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getKillEnemyHigh(): \DateTimeImmutable
    {
        return $this->kill_enemy_high;
    }

    /**
     * @param \DateTimeImmutable $kill_enemy_high
     */
    public function setKillEnemyHigh(\DateTimeImmutable $kill_enemy_high): void
    {
        $this->kill_enemy_high = $kill_enemy_high;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getBombDefuseCloseCall(): \DateTimeImmutable
    {
        return $this->bomb_defuse_close_call;
    }

    /**
     * @param \DateTimeImmutable $bomb_defuse_close_call
     */
    public function setBombDefuseCloseCall(\DateTimeImmutable $bomb_defuse_close_call): void
    {
        $this->bomb_defuse_close_call = $bomb_defuse_close_call;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getKillBombDefuser(): \DateTimeImmutable
    {
        return $this->kill_bomb_defuser;
    }

    /**
     * @param \DateTimeImmutable $kill_bomb_defuser
     */
    public function setKillBombDefuser(\DateTimeImmutable $kill_bomb_defuser): void
    {
        $this->kill_bomb_defuser = $kill_bomb_defuser;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getWinBombDefuse(): \DateTimeImmutable
    {
        return $this->win_bomb_defuse;
    }

    /**
     * @param \DateTimeImmutable $win_bomb_defuse
     */
    public function setWinBombDefuse(\DateTimeImmutable $win_bomb_defuse): void
    {
        $this->win_bomb_defuse = $win_bomb_defuse;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getBombPlantIn25Seconds(): \DateTimeImmutable
    {
        return $this->bomb_plant_in_25_seconds;
    }

    /**
     * @param \DateTimeImmutable $bomb_plant_in_25_seconds
     */
    public function setBombPlantIn25Seconds(\DateTimeImmutable $bomb_plant_in_25_seconds): void
    {
        $this->bomb_plant_in_25_seconds = $bomb_plant_in_25_seconds;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getWinRoundsLow(): \DateTimeImmutable
    {
        return $this->win_rounds_low;
    }

    /**
     * @param \DateTimeImmutable $win_rounds_low
     */
    public function setWinRoundsLow(\DateTimeImmutable $win_rounds_low): void
    {
        $this->win_rounds_low = $win_rounds_low;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getWinRoundsMed(): \DateTimeImmutable
    {
        return $this->win_rounds_med;
    }

    /**
     * @param \DateTimeImmutable $win_rounds_med
     */
    public function setWinRoundsMed(\DateTimeImmutable $win_rounds_med): void
    {
        $this->win_rounds_med = $win_rounds_med;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getWinRoundsHigh(): \DateTimeImmutable
    {
        return $this->win_rounds_high;
    }

    /**
     * @param \DateTimeImmutable $win_rounds_high
     */
    public function setWinRoundsHigh(\DateTimeImmutable $win_rounds_high): void
    {
        $this->win_rounds_high = $win_rounds_high;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getGiveDamageLow(): \DateTimeImmutable
    {
        return $this->give_damage_low;
    }

    /**
     * @param \DateTimeImmutable $give_damage_low
     */
    public function setGiveDamageLow(\DateTimeImmutable $give_damage_low): void
    {
        $this->give_damage_low = $give_damage_low;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getGiveDamageMed(): \DateTimeImmutable
    {
        return $this->give_damage_med;
    }

    /**
     * @param \DateTimeImmutable $give_damage_med
     */
    public function setGiveDamageMed(\DateTimeImmutable $give_damage_med): void
    {
        $this->give_damage_med = $give_damage_med;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getGiveDamageHigh(): \DateTimeImmutable
    {
        return $this->give_damage_high;
    }

    /**
     * @param \DateTimeImmutable $give_damage_high
     */
    public function setGiveDamageHigh(\DateTimeImmutable $give_damage_high): void
    {
        $this->give_damage_high = $give_damage_high;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getKillingSpree(): \DateTimeImmutable
    {
        return $this->killing_spree;
    }

    /**
     * @param \DateTimeImmutable $killing_spree
     */
    public function setKillingSpree(\DateTimeImmutable $killing_spree): void
    {
        $this->killing_spree = $killing_spree;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getKillWithOwnGun(): \DateTimeImmutable
    {
        return $this->kill_with_own_gun;
    }

    /**
     * @param \DateTimeImmutable $kill_with_own_gun
     */
    public function setKillWithOwnGun(\DateTimeImmutable $kill_with_own_gun): void
    {
        $this->kill_with_own_gun = $kill_with_own_gun;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getRescueHostagesLow(): \DateTimeImmutable
    {
        return $this->rescue_hostages_low;
    }

    /**
     * @param \DateTimeImmutable $rescue_hostages_low
     */
    public function setRescueHostagesLow(\DateTimeImmutable $rescue_hostages_low): void
    {
        $this->rescue_hostages_low = $rescue_hostages_low;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getRescueHostagesMed(): \DateTimeImmutable
    {
        return $this->rescue_hostages_med;
    }

    /**
     * @param \DateTimeImmutable $rescue_hostages_med
     */
    public function setRescueHostagesMed(\DateTimeImmutable $rescue_hostages_med): void
    {
        $this->rescue_hostages_med = $rescue_hostages_med;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getRescueAllHostages(): \DateTimeImmutable
    {
        return $this->rescue_all_hostages;
    }

    /**
     * @param \DateTimeImmutable $rescue_all_hostages
     */
    public function setRescueAllHostages(\DateTimeImmutable $rescue_all_hostages): void
    {
        $this->rescue_all_hostages = $rescue_all_hostages;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getFastHostageRescue(): \DateTimeImmutable
    {
        return $this->fast_hostage_rescue;
    }

    /**
     * @param \DateTimeImmutable $fast_hostage_rescue
     */
    public function setFastHostageRescue(\DateTimeImmutable $fast_hostage_rescue): void
    {
        $this->fast_hostage_rescue = $fast_hostage_rescue;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getKillTwoWithOneShot(): \DateTimeImmutable
    {
        return $this->kill_two_with_one_shot;
    }

    /**
     * @param \DateTimeImmutable $kill_two_with_one_shot
     */
    public function setKillTwoWithOneShot(\DateTimeImmutable $kill_two_with_one_shot): void
    {
        $this->kill_two_with_one_shot = $kill_two_with_one_shot;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getEarnMoneyLow(): \DateTimeImmutable
    {
        return $this->earn_money_low;
    }

    /**
     * @param \DateTimeImmutable $earn_money_low
     */
    public function setEarnMoneyLow(\DateTimeImmutable $earn_money_low): void
    {
        $this->earn_money_low = $earn_money_low;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getEarnMoneyMed(): \DateTimeImmutable
    {
        return $this->earn_money_med;
    }

    /**
     * @param \DateTimeImmutable $earn_money_med
     */
    public function setEarnMoneyMed(\DateTimeImmutable $earn_money_med): void
    {
        $this->earn_money_med = $earn_money_med;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getEarnMoneyHigh(): \DateTimeImmutable
    {
        return $this->earn_money_high;
    }

    /**
     * @param \DateTimeImmutable $earn_money_high
     */
    public function setEarnMoneyHigh(\DateTimeImmutable $earn_money_high): void
    {
        $this->earn_money_high = $earn_money_high;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getDeadGrenadeKill(): \DateTimeImmutable
    {
        return $this->dead_grenade_kill;
    }

    /**
     * @param \DateTimeImmutable $dead_grenade_kill
     */
    public function setDeadGrenadeKill(\DateTimeImmutable $dead_grenade_kill): void
    {
        $this->dead_grenade_kill = $dead_grenade_kill;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getKillEnemyDeagle(): \DateTimeImmutable
    {
        return $this->kill_enemy_deagle;
    }

    /**
     * @param \DateTimeImmutable $kill_enemy_deagle
     */
    public function setKillEnemyDeagle(\DateTimeImmutable $kill_enemy_deagle): void
    {
        $this->kill_enemy_deagle = $kill_enemy_deagle;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getKillEnemyGlock(): \DateTimeImmutable
    {
        return $this->kill_enemy_glock;
    }

    /**
     * @param \DateTimeImmutable $kill_enemy_glock
     */
    public function setKillEnemyGlock(\DateTimeImmutable $kill_enemy_glock): void
    {
        $this->kill_enemy_glock = $kill_enemy_glock;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getKillEnemyElite(): \DateTimeImmutable
    {
        return $this->kill_enemy_elite;
    }

    /**
     * @param \DateTimeImmutable $kill_enemy_elite
     */
    public function setKillEnemyElite(\DateTimeImmutable $kill_enemy_elite): void
    {
        $this->kill_enemy_elite = $kill_enemy_elite;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getKillEnemyFiveseven(): \DateTimeImmutable
    {
        return $this->kill_enemy_fiveseven;
    }

    /**
     * @param \DateTimeImmutable $kill_enemy_fiveseven
     */
    public function setKillEnemyFiveseven(\DateTimeImmutable $kill_enemy_fiveseven): void
    {
        $this->kill_enemy_fiveseven = $kill_enemy_fiveseven;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getMetaPistol(): \DateTimeImmutable
    {
        return $this->meta_pistol;
    }

    /**
     * @param \DateTimeImmutable $meta_pistol
     */
    public function setMetaPistol(\DateTimeImmutable $meta_pistol): void
    {
        $this->meta_pistol = $meta_pistol;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getKillEnemyAwp(): \DateTimeImmutable
    {
        return $this->kill_enemy_awp;
    }

    /**
     * @param \DateTimeImmutable $kill_enemy_awp
     */
    public function setKillEnemyAwp(\DateTimeImmutable $kill_enemy_awp): void
    {
        $this->kill_enemy_awp = $kill_enemy_awp;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getKillEnemyAk47(): \DateTimeImmutable
    {
        return $this->kill_enemy_ak47;
    }

    /**
     * @param \DateTimeImmutable $kill_enemy_ak47
     */
    public function setKillEnemyAk47(\DateTimeImmutable $kill_enemy_ak47): void
    {
        $this->kill_enemy_ak47 = $kill_enemy_ak47;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getKillEnemyM4a1(): \DateTimeImmutable
    {
        return $this->kill_enemy_m4a1;
    }

    /**
     * @param \DateTimeImmutable $kill_enemy_m4a1
     */
    public function setKillEnemyM4a1(\DateTimeImmutable $kill_enemy_m4a1): void
    {
        $this->kill_enemy_m4a1 = $kill_enemy_m4a1;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getKillEnemyAug(): \DateTimeImmutable
    {
        return $this->kill_enemy_aug;
    }

    /**
     * @param \DateTimeImmutable $kill_enemy_aug
     */
    public function setKillEnemyAug(\DateTimeImmutable $kill_enemy_aug): void
    {
        $this->kill_enemy_aug = $kill_enemy_aug;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getKillEnemyFamas(): \DateTimeImmutable
    {
        return $this->kill_enemy_famas;
    }

    /**
     * @param \DateTimeImmutable $kill_enemy_famas
     */
    public function setKillEnemyFamas(\DateTimeImmutable $kill_enemy_famas): void
    {
        $this->kill_enemy_famas = $kill_enemy_famas;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getKillEnemyG3sg1(): \DateTimeImmutable
    {
        return $this->kill_enemy_g3sg1;
    }

    /**
     * @param \DateTimeImmutable $kill_enemy_g3sg1
     */
    public function setKillEnemyG3sg1(\DateTimeImmutable $kill_enemy_g3sg1): void
    {
        $this->kill_enemy_g3sg1 = $kill_enemy_g3sg1;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getMetaRifle(): \DateTimeImmutable
    {
        return $this->meta_rifle;
    }

    /**
     * @param \DateTimeImmutable $meta_rifle
     */
    public function setMetaRifle(\DateTimeImmutable $meta_rifle): void
    {
        $this->meta_rifle = $meta_rifle;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getKillEnemyP90(): \DateTimeImmutable
    {
        return $this->kill_enemy_p90;
    }

    /**
     * @param \DateTimeImmutable $kill_enemy_p90
     */
    public function setKillEnemyP90(\DateTimeImmutable $kill_enemy_p90): void
    {
        $this->kill_enemy_p90 = $kill_enemy_p90;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getKillEnemyMac10(): \DateTimeImmutable
    {
        return $this->kill_enemy_mac10;
    }

    /**
     * @param \DateTimeImmutable $kill_enemy_mac10
     */
    public function setKillEnemyMac10(\DateTimeImmutable $kill_enemy_mac10): void
    {
        $this->kill_enemy_mac10 = $kill_enemy_mac10;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getKillEnemyUmp45(): \DateTimeImmutable
    {
        return $this->kill_enemy_ump45;
    }

    /**
     * @param \DateTimeImmutable $kill_enemy_ump45
     */
    public function setKillEnemyUmp45(\DateTimeImmutable $kill_enemy_ump45): void
    {
        $this->kill_enemy_ump45 = $kill_enemy_ump45;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getMetaSmg(): \DateTimeImmutable
    {
        return $this->meta_smg;
    }

    /**
     * @param \DateTimeImmutable $meta_smg
     */
    public function setMetaSmg(\DateTimeImmutable $meta_smg): void
    {
        $this->meta_smg = $meta_smg;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getKillEnemyXm1014(): \DateTimeImmutable
    {
        return $this->kill_enemy_xm1014;
    }

    /**
     * @param \DateTimeImmutable $kill_enemy_xm1014
     */
    public function setKillEnemyXm1014(\DateTimeImmutable $kill_enemy_xm1014): void
    {
        $this->kill_enemy_xm1014 = $kill_enemy_xm1014;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getMetaShotgun(): \DateTimeImmutable
    {
        return $this->meta_shotgun;
    }

    /**
     * @param \DateTimeImmutable $meta_shotgun
     */
    public function setMetaShotgun(\DateTimeImmutable $meta_shotgun): void
    {
        $this->meta_shotgun = $meta_shotgun;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getKillEnemyHegrenade(): \DateTimeImmutable
    {
        return $this->kill_enemy_hegrenade;
    }

    /**
     * @param \DateTimeImmutable $kill_enemy_hegrenade
     */
    public function setKillEnemyHegrenade(\DateTimeImmutable $kill_enemy_hegrenade): void
    {
        $this->kill_enemy_hegrenade = $kill_enemy_hegrenade;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getKillEnemyKnife(): \DateTimeImmutable
    {
        return $this->kill_enemy_knife;
    }

    /**
     * @param \DateTimeImmutable $kill_enemy_knife
     */
    public function setKillEnemyKnife(\DateTimeImmutable $kill_enemy_knife): void
    {
        $this->kill_enemy_knife = $kill_enemy_knife;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getKillEnemyM249(): \DateTimeImmutable
    {
        return $this->kill_enemy_m249;
    }

    /**
     * @param \DateTimeImmutable $kill_enemy_m249
     */
    public function setKillEnemyM249(\DateTimeImmutable $kill_enemy_m249): void
    {
        $this->kill_enemy_m249 = $kill_enemy_m249;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getMetaWeaponmaster(): \DateTimeImmutable
    {
        return $this->meta_weaponmaster;
    }

    /**
     * @param \DateTimeImmutable $meta_weaponmaster
     */
    public function setMetaWeaponmaster(\DateTimeImmutable $meta_weaponmaster): void
    {
        $this->meta_weaponmaster = $meta_weaponmaster;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getKillEnemyTeam(): \DateTimeImmutable
    {
        return $this->kill_enemy_team;
    }

    /**
     * @param \DateTimeImmutable $kill_enemy_team
     */
    public function setKillEnemyTeam(\DateTimeImmutable $kill_enemy_team): void
    {
        $this->kill_enemy_team = $kill_enemy_team;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getKillsWithMultipleGuns(): \DateTimeImmutable
    {
        return $this->kills_with_multiple_guns;
    }

    /**
     * @param \DateTimeImmutable $kills_with_multiple_guns
     */
    public function setKillsWithMultipleGuns(\DateTimeImmutable $kills_with_multiple_guns): void
    {
        $this->kills_with_multiple_guns = $kills_with_multiple_guns;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getKillHostageRescuer(): \DateTimeImmutable
    {
        return $this->kill_hostage_rescuer;
    }

    /**
     * @param \DateTimeImmutable $kill_hostage_rescuer
     */
    public function setKillHostageRescuer(\DateTimeImmutable $kill_hostage_rescuer): void
    {
        $this->kill_hostage_rescuer = $kill_hostage_rescuer;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getLastPlayerAlive(): \DateTimeImmutable
    {
        return $this->last_player_alive;
    }

    /**
     * @param \DateTimeImmutable $last_player_alive
     */
    public function setLastPlayerAlive(\DateTimeImmutable $last_player_alive): void
    {
        $this->last_player_alive = $last_player_alive;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getKillEnemyLastBullet(): \DateTimeImmutable
    {
        return $this->kill_enemy_last_bullet;
    }

    /**
     * @param \DateTimeImmutable $kill_enemy_last_bullet
     */
    public function setKillEnemyLastBullet(\DateTimeImmutable $kill_enemy_last_bullet): void
    {
        $this->kill_enemy_last_bullet = $kill_enemy_last_bullet;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getKillingSpreeEnder(): \DateTimeImmutable
    {
        return $this->killing_spree_ender;
    }

    /**
     * @param \DateTimeImmutable $killing_spree_ender
     */
    public function setKillingSpreeEnder(\DateTimeImmutable $killing_spree_ender): void
    {
        $this->killing_spree_ender = $killing_spree_ender;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getBreakWindows(): \DateTimeImmutable
    {
        return $this->break_windows;
    }

    /**
     * @param \DateTimeImmutable $break_windows
     */
    public function setBreakWindows(\DateTimeImmutable $break_windows): void
    {
        $this->break_windows = $break_windows;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getHeadshots(): \DateTimeImmutable
    {
        return $this->headshots;
    }

    /**
     * @param \DateTimeImmutable $headshots
     */
    public function setHeadshots(\DateTimeImmutable $headshots): void
    {
        $this->headshots = $headshots;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getDamageNoKill(): \DateTimeImmutable
    {
        return $this->damage_no_kill;
    }

    /**
     * @param \DateTimeImmutable $damage_no_kill
     */
    public function setDamageNoKill(\DateTimeImmutable $damage_no_kill): void
    {
        $this->damage_no_kill = $damage_no_kill;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getKillLowDamage(): \DateTimeImmutable
    {
        return $this->kill_low_damage;
    }

    /**
     * @param \DateTimeImmutable $kill_low_damage
     */
    public function setKillLowDamage(\DateTimeImmutable $kill_low_damage): void
    {
        $this->kill_low_damage = $kill_low_damage;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getKillEnemyReloading(): \DateTimeImmutable
    {
        return $this->kill_enemy_reloading;
    }

    /**
     * @param \DateTimeImmutable $kill_enemy_reloading
     */
    public function setKillEnemyReloading(\DateTimeImmutable $kill_enemy_reloading): void
    {
        $this->kill_enemy_reloading = $kill_enemy_reloading;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getKillEnemyBlinded(): \DateTimeImmutable
    {
        return $this->kill_enemy_blinded;
    }

    /**
     * @param \DateTimeImmutable $kill_enemy_blinded
     */
    public function setKillEnemyBlinded(\DateTimeImmutable $kill_enemy_blinded): void
    {
        $this->kill_enemy_blinded = $kill_enemy_blinded;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getKillEnemiesWhileBlind(): \DateTimeImmutable
    {
        return $this->kill_enemies_while_blind;
    }

    /**
     * @param \DateTimeImmutable $kill_enemies_while_blind
     */
    public function setKillEnemiesWhileBlind(\DateTimeImmutable $kill_enemies_while_blind): void
    {
        $this->kill_enemies_while_blind = $kill_enemies_while_blind;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getKillsEnemyWeapon(): \DateTimeImmutable
    {
        return $this->kills_enemy_weapon;
    }

    /**
     * @param \DateTimeImmutable $kills_enemy_weapon
     */
    public function setKillsEnemyWeapon(\DateTimeImmutable $kills_enemy_weapon): void
    {
        $this->kills_enemy_weapon = $kills_enemy_weapon;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getKillWithEveryWeapon(): \DateTimeImmutable
    {
        return $this->kill_with_every_weapon;
    }

    /**
     * @param \DateTimeImmutable $kill_with_every_weapon
     */
    public function setKillWithEveryWeapon(\DateTimeImmutable $kill_with_every_weapon): void
    {
        $this->kill_with_every_weapon = $kill_with_every_weapon;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getSurviveGrenade(): \DateTimeImmutable
    {
        return $this->survive_grenade;
    }

    /**
     * @param \DateTimeImmutable $survive_grenade
     */
    public function setSurviveGrenade(\DateTimeImmutable $survive_grenade): void
    {
        $this->survive_grenade = $survive_grenade;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getWinKnifeFightsLow(): \DateTimeImmutable
    {
        return $this->win_knife_fights_low;
    }

    /**
     * @param \DateTimeImmutable $win_knife_fights_low
     */
    public function setWinKnifeFightsLow(\DateTimeImmutable $win_knife_fights_low): void
    {
        $this->win_knife_fights_low = $win_knife_fights_low;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getWinKnifeFightsHigh(): \DateTimeImmutable
    {
        return $this->win_knife_fights_high;
    }

    /**
     * @param \DateTimeImmutable $win_knife_fights_high
     */
    public function setWinKnifeFightsHigh(\DateTimeImmutable $win_knife_fights_high): void
    {
        $this->win_knife_fights_high = $win_knife_fights_high;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getKilledDefuserWithGrenade(): \DateTimeImmutable
    {
        return $this->killed_defuser_with_grenade;
    }

    /**
     * @param \DateTimeImmutable $killed_defuser_with_grenade
     */
    public function setKilledDefuserWithGrenade(\DateTimeImmutable $killed_defuser_with_grenade): void
    {
        $this->killed_defuser_with_grenade = $killed_defuser_with_grenade;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getHipShot(): \DateTimeImmutable
    {
        return $this->hip_shot;
    }

    /**
     * @param \DateTimeImmutable $hip_shot
     */
    public function setHipShot(\DateTimeImmutable $hip_shot): void
    {
        $this->hip_shot = $hip_shot;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getKillSniperWithSniper(): \DateTimeImmutable
    {
        return $this->kill_sniper_with_sniper;
    }

    /**
     * @param \DateTimeImmutable $kill_sniper_with_sniper
     */
    public function setKillSniperWithSniper(\DateTimeImmutable $kill_sniper_with_sniper): void
    {
        $this->kill_sniper_with_sniper = $kill_sniper_with_sniper;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getKillSniperWithKnife(): \DateTimeImmutable
    {
        return $this->kill_sniper_with_knife;
    }

    /**
     * @param \DateTimeImmutable $kill_sniper_with_knife
     */
    public function setKillSniperWithKnife(\DateTimeImmutable $kill_sniper_with_knife): void
    {
        $this->kill_sniper_with_knife = $kill_sniper_with_knife;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getKillSnipers(): \DateTimeImmutable
    {
        return $this->kill_snipers;
    }

    /**
     * @param \DateTimeImmutable $kill_snipers
     */
    public function setKillSnipers(\DateTimeImmutable $kill_snipers): void
    {
        $this->kill_snipers = $kill_snipers;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getKillWhenAtLowHealth(): \DateTimeImmutable
    {
        return $this->kill_when_at_low_health;
    }

    /**
     * @param \DateTimeImmutable $kill_when_at_low_health
     */
    public function setKillWhenAtLowHealth(\DateTimeImmutable $kill_when_at_low_health): void
    {
        $this->kill_when_at_low_health = $kill_when_at_low_health;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getGrenadeMultikill(): \DateTimeImmutable
    {
        return $this->grenade_multikill;
    }

    /**
     * @param \DateTimeImmutable $grenade_multikill
     */
    public function setGrenadeMultikill(\DateTimeImmutable $grenade_multikill): void
    {
        $this->grenade_multikill = $grenade_multikill;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getPistolRoundKnifeKill(): \DateTimeImmutable
    {
        return $this->pistol_round_knife_kill;
    }

    /**
     * @param \DateTimeImmutable $pistol_round_knife_kill
     */
    public function setPistolRoundKnifeKill(\DateTimeImmutable $pistol_round_knife_kill): void
    {
        $this->pistol_round_knife_kill = $pistol_round_knife_kill;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getFastRoundWin(): \DateTimeImmutable
    {
        return $this->fast_round_win;
    }

    /**
     * @param \DateTimeImmutable $fast_round_win
     */
    public function setFastRoundWin(\DateTimeImmutable $fast_round_win): void
    {
        $this->fast_round_win = $fast_round_win;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getWinPistolroundsLow(): \DateTimeImmutable
    {
        return $this->win_pistolrounds_low;
    }

    /**
     * @param \DateTimeImmutable $win_pistolrounds_low
     */
    public function setWinPistolroundsLow(\DateTimeImmutable $win_pistolrounds_low): void
    {
        $this->win_pistolrounds_low = $win_pistolrounds_low;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getWinPistolroundsMed(): \DateTimeImmutable
    {
        return $this->win_pistolrounds_med;
    }

    /**
     * @param \DateTimeImmutable $win_pistolrounds_med
     */
    public function setWinPistolroundsMed(\DateTimeImmutable $win_pistolrounds_med): void
    {
        $this->win_pistolrounds_med = $win_pistolrounds_med;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getWinPistolroundsHigh(): \DateTimeImmutable
    {
        return $this->win_pistolrounds_high;
    }

    /**
     * @param \DateTimeImmutable $win_pistolrounds_high
     */
    public function setWinPistolroundsHigh(\DateTimeImmutable $win_pistolrounds_high): void
    {
        $this->win_pistolrounds_high = $win_pistolrounds_high;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getBombMultikill(): \DateTimeImmutable
    {
        return $this->bomb_multikill;
    }

    /**
     * @param \DateTimeImmutable $bomb_multikill
     */
    public function setBombMultikill(\DateTimeImmutable $bomb_multikill): void
    {
        $this->bomb_multikill = $bomb_multikill;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getGooseChase(): \DateTimeImmutable
    {
        return $this->goose_chase;
    }

    /**
     * @param \DateTimeImmutable $goose_chase
     */
    public function setGooseChase(\DateTimeImmutable $goose_chase): void
    {
        $this->goose_chase = $goose_chase;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getWinBombPlantAfterRecovery(): \DateTimeImmutable
    {
        return $this->win_bomb_plant_after_recovery;
    }

    /**
     * @param \DateTimeImmutable $win_bomb_plant_after_recovery
     */
    public function setWinBombPlantAfterRecovery(\DateTimeImmutable $win_bomb_plant_after_recovery): void
    {
        $this->win_bomb_plant_after_recovery = $win_bomb_plant_after_recovery;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getSurviveManyAttacks(): \DateTimeImmutable
    {
        return $this->survive_many_attacks;
    }

    /**
     * @param \DateTimeImmutable $survive_many_attacks
     */
    public function setSurviveManyAttacks(\DateTimeImmutable $survive_many_attacks): void
    {
        $this->survive_many_attacks = $survive_many_attacks;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getLosslessExtermination(): \DateTimeImmutable
    {
        return $this->lossless_extermination;
    }

    /**
     * @param \DateTimeImmutable $lossless_extermination
     */
    public function setLosslessExtermination(\DateTimeImmutable $lossless_extermination): void
    {
        $this->lossless_extermination = $lossless_extermination;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getFlawlessVictory(): \DateTimeImmutable
    {
        return $this->flawless_victory;
    }

    /**
     * @param \DateTimeImmutable $flawless_victory
     */
    public function setFlawlessVictory(\DateTimeImmutable $flawless_victory): void
    {
        $this->flawless_victory = $flawless_victory;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getWinDualDuel(): \DateTimeImmutable
    {
        return $this->win_dual_duel;
    }

    /**
     * @param \DateTimeImmutable $win_dual_duel
     */
    public function setWinDualDuel(\DateTimeImmutable $win_dual_duel): void
    {
        $this->win_dual_duel = $win_dual_duel;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getUnstoppableForce(): \DateTimeImmutable
    {
        return $this->unstoppable_force;
    }

    /**
     * @param \DateTimeImmutable $unstoppable_force
     */
    public function setUnstoppableForce(\DateTimeImmutable $unstoppable_force): void
    {
        $this->unstoppable_force = $unstoppable_force;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getImmovableObject(): \DateTimeImmutable
    {
        return $this->immovable_object;
    }

    /**
     * @param \DateTimeImmutable $immovable_object
     */
    public function setImmovableObject(\DateTimeImmutable $immovable_object): void
    {
        $this->immovable_object = $immovable_object;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getHeadshotsInRound(): \DateTimeImmutable
    {
        return $this->headshots_in_round;
    }

    /**
     * @param \DateTimeImmutable $headshots_in_round
     */
    public function setHeadshotsInRound(\DateTimeImmutable $headshots_in_round): void
    {
        $this->headshots_in_round = $headshots_in_round;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getWinMapCsItaly(): \DateTimeImmutable
    {
        return $this->win_map_cs_italy;
    }

    /**
     * @param \DateTimeImmutable $win_map_cs_italy
     */
    public function setWinMapCsItaly(\DateTimeImmutable $win_map_cs_italy): void
    {
        $this->win_map_cs_italy = $win_map_cs_italy;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getWinMapCsOffice(): \DateTimeImmutable
    {
        return $this->win_map_cs_office;
    }

    /**
     * @param \DateTimeImmutable $win_map_cs_office
     */
    public function setWinMapCsOffice(\DateTimeImmutable $win_map_cs_office): void
    {
        $this->win_map_cs_office = $win_map_cs_office;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getWinMapDeAztec(): \DateTimeImmutable
    {
        return $this->win_map_de_aztec;
    }

    /**
     * @param \DateTimeImmutable $win_map_de_aztec
     */
    public function setWinMapDeAztec(\DateTimeImmutable $win_map_de_aztec): void
    {
        $this->win_map_de_aztec = $win_map_de_aztec;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getWinMapDeDust(): \DateTimeImmutable
    {
        return $this->win_map_de_dust;
    }

    /**
     * @param \DateTimeImmutable $win_map_de_dust
     */
    public function setWinMapDeDust(\DateTimeImmutable $win_map_de_dust): void
    {
        $this->win_map_de_dust = $win_map_de_dust;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getWinMapDeDust2(): \DateTimeImmutable
    {
        return $this->win_map_de_dust2;
    }

    /**
     * @param \DateTimeImmutable $win_map_de_dust2
     */
    public function setWinMapDeDust2(\DateTimeImmutable $win_map_de_dust2): void
    {
        $this->win_map_de_dust2 = $win_map_de_dust2;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getWinMapDeInferno(): \DateTimeImmutable
    {
        return $this->win_map_de_inferno;
    }

    /**
     * @param \DateTimeImmutable $win_map_de_inferno
     */
    public function setWinMapDeInferno(\DateTimeImmutable $win_map_de_inferno): void
    {
        $this->win_map_de_inferno = $win_map_de_inferno;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getWinMapDeNuke(): \DateTimeImmutable
    {
        return $this->win_map_de_nuke;
    }

    /**
     * @param \DateTimeImmutable $win_map_de_nuke
     */
    public function setWinMapDeNuke(\DateTimeImmutable $win_map_de_nuke): void
    {
        $this->win_map_de_nuke = $win_map_de_nuke;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getWinMapDeShorttrain(): \DateTimeImmutable
    {
        return $this->win_map_de_shorttrain;
    }

    /**
     * @param \DateTimeImmutable $win_map_de_shorttrain
     */
    public function setWinMapDeShorttrain(\DateTimeImmutable $win_map_de_shorttrain): void
    {
        $this->win_map_de_shorttrain = $win_map_de_shorttrain;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getKillWhileInAir(): \DateTimeImmutable
    {
        return $this->kill_while_in_air;
    }

    /**
     * @param \DateTimeImmutable $kill_while_in_air
     */
    public function setKillWhileInAir(\DateTimeImmutable $kill_while_in_air): void
    {
        $this->kill_while_in_air = $kill_while_in_air;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getKillEnemyInAir(): \DateTimeImmutable
    {
        return $this->kill_enemy_in_air;
    }

    /**
     * @param \DateTimeImmutable $kill_enemy_in_air
     */
    public function setKillEnemyInAir(\DateTimeImmutable $kill_enemy_in_air): void
    {
        $this->kill_enemy_in_air = $kill_enemy_in_air;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getKillerAndEnemyInAir(): \DateTimeImmutable
    {
        return $this->killer_and_enemy_in_air;
    }

    /**
     * @param \DateTimeImmutable $killer_and_enemy_in_air
     */
    public function setKillerAndEnemyInAir(\DateTimeImmutable $killer_and_enemy_in_air): void
    {
        $this->killer_and_enemy_in_air = $killer_and_enemy_in_air;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getSilentWin(): \DateTimeImmutable
    {
        return $this->silent_win;
    }

    /**
     * @param \DateTimeImmutable $silent_win
     */
    public function setSilentWin(\DateTimeImmutable $silent_win): void
    {
        $this->silent_win = $silent_win;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getBloodlessVictory(): \DateTimeImmutable
    {
        return $this->bloodless_victory;
    }

    /**
     * @param \DateTimeImmutable $bloodless_victory
     */
    public function setBloodlessVictory(\DateTimeImmutable $bloodless_victory): void
    {
        $this->bloodless_victory = $bloodless_victory;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getDonateWeapons(): \DateTimeImmutable
    {
        return $this->donate_weapons;
    }

    /**
     * @param \DateTimeImmutable $donate_weapons
     */
    public function setDonateWeapons(\DateTimeImmutable $donate_weapons): void
    {
        $this->donate_weapons = $donate_weapons;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getWinRoundsWithoutBuying(): \DateTimeImmutable
    {
        return $this->win_rounds_without_buying;
    }

    /**
     * @param \DateTimeImmutable $win_rounds_without_buying
     */
    public function setWinRoundsWithoutBuying(\DateTimeImmutable $win_rounds_without_buying): void
    {
        $this->win_rounds_without_buying = $win_rounds_without_buying;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getDefuseDefense(): \DateTimeImmutable
    {
        return $this->defuse_defense;
    }

    /**
     * @param \DateTimeImmutable $defuse_defense
     */
    public function setDefuseDefense(\DateTimeImmutable $defuse_defense): void
    {
        $this->defuse_defense = $defuse_defense;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getKillBombPickup(): \DateTimeImmutable
    {
        return $this->kill_bomb_pickup;
    }

    /**
     * @param \DateTimeImmutable $kill_bomb_pickup
     */
    public function setKillBombPickup(\DateTimeImmutable $kill_bomb_pickup): void
    {
        $this->kill_bomb_pickup = $kill_bomb_pickup;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getDominationsLow(): \DateTimeImmutable
    {
        return $this->dominations_low;
    }

    /**
     * @param \DateTimeImmutable $dominations_low
     */
    public function setDominationsLow(\DateTimeImmutable $dominations_low): void
    {
        $this->dominations_low = $dominations_low;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getDominationsHigh(): \DateTimeImmutable
    {
        return $this->dominations_high;
    }

    /**
     * @param \DateTimeImmutable $dominations_high
     */
    public function setDominationsHigh(\DateTimeImmutable $dominations_high): void
    {
        $this->dominations_high = $dominations_high;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getDominationOverkillsLow(): \DateTimeImmutable
    {
        return $this->domination_overkills_low;
    }

    /**
     * @param \DateTimeImmutable $domination_overkills_low
     */
    public function setDominationOverkillsLow(\DateTimeImmutable $domination_overkills_low): void
    {
        $this->domination_overkills_low = $domination_overkills_low;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getDominationOverkillsHigh(): \DateTimeImmutable
    {
        return $this->domination_overkills_high;
    }

    /**
     * @param \DateTimeImmutable $domination_overkills_high
     */
    public function setDominationOverkillsHigh(\DateTimeImmutable $domination_overkills_high): void
    {
        $this->domination_overkills_high = $domination_overkills_high;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getRevengesLow(): \DateTimeImmutable
    {
        return $this->revenges_low;
    }

    /**
     * @param \DateTimeImmutable $revenges_low
     */
    public function setRevengesLow(\DateTimeImmutable $revenges_low): void
    {
        $this->revenges_low = $revenges_low;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getRevengesHigh(): \DateTimeImmutable
    {
        return $this->revenges_high;
    }

    /**
     * @param \DateTimeImmutable $revenges_high
     */
    public function setRevengesHigh(\DateTimeImmutable $revenges_high): void
    {
        $this->revenges_high = $revenges_high;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getConcurrentDominations(): \DateTimeImmutable
    {
        return $this->concurrent_dominations;
    }

    /**
     * @param \DateTimeImmutable $concurrent_dominations
     */
    public function setConcurrentDominations(\DateTimeImmutable $concurrent_dominations): void
    {
        $this->concurrent_dominations = $concurrent_dominations;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getDominationOverkillsMatch(): \DateTimeImmutable
    {
        return $this->domination_overkills_match;
    }

    /**
     * @param \DateTimeImmutable $domination_overkills_match
     */
    public function setDominationOverkillsMatch(\DateTimeImmutable $domination_overkills_match): void
    {
        $this->domination_overkills_match = $domination_overkills_match;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getExtendedDomination(): \DateTimeImmutable
    {
        return $this->extended_domination;
    }

    /**
     * @param \DateTimeImmutable $extended_domination
     */
    public function setExtendedDomination(\DateTimeImmutable $extended_domination): void
    {
        $this->extended_domination = $extended_domination;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getKillEnemiesWhileBlindHard(): \DateTimeImmutable
    {
        return $this->kill_enemies_while_blind_hard;
    }

    /**
     * @param \DateTimeImmutable $kill_enemies_while_blind_hard
     */
    public function setKillEnemiesWhileBlindHard(\DateTimeImmutable $kill_enemies_while_blind_hard): void
    {
        $this->kill_enemies_while_blind_hard = $kill_enemies_while_blind_hard;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getCauseFriendlyFireWithFlashbang(): \DateTimeImmutable
    {
        return $this->cause_friendly_fire_with_flashbang;
    }

    /**
     * @param \DateTimeImmutable $cause_friendly_fire_with_flashbang
     */
    public function setCauseFriendlyFireWithFlashbang(\DateTimeImmutable $cause_friendly_fire_with_flashbang): void
    {
        $this->cause_friendly_fire_with_flashbang = $cause_friendly_fire_with_flashbang;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getAvengeFriend(): \DateTimeImmutable
    {
        return $this->avenge_friend;
    }

    /**
     * @param \DateTimeImmutable $avenge_friend
     */
    public function setAvengeFriend(\DateTimeImmutable $avenge_friend): void
    {
        $this->avenge_friend = $avenge_friend;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getGunGameKillKnifer(): \DateTimeImmutable
    {
        return $this->gun_game_kill_knifer;
    }

    /**
     * @param \DateTimeImmutable $gun_game_kill_knifer
     */
    public function setGunGameKillKnifer(\DateTimeImmutable $gun_game_kill_knifer): void
    {
        $this->gun_game_kill_knifer = $gun_game_kill_knifer;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getWinEveryGungameMap(): \DateTimeImmutable
    {
        return $this->win_every_gungame_map;
    }

    /**
     * @param \DateTimeImmutable $win_every_gungame_map
     */
    public function setWinEveryGungameMap(\DateTimeImmutable $win_every_gungame_map): void
    {
        $this->win_every_gungame_map = $win_every_gungame_map;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getWinMapArShoots(): \DateTimeImmutable
    {
        return $this->win_map_ar_shoots;
    }

    /**
     * @param \DateTimeImmutable $win_map_ar_shoots
     */
    public function setWinMapArShoots(\DateTimeImmutable $win_map_ar_shoots): void
    {
        $this->win_map_ar_shoots = $win_map_ar_shoots;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getTrBombPlantLow(): \DateTimeImmutable
    {
        return $this->tr_bomb_plant_low;
    }

    /**
     * @param \DateTimeImmutable $tr_bomb_plant_low
     */
    public function setTrBombPlantLow(\DateTimeImmutable $tr_bomb_plant_low): void
    {
        $this->tr_bomb_plant_low = $tr_bomb_plant_low;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getTrBombDefuseLow(): \DateTimeImmutable
    {
        return $this->tr_bomb_defuse_low;
    }

    /**
     * @param \DateTimeImmutable $tr_bomb_defuse_low
     */
    public function setTrBombDefuseLow(\DateTimeImmutable $tr_bomb_defuse_low): void
    {
        $this->tr_bomb_defuse_low = $tr_bomb_defuse_low;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getWinMapDeLake(): \DateTimeImmutable
    {
        return $this->win_map_de_lake;
    }

    /**
     * @param \DateTimeImmutable $win_map_de_lake
     */
    public function setWinMapDeLake(\DateTimeImmutable $win_map_de_lake): void
    {
        $this->win_map_de_lake = $win_map_de_lake;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getWinMapDeSafehouse(): \DateTimeImmutable
    {
        return $this->win_map_de_safehouse;
    }

    /**
     * @param \DateTimeImmutable $win_map_de_safehouse
     */
    public function setWinMapDeSafehouse(\DateTimeImmutable $win_map_de_safehouse): void
    {
        $this->win_map_de_safehouse = $win_map_de_safehouse;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getWinMapDeSugarcane(): \DateTimeImmutable
    {
        return $this->win_map_de_sugarcane;
    }

    /**
     * @param \DateTimeImmutable $win_map_de_sugarcane
     */
    public function setWinMapDeSugarcane(\DateTimeImmutable $win_map_de_sugarcane): void
    {
        $this->win_map_de_sugarcane = $win_map_de_sugarcane;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getWinMapDeStmarc(): \DateTimeImmutable
    {
        return $this->win_map_de_stmarc;
    }

    /**
     * @param \DateTimeImmutable $win_map_de_stmarc
     */
    public function setWinMapDeStmarc(\DateTimeImmutable $win_map_de_stmarc): void
    {
        $this->win_map_de_stmarc = $win_map_de_stmarc;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getGunGameKnifeKillKnifer(): \DateTimeImmutable
    {
        return $this->gun_game_knife_kill_knifer;
    }

    /**
     * @param \DateTimeImmutable $gun_game_knife_kill_knifer
     */
    public function setGunGameKnifeKillKnifer(\DateTimeImmutable $gun_game_knife_kill_knifer): void
    {
        $this->gun_game_knife_kill_knifer = $gun_game_knife_kill_knifer;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getGunGameSmgKillKnifer(): \DateTimeImmutable
    {
        return $this->gun_game_smg_kill_knifer;
    }

    /**
     * @param \DateTimeImmutable $gun_game_smg_kill_knifer
     */
    public function setGunGameSmgKillKnifer(\DateTimeImmutable $gun_game_smg_kill_knifer): void
    {
        $this->gun_game_smg_kill_knifer = $gun_game_smg_kill_knifer;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getGunGameRoundsLow(): \DateTimeImmutable
    {
        return $this->gun_game_rounds_low;
    }

    /**
     * @param \DateTimeImmutable $gun_game_rounds_low
     */
    public function setGunGameRoundsLow(\DateTimeImmutable $gun_game_rounds_low): void
    {
        $this->gun_game_rounds_low = $gun_game_rounds_low;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getGunGameRoundsMed(): \DateTimeImmutable
    {
        return $this->gun_game_rounds_med;
    }

    /**
     * @param \DateTimeImmutable $gun_game_rounds_med
     */
    public function setGunGameRoundsMed(\DateTimeImmutable $gun_game_rounds_med): void
    {
        $this->gun_game_rounds_med = $gun_game_rounds_med;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getGunGameRoundsHigh(): \DateTimeImmutable
    {
        return $this->gun_game_rounds_high;
    }

    /**
     * @param \DateTimeImmutable $gun_game_rounds_high
     */
    public function setGunGameRoundsHigh(\DateTimeImmutable $gun_game_rounds_high): void
    {
        $this->gun_game_rounds_high = $gun_game_rounds_high;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getWinGunGameRoundsLow(): \DateTimeImmutable
    {
        return $this->win_gun_game_rounds_low;
    }

    /**
     * @param \DateTimeImmutable $win_gun_game_rounds_low
     */
    public function setWinGunGameRoundsLow(\DateTimeImmutable $win_gun_game_rounds_low): void
    {
        $this->win_gun_game_rounds_low = $win_gun_game_rounds_low;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getWinGunGameRoundsMed(): \DateTimeImmutable
    {
        return $this->win_gun_game_rounds_med;
    }

    /**
     * @param \DateTimeImmutable $win_gun_game_rounds_med
     */
    public function setWinGunGameRoundsMed(\DateTimeImmutable $win_gun_game_rounds_med): void
    {
        $this->win_gun_game_rounds_med = $win_gun_game_rounds_med;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getWinGunGameRoundsHigh(): \DateTimeImmutable
    {
        return $this->win_gun_game_rounds_high;
    }

    /**
     * @param \DateTimeImmutable $win_gun_game_rounds_high
     */
    public function setWinGunGameRoundsHigh(\DateTimeImmutable $win_gun_game_rounds_high): void
    {
        $this->win_gun_game_rounds_high = $win_gun_game_rounds_high;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getWinGunGameRoundsExtreme(): \DateTimeImmutable
    {
        return $this->win_gun_game_rounds_extreme;
    }

    /**
     * @param \DateTimeImmutable $win_gun_game_rounds_extreme
     */
    public function setWinGunGameRoundsExtreme(\DateTimeImmutable $win_gun_game_rounds_extreme): void
    {
        $this->win_gun_game_rounds_extreme = $win_gun_game_rounds_extreme;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getWinGunGameRoundsUltimate(): \DateTimeImmutable
    {
        return $this->win_gun_game_rounds_ultimate;
    }

    /**
     * @param \DateTimeImmutable $win_gun_game_rounds_ultimate
     */
    public function setWinGunGameRoundsUltimate(\DateTimeImmutable $win_gun_game_rounds_ultimate): void
    {
        $this->win_gun_game_rounds_ultimate = $win_gun_game_rounds_ultimate;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getPlayEveryGungameMap(): \DateTimeImmutable
    {
        return $this->play_every_gungame_map;
    }

    /**
     * @param \DateTimeImmutable $play_every_gungame_map
     */
    public function setPlayEveryGungameMap(\DateTimeImmutable $play_every_gungame_map): void
    {
        $this->play_every_gungame_map = $play_every_gungame_map;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getGunGameRampage(): \DateTimeImmutable
    {
        return $this->gun_game_rampage;
    }

    /**
     * @param \DateTimeImmutable $gun_game_rampage
     */
    public function setGunGameRampage(\DateTimeImmutable $gun_game_rampage): void
    {
        $this->gun_game_rampage = $gun_game_rampage;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getGunGameFirstKill(): \DateTimeImmutable
    {
        return $this->gun_game_first_kill;
    }

    /**
     * @param \DateTimeImmutable $gun_game_first_kill
     */
    public function setGunGameFirstKill(\DateTimeImmutable $gun_game_first_kill): void
    {
        $this->gun_game_first_kill = $gun_game_first_kill;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getGunGameFirstThingFirst(): \DateTimeImmutable
    {
        return $this->gun_game_first_thing_first;
    }

    /**
     * @param \DateTimeImmutable $gun_game_first_thing_first
     */
    public function setGunGameFirstThingFirst(\DateTimeImmutable $gun_game_first_thing_first): void
    {
        $this->gun_game_first_thing_first = $gun_game_first_thing_first;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getGunGameTargetSecured(): \DateTimeImmutable
    {
        return $this->gun_game_target_secured;
    }

    /**
     * @param \DateTimeImmutable $gun_game_target_secured
     */
    public function setGunGameTargetSecured(\DateTimeImmutable $gun_game_target_secured): void
    {
        $this->gun_game_target_secured = $gun_game_target_secured;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getOneShotOneKill(): \DateTimeImmutable
    {
        return $this->one_shot_one_kill;
    }

    /**
     * @param \DateTimeImmutable $one_shot_one_kill
     */
    public function setOneShotOneKill(\DateTimeImmutable $one_shot_one_kill): void
    {
        $this->one_shot_one_kill = $one_shot_one_kill;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getGunGameConservationist(): \DateTimeImmutable
    {
        return $this->gun_game_conservationist;
    }

    /**
     * @param \DateTimeImmutable $gun_game_conservationist
     */
    public function setGunGameConservationist(\DateTimeImmutable $gun_game_conservationist): void
    {
        $this->gun_game_conservationist = $gun_game_conservationist;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getBaseScamper(): \DateTimeImmutable
    {
        return $this->base_scamper;
    }

    /**
     * @param \DateTimeImmutable $base_scamper
     */
    public function setBaseScamper(\DateTimeImmutable $base_scamper): void
    {
        $this->base_scamper = $base_scamper;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getBornReady(): \DateTimeImmutable
    {
        return $this->born_ready;
    }

    /**
     * @param \DateTimeImmutable $born_ready
     */
    public function setBornReady(\DateTimeImmutable $born_ready): void
    {
        $this->born_ready = $born_ready;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getStillAlive(): \DateTimeImmutable
    {
        return $this->still_alive;
    }

    /**
     * @param \DateTimeImmutable $still_alive
     */
    public function setStillAlive(\DateTimeImmutable $still_alive): void
    {
        $this->still_alive = $still_alive;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getMedalist(): \DateTimeImmutable
    {
        return $this->medalist;
    }

    /**
     * @param \DateTimeImmutable $medalist
     */
    public function setMedalist(\DateTimeImmutable $medalist): void
    {
        $this->medalist = $medalist;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getWinMapDeBank(): \DateTimeImmutable
    {
        return $this->win_map_de_bank;
    }

    /**
     * @param \DateTimeImmutable $win_map_de_bank
     */
    public function setWinMapDeBank(\DateTimeImmutable $win_map_de_bank): void
    {
        $this->win_map_de_bank = $win_map_de_bank;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getWinMapArBaggage(): \DateTimeImmutable
    {
        return $this->win_map_ar_baggage;
    }

    /**
     * @param \DateTimeImmutable $win_map_ar_baggage
     */
    public function setWinMapArBaggage(\DateTimeImmutable $win_map_ar_baggage): void
    {
        $this->win_map_ar_baggage = $win_map_ar_baggage;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getKillEnemyBizon(): \DateTimeImmutable
    {
        return $this->kill_enemy_bizon;
    }

    /**
     * @param \DateTimeImmutable $kill_enemy_bizon
     */
    public function setKillEnemyBizon(\DateTimeImmutable $kill_enemy_bizon): void
    {
        $this->kill_enemy_bizon = $kill_enemy_bizon;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getKillEnemyTec9(): \DateTimeImmutable
    {
        return $this->kill_enemy_tec9;
    }

    /**
     * @param \DateTimeImmutable $kill_enemy_tec9
     */
    public function setKillEnemyTec9(\DateTimeImmutable $kill_enemy_tec9): void
    {
        $this->kill_enemy_tec9 = $kill_enemy_tec9;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getKillEnemyTaser(): \DateTimeImmutable
    {
        return $this->kill_enemy_taser;
    }

    /**
     * @param \DateTimeImmutable $kill_enemy_taser
     */
    public function setKillEnemyTaser(\DateTimeImmutable $kill_enemy_taser): void
    {
        $this->kill_enemy_taser = $kill_enemy_taser;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getKillEnemyHkp2000(): \DateTimeImmutable
    {
        return $this->kill_enemy_hkp2000;
    }

    /**
     * @param \DateTimeImmutable $kill_enemy_hkp2000
     */
    public function setKillEnemyHkp2000(\DateTimeImmutable $kill_enemy_hkp2000): void
    {
        $this->kill_enemy_hkp2000 = $kill_enemy_hkp2000;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getKillEnemyP250(): \DateTimeImmutable
    {
        return $this->kill_enemy_p250;
    }

    /**
     * @param \DateTimeImmutable $kill_enemy_p250
     */
    public function setKillEnemyP250(\DateTimeImmutable $kill_enemy_p250): void
    {
        $this->kill_enemy_p250 = $kill_enemy_p250;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getKillEnemyScar20(): \DateTimeImmutable
    {
        return $this->kill_enemy_scar20;
    }

    /**
     * @param \DateTimeImmutable $kill_enemy_scar20
     */
    public function setKillEnemyScar20(\DateTimeImmutable $kill_enemy_scar20): void
    {
        $this->kill_enemy_scar20 = $kill_enemy_scar20;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getKillEnemySg556(): \DateTimeImmutable
    {
        return $this->kill_enemy_sg556;
    }

    /**
     * @param \DateTimeImmutable $kill_enemy_sg556
     */
    public function setKillEnemySg556(\DateTimeImmutable $kill_enemy_sg556): void
    {
        $this->kill_enemy_sg556 = $kill_enemy_sg556;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getKillEnemySsg08(): \DateTimeImmutable
    {
        return $this->kill_enemy_ssg08;
    }

    /**
     * @param \DateTimeImmutable $kill_enemy_ssg08
     */
    public function setKillEnemySsg08(\DateTimeImmutable $kill_enemy_ssg08): void
    {
        $this->kill_enemy_ssg08 = $kill_enemy_ssg08;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getKillEnemyMp7(): \DateTimeImmutable
    {
        return $this->kill_enemy_mp7;
    }

    /**
     * @param \DateTimeImmutable $kill_enemy_mp7
     */
    public function setKillEnemyMp7(\DateTimeImmutable $kill_enemy_mp7): void
    {
        $this->kill_enemy_mp7 = $kill_enemy_mp7;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getKillEnemyMp9(): \DateTimeImmutable
    {
        return $this->kill_enemy_mp9;
    }

    /**
     * @param \DateTimeImmutable $kill_enemy_mp9
     */
    public function setKillEnemyMp9(\DateTimeImmutable $kill_enemy_mp9): void
    {
        $this->kill_enemy_mp9 = $kill_enemy_mp9;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getKillEnemyMag7(): \DateTimeImmutable
    {
        return $this->kill_enemy_mag7;
    }

    /**
     * @param \DateTimeImmutable $kill_enemy_mag7
     */
    public function setKillEnemyMag7(\DateTimeImmutable $kill_enemy_mag7): void
    {
        $this->kill_enemy_mag7 = $kill_enemy_mag7;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getKillEnemySawedoff(): \DateTimeImmutable
    {
        return $this->kill_enemy_sawedoff;
    }

    /**
     * @param \DateTimeImmutable $kill_enemy_sawedoff
     */
    public function setKillEnemySawedoff(\DateTimeImmutable $kill_enemy_sawedoff): void
    {
        $this->kill_enemy_sawedoff = $kill_enemy_sawedoff;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getKillEnemyNova(): \DateTimeImmutable
    {
        return $this->kill_enemy_nova;
    }

    /**
     * @param \DateTimeImmutable $kill_enemy_nova
     */
    public function setKillEnemyNova(\DateTimeImmutable $kill_enemy_nova): void
    {
        $this->kill_enemy_nova = $kill_enemy_nova;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getKillEnemyNegev(): \DateTimeImmutable
    {
        return $this->kill_enemy_negev;
    }

    /**
     * @param \DateTimeImmutable $kill_enemy_negev
     */
    public function setKillEnemyNegev(\DateTimeImmutable $kill_enemy_negev): void
    {
        $this->kill_enemy_negev = $kill_enemy_negev;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getKillEnemyMolotov(): \DateTimeImmutable
    {
        return $this->kill_enemy_molotov;
    }

    /**
     * @param \DateTimeImmutable $kill_enemy_molotov
     */
    public function setKillEnemyMolotov(\DateTimeImmutable $kill_enemy_molotov): void
    {
        $this->kill_enemy_molotov = $kill_enemy_molotov;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getWinMapDeTrain(): \DateTimeImmutable
    {
        return $this->win_map_de_train;
    }

    /**
     * @param \DateTimeImmutable $win_map_de_train
     */
    public function setWinMapDeTrain(\DateTimeImmutable $win_map_de_train): void
    {
        $this->win_map_de_train = $win_map_de_train;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getKillEnemyGalilar(): \DateTimeImmutable
    {
        return $this->kill_enemy_galilar;
    }

    /**
     * @param \DateTimeImmutable $kill_enemy_galilar
     */
    public function setKillEnemyGalilar(\DateTimeImmutable $kill_enemy_galilar): void
    {
        $this->kill_enemy_galilar = $kill_enemy_galilar;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getPlayCs2(): \DateTimeImmutable
    {
        return $this->play_cs2;
    }

    /**
     * @param \DateTimeImmutable $play_cs2
     */
    public function setPlayCs2(\DateTimeImmutable $play_cs2): void
    {
        $this->play_cs2 = $play_cs2;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}