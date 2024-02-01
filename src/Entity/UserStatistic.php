<?php


namespace App\Entity;


use App\Entity\Traits\IdTrait;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * Class UserStatistic
 * @package App\Entity
 */
#[ORM\Entity]
#[ORM\Cache('NONSTRICT_READ_WRITE')]
class UserStatistic
{
    use IdTrait;
    use TimestampableEntity;

    #[ORM\ManyToOne(targetEntity: User::class)]
    private User $user;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private int $total_kills = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_deaths = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_time_played = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_planted_bombs = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_defused_bombs = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_wins = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_damage_done = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_money_earned = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_kills_knife = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_kills_hegrenade = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_kills_glock = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_kills_deagle = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_kills_elite = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_kills_fiveseven = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_kills_xm1014 = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_kills_mac10 = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_kills_ump45 = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_kills_p90 = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_kills_awp = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_kills_ak47 = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_kills_aug = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_kills_famas = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_kills_g3sg1 = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_kills_m249 = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_kills_headshot = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_kills_enemy_weapon = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_wins_pistolround = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_wins_map_cs_office = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_wins_map_de_cbble = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_wins_map_de_dust2 = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_wins_map_de_inferno = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_wins_map_de_nuke = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_wins_map_de_train = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_weapons_donated = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_broken_windows = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_kills_enemy_blinded = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_kills_knife_fight = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_kills_against_zoomed_sniper = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_dominations = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_domination_overkills = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_revenges = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_shots_hit = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_shots_fired = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_rounds_played = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_shots_deagle = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_shots_glock = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_shots_elite = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_shots_fiveseven = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_shots_awp = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_shots_ak47 = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_shots_aug = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_shots_famas = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_shots_g3sg1 = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_shots_p90 = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_shots_mac10 = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_shots_ump45 = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_shots_xm1014 = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_shots_m249 = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_hits_deagle = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_hits_glock = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_hits_elite = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_hits_fiveseven = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_hits_awp = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_hits_ak47 = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_hits_aug = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_hits_famas = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_hits_g3sg1 = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_hits_p90 = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_hits_mac10 = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_hits_ump45 = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_hits_xm1014 = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_hits_m249 = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_rounds_map_cs_office = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_rounds_map_de_cbble = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_rounds_map_de_dust2 = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_rounds_map_de_inferno = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_rounds_map_de_nuke = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_rounds_map_de_train = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $last_match_t_wins = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $last_match_ct_wins = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $last_match_wins = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $last_match_max_players = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $last_match_kills = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $last_match_deaths = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $last_match_mvps = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $last_match_favweapon_id = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $last_match_favweapon_shots = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $last_match_favweapon_hits = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $last_match_favweapon_kills = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $last_match_damage = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $last_match_money_spent = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $last_match_dominations = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $last_match_revenges = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_mvps = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_rounds_map_de_lake = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_rounds_map_de_safehouse = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_rounds_map_de_stmarc = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_rounds_map_de_bank = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_gun_game_rounds_won = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_gun_game_rounds_played = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_wins_map_de_house = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_wins_map_de_vertigo = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_wins_map_ar_monastery = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_rounds_map_ar_shoots = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_rounds_map_ar_baggage = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_wins_map_ar_shoots = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_wins_map_ar_baggage = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_wins_map_de_lake = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_wins_map_de_stmarc = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_wins_map_de_safehouse = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_matches_won = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_matches_played = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_gg_matches_won = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_gg_matches_played = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_progressive_matches_won = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_trbomb_matches_won = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_contribution_score = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $last_match_contribution_score = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $last_match_rounds = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_kills_hkp2000 = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_shots_hkp2000 = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_hits_hkp2000 = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_hits_p250 = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_kills_p250 = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_shots_p250 = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_kills_sg556 = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_shots_sg556 = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_hits_sg556 = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_hits_scar20 = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_kills_scar20 = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_shots_scar20 = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_shots_ssg08 = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_hits_ssg08 = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_kills_ssg08 = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_shots_mp7 = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_hits_mp7 = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_kills_mp7 = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_kills_mp9 = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_shots_mp9 = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_hits_mp9 = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_hits_nova = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_kills_nova = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_shots_nova = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_hits_negev = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_kills_negev = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_shots_negev = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_shots_sawedoff = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_hits_sawedoff = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_kills_sawedoff = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_shots_bizon = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_hits_bizon = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_kills_bizon = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_kills_tec9 = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_shots_tec9 = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_hits_tec9 = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_shots_mag7 = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_hits_mag7 = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_kills_mag7 = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_gun_game_contribution_score = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $last_match_gg_contribution_score = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_kills_m4a1 = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_kills_galilar = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_kills_molotov = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_kills_taser = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_shots_m4a1 = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_shots_galilar = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_shots_taser = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_hits_m4a1 = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_hits_galilar = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_rounds_map_ar_monastery = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_matches_won_train = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_rounds_map_de_vertigo = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_matches_won_shoots = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_matches_won_baggage = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_matches_won_lake = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_matches_won_stmarc = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_matches_won_safehouse = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_rescued_hostages = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_wins_map_cs_assault = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_wins_map_cs_italy = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_wins_map_de_aztec = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_wins_map_de_dust = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_rounds_map_cs_assault = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_rounds_map_cs_italy = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_rounds_map_de_aztec = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_rounds_map_de_dust = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_TR_planted_bombs = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_wins_map_de_bank = 0;


    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_wins_map_cs_militia = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $total_rounds_map_cs_militia = 0;


    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $steam_stat_xpearnedgames = 0;

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
     * @return int
     */
    public function getTotalKills(): int
    {
        return $this->total_kills;
    }

    /**
     * @param int $total_kills
     */
    public function setTotalKills(int $total_kills): void
    {
        $this->total_kills = $total_kills;
    }

    /**
     * @return int
     */
    public function getTotalDeaths(): int
    {
        return $this->total_deaths;
    }

    /**
     * @param int $total_deaths
     */
    public function setTotalDeaths(int $total_deaths): void
    {
        $this->total_deaths = $total_deaths;
    }

    /**
     * @return int
     */
    public function getTotalTimePlayed(): int
    {
        return $this->total_time_played;
    }

    /**
     * @param int $total_time_played
     */
    public function setTotalTimePlayed(int $total_time_played): void
    {
        $this->total_time_played = $total_time_played;
    }

    /**
     * @return int
     */
    public function getTotalPlantedBombs(): int
    {
        return $this->total_planted_bombs;
    }

    /**
     * @param int $total_planted_bombs
     */
    public function setTotalPlantedBombs(int $total_planted_bombs): void
    {
        $this->total_planted_bombs = $total_planted_bombs;
    }

    /**
     * @return int
     */
    public function getTotalDefusedBombs(): int
    {
        return $this->total_defused_bombs;
    }

    /**
     * @param int $total_defused_bombs
     */
    public function setTotalDefusedBombs(int $total_defused_bombs): void
    {
        $this->total_defused_bombs = $total_defused_bombs;
    }

    /**
     * @return int
     */
    public function getTotalWins(): int
    {
        return $this->total_wins;
    }

    /**
     * @param int $total_wins
     */
    public function setTotalWins(int $total_wins): void
    {
        $this->total_wins = $total_wins;
    }

    /**
     * @return int
     */
    public function getTotalDamageDone(): int
    {
        return $this->total_damage_done;
    }

    /**
     * @param int $total_damage_done
     */
    public function setTotalDamageDone(int $total_damage_done): void
    {
        $this->total_damage_done = $total_damage_done;
    }

    /**
     * @return int
     */
    public function getTotalMoneyEarned(): int
    {
        return $this->total_money_earned;
    }

    /**
     * @param int $total_money_earned
     */
    public function setTotalMoneyEarned(int $total_money_earned): void
    {
        $this->total_money_earned = $total_money_earned;
    }

    /**
     * @return int
     */
    public function getTotalKillsKnife(): int
    {
        return $this->total_kills_knife;
    }

    /**
     * @param int $total_kills_knife
     */
    public function setTotalKillsKnife(int $total_kills_knife): void
    {
        $this->total_kills_knife = $total_kills_knife;
    }

    /**
     * @return int
     */
    public function getTotalKillsHegrenade(): int
    {
        return $this->total_kills_hegrenade;
    }

    /**
     * @param int $total_kills_hegrenade
     */
    public function setTotalKillsHegrenade(int $total_kills_hegrenade): void
    {
        $this->total_kills_hegrenade = $total_kills_hegrenade;
    }

    /**
     * @return int
     */
    public function getTotalKillsGlock(): int
    {
        return $this->total_kills_glock;
    }

    /**
     * @param int $total_kills_glock
     */
    public function setTotalKillsGlock(int $total_kills_glock): void
    {
        $this->total_kills_glock = $total_kills_glock;
    }

    /**
     * @return int
     */
    public function getTotalKillsDeagle(): int
    {
        return $this->total_kills_deagle;
    }

    /**
     * @param int $total_kills_deagle
     */
    public function setTotalKillsDeagle(int $total_kills_deagle): void
    {
        $this->total_kills_deagle = $total_kills_deagle;
    }

    /**
     * @return int
     */
    public function getTotalKillsElite(): int
    {
        return $this->total_kills_elite;
    }

    /**
     * @param int $total_kills_elite
     */
    public function setTotalKillsElite(int $total_kills_elite): void
    {
        $this->total_kills_elite = $total_kills_elite;
    }

    /**
     * @return int
     */
    public function getTotalKillsFiveseven(): int
    {
        return $this->total_kills_fiveseven;
    }

    /**
     * @param int $total_kills_fiveseven
     */
    public function setTotalKillsFiveseven(int $total_kills_fiveseven): void
    {
        $this->total_kills_fiveseven = $total_kills_fiveseven;
    }

    /**
     * @return int
     */
    public function getTotalKillsXm1014(): int
    {
        return $this->total_kills_xm1014;
    }

    /**
     * @param int $total_kills_xm1014
     */
    public function setTotalKillsXm1014(int $total_kills_xm1014): void
    {
        $this->total_kills_xm1014 = $total_kills_xm1014;
    }

    /**
     * @return int
     */
    public function getTotalKillsMac10(): int
    {
        return $this->total_kills_mac10;
    }

    /**
     * @param int $total_kills_mac10
     */
    public function setTotalKillsMac10(int $total_kills_mac10): void
    {
        $this->total_kills_mac10 = $total_kills_mac10;
    }

    /**
     * @return int
     */
    public function getTotalKillsUmp45(): int
    {
        return $this->total_kills_ump45;
    }

    /**
     * @param int $total_kills_ump45
     */
    public function setTotalKillsUmp45(int $total_kills_ump45): void
    {
        $this->total_kills_ump45 = $total_kills_ump45;
    }

    /**
     * @return int
     */
    public function getTotalKillsP90(): int
    {
        return $this->total_kills_p90;
    }

    /**
     * @param int $total_kills_p90
     */
    public function setTotalKillsP90(int $total_kills_p90): void
    {
        $this->total_kills_p90 = $total_kills_p90;
    }

    /**
     * @return int
     */
    public function getTotalKillsAwp(): int
    {
        return $this->total_kills_awp;
    }

    /**
     * @param int $total_kills_awp
     */
    public function setTotalKillsAwp(int $total_kills_awp): void
    {
        $this->total_kills_awp = $total_kills_awp;
    }

    /**
     * @return int
     */
    public function getTotalKillsAk47(): int
    {
        return $this->total_kills_ak47;
    }

    /**
     * @param int $total_kills_ak47
     */
    public function setTotalKillsAk47(int $total_kills_ak47): void
    {
        $this->total_kills_ak47 = $total_kills_ak47;
    }

    /**
     * @return int
     */
    public function getTotalKillsAug(): int
    {
        return $this->total_kills_aug;
    }

    /**
     * @param int $total_kills_aug
     */
    public function setTotalKillsAug(int $total_kills_aug): void
    {
        $this->total_kills_aug = $total_kills_aug;
    }

    /**
     * @return int
     */
    public function getTotalKillsFamas(): int
    {
        return $this->total_kills_famas;
    }

    /**
     * @param int $total_kills_famas
     */
    public function setTotalKillsFamas(int $total_kills_famas): void
    {
        $this->total_kills_famas = $total_kills_famas;
    }

    /**
     * @return int
     */
    public function getTotalKillsG3sg1(): int
    {
        return $this->total_kills_g3sg1;
    }

    /**
     * @param int $total_kills_g3sg1
     */
    public function setTotalKillsG3sg1(int $total_kills_g3sg1): void
    {
        $this->total_kills_g3sg1 = $total_kills_g3sg1;
    }

    /**
     * @return int
     */
    public function getTotalKillsM249(): int
    {
        return $this->total_kills_m249;
    }

    /**
     * @param int $total_kills_m249
     */
    public function setTotalKillsM249(int $total_kills_m249): void
    {
        $this->total_kills_m249 = $total_kills_m249;
    }

    /**
     * @return int
     */
    public function getTotalKillsHeadshot(): int
    {
        return $this->total_kills_headshot;
    }

    /**
     * @param int $total_kills_headshot
     */
    public function setTotalKillsHeadshot(int $total_kills_headshot): void
    {
        $this->total_kills_headshot = $total_kills_headshot;
    }

    /**
     * @return int
     */
    public function getTotalKillsEnemyWeapon(): int
    {
        return $this->total_kills_enemy_weapon;
    }

    /**
     * @param int $total_kills_enemy_weapon
     */
    public function setTotalKillsEnemyWeapon(int $total_kills_enemy_weapon): void
    {
        $this->total_kills_enemy_weapon = $total_kills_enemy_weapon;
    }

    /**
     * @return int
     */
    public function getTotalWinsPistolround(): int
    {
        return $this->total_wins_pistolround;
    }

    /**
     * @param int $total_wins_pistolround
     */
    public function setTotalWinsPistolround(int $total_wins_pistolround): void
    {
        $this->total_wins_pistolround = $total_wins_pistolround;
    }

    /**
     * @return int
     */
    public function getTotalWinsMapCsOffice(): int
    {
        return $this->total_wins_map_cs_office;
    }

    /**
     * @param int $total_wins_map_cs_office
     */
    public function setTotalWinsMapCsOffice(int $total_wins_map_cs_office): void
    {
        $this->total_wins_map_cs_office = $total_wins_map_cs_office;
    }

    /**
     * @return int
     */
    public function getTotalWinsMapDeCbble(): int
    {
        return $this->total_wins_map_de_cbble;
    }

    /**
     * @param int $total_wins_map_de_cbble
     */
    public function setTotalWinsMapDeCbble(int $total_wins_map_de_cbble): void
    {
        $this->total_wins_map_de_cbble = $total_wins_map_de_cbble;
    }

    /**
     * @return int
     */
    public function getTotalWinsMapDeDust2(): int
    {
        return $this->total_wins_map_de_dust2;
    }

    /**
     * @param int $total_wins_map_de_dust2
     */
    public function setTotalWinsMapDeDust2(int $total_wins_map_de_dust2): void
    {
        $this->total_wins_map_de_dust2 = $total_wins_map_de_dust2;
    }

    /**
     * @return int
     */
    public function getTotalWinsMapDeInferno(): int
    {
        return $this->total_wins_map_de_inferno;
    }

    /**
     * @param int $total_wins_map_de_inferno
     */
    public function setTotalWinsMapDeInferno(int $total_wins_map_de_inferno): void
    {
        $this->total_wins_map_de_inferno = $total_wins_map_de_inferno;
    }

    /**
     * @return int
     */
    public function getTotalWinsMapDeNuke(): int
    {
        return $this->total_wins_map_de_nuke;
    }

    /**
     * @param int $total_wins_map_de_nuke
     */
    public function setTotalWinsMapDeNuke(int $total_wins_map_de_nuke): void
    {
        $this->total_wins_map_de_nuke = $total_wins_map_de_nuke;
    }

    /**
     * @return int
     */
    public function getTotalWinsMapDeTrain(): int
    {
        return $this->total_wins_map_de_train;
    }

    /**
     * @param int $total_wins_map_de_train
     */
    public function setTotalWinsMapDeTrain(int $total_wins_map_de_train): void
    {
        $this->total_wins_map_de_train = $total_wins_map_de_train;
    }

    /**
     * @return int
     */
    public function getTotalWeaponsDonated(): int
    {
        return $this->total_weapons_donated;
    }

    /**
     * @param int $total_weapons_donated
     */
    public function setTotalWeaponsDonated(int $total_weapons_donated): void
    {
        $this->total_weapons_donated = $total_weapons_donated;
    }

    /**
     * @return int
     */
    public function getTotalBrokenWindows(): int
    {
        return $this->total_broken_windows;
    }

    /**
     * @param int $total_broken_windows
     */
    public function setTotalBrokenWindows(int $total_broken_windows): void
    {
        $this->total_broken_windows = $total_broken_windows;
    }

    /**
     * @return int
     */
    public function getTotalKillsEnemyBlinded(): int
    {
        return $this->total_kills_enemy_blinded;
    }

    /**
     * @param int $total_kills_enemy_blinded
     */
    public function setTotalKillsEnemyBlinded(int $total_kills_enemy_blinded): void
    {
        $this->total_kills_enemy_blinded = $total_kills_enemy_blinded;
    }

    /**
     * @return int
     */
    public function getTotalKillsKnifeFight(): int
    {
        return $this->total_kills_knife_fight;
    }

    /**
     * @param int $total_kills_knife_fight
     */
    public function setTotalKillsKnifeFight(int $total_kills_knife_fight): void
    {
        $this->total_kills_knife_fight = $total_kills_knife_fight;
    }

    /**
     * @return int
     */
    public function getTotalKillsAgainstZoomedSniper(): int
    {
        return $this->total_kills_against_zoomed_sniper;
    }

    /**
     * @param int $total_kills_against_zoomed_sniper
     */
    public function setTotalKillsAgainstZoomedSniper(int $total_kills_against_zoomed_sniper): void
    {
        $this->total_kills_against_zoomed_sniper = $total_kills_against_zoomed_sniper;
    }

    /**
     * @return int
     */
    public function getTotalDominations(): int
    {
        return $this->total_dominations;
    }

    /**
     * @param int $total_dominations
     */
    public function setTotalDominations(int $total_dominations): void
    {
        $this->total_dominations = $total_dominations;
    }

    /**
     * @return int
     */
    public function getTotalDominationOverkills(): int
    {
        return $this->total_domination_overkills;
    }

    /**
     * @param int $total_domination_overkills
     */
    public function setTotalDominationOverkills(int $total_domination_overkills): void
    {
        $this->total_domination_overkills = $total_domination_overkills;
    }

    /**
     * @return int
     */
    public function getTotalRevenges(): int
    {
        return $this->total_revenges;
    }

    /**
     * @param int $total_revenges
     */
    public function setTotalRevenges(int $total_revenges): void
    {
        $this->total_revenges = $total_revenges;
    }

    /**
     * @return int
     */
    public function getTotalShotsHit(): int
    {
        return $this->total_shots_hit;
    }

    /**
     * @param int $total_shots_hit
     */
    public function setTotalShotsHit(int $total_shots_hit): void
    {
        $this->total_shots_hit = $total_shots_hit;
    }

    /**
     * @return int
     */
    public function getTotalShotsFired(): int
    {
        return $this->total_shots_fired;
    }

    /**
     * @param int $total_shots_fired
     */
    public function setTotalShotsFired(int $total_shots_fired): void
    {
        $this->total_shots_fired = $total_shots_fired;
    }

    /**
     * @return int
     */
    public function getTotalRoundsPlayed(): int
    {
        return $this->total_rounds_played;
    }

    /**
     * @param int $total_rounds_played
     */
    public function setTotalRoundsPlayed(int $total_rounds_played): void
    {
        $this->total_rounds_played = $total_rounds_played;
    }

    /**
     * @return int
     */
    public function getTotalShotsDeagle(): int
    {
        return $this->total_shots_deagle;
    }

    /**
     * @param int $total_shots_deagle
     */
    public function setTotalShotsDeagle(int $total_shots_deagle): void
    {
        $this->total_shots_deagle = $total_shots_deagle;
    }

    /**
     * @return int
     */
    public function getTotalShotsGlock(): int
    {
        return $this->total_shots_glock;
    }

    /**
     * @param int $total_shots_glock
     */
    public function setTotalShotsGlock(int $total_shots_glock): void
    {
        $this->total_shots_glock = $total_shots_glock;
    }

    /**
     * @return int
     */
    public function getTotalShotsElite(): int
    {
        return $this->total_shots_elite;
    }

    /**
     * @param int $total_shots_elite
     */
    public function setTotalShotsElite(int $total_shots_elite): void
    {
        $this->total_shots_elite = $total_shots_elite;
    }

    /**
     * @return int
     */
    public function getTotalShotsFiveseven(): int
    {
        return $this->total_shots_fiveseven;
    }

    /**
     * @param int $total_shots_fiveseven
     */
    public function setTotalShotsFiveseven(int $total_shots_fiveseven): void
    {
        $this->total_shots_fiveseven = $total_shots_fiveseven;
    }

    /**
     * @return int
     */
    public function getTotalShotsAwp(): int
    {
        return $this->total_shots_awp;
    }

    /**
     * @param int $total_shots_awp
     */
    public function setTotalShotsAwp(int $total_shots_awp): void
    {
        $this->total_shots_awp = $total_shots_awp;
    }

    /**
     * @return int
     */
    public function getTotalShotsAk47(): int
    {
        return $this->total_shots_ak47;
    }

    /**
     * @param int $total_shots_ak47
     */
    public function setTotalShotsAk47(int $total_shots_ak47): void
    {
        $this->total_shots_ak47 = $total_shots_ak47;
    }

    /**
     * @return int
     */
    public function getTotalShotsAug(): int
    {
        return $this->total_shots_aug;
    }

    /**
     * @param int $total_shots_aug
     */
    public function setTotalShotsAug(int $total_shots_aug): void
    {
        $this->total_shots_aug = $total_shots_aug;
    }

    /**
     * @return int
     */
    public function getTotalShotsFamas(): int
    {
        return $this->total_shots_famas;
    }

    /**
     * @param int $total_shots_famas
     */
    public function setTotalShotsFamas(int $total_shots_famas): void
    {
        $this->total_shots_famas = $total_shots_famas;
    }

    /**
     * @return int
     */
    public function getTotalShotsG3sg1(): int
    {
        return $this->total_shots_g3sg1;
    }

    /**
     * @param int $total_shots_g3sg1
     */
    public function setTotalShotsG3sg1(int $total_shots_g3sg1): void
    {
        $this->total_shots_g3sg1 = $total_shots_g3sg1;
    }

    /**
     * @return int
     */
    public function getTotalShotsP90(): int
    {
        return $this->total_shots_p90;
    }

    /**
     * @param int $total_shots_p90
     */
    public function setTotalShotsP90(int $total_shots_p90): void
    {
        $this->total_shots_p90 = $total_shots_p90;
    }

    /**
     * @return int
     */
    public function getTotalShotsMac10(): int
    {
        return $this->total_shots_mac10;
    }

    /**
     * @param int $total_shots_mac10
     */
    public function setTotalShotsMac10(int $total_shots_mac10): void
    {
        $this->total_shots_mac10 = $total_shots_mac10;
    }

    /**
     * @return int
     */
    public function getTotalShotsUmp45(): int
    {
        return $this->total_shots_ump45;
    }

    /**
     * @param int $total_shots_ump45
     */
    public function setTotalShotsUmp45(int $total_shots_ump45): void
    {
        $this->total_shots_ump45 = $total_shots_ump45;
    }

    /**
     * @return int
     */
    public function getTotalShotsXm1014(): int
    {
        return $this->total_shots_xm1014;
    }

    /**
     * @param int $total_shots_xm1014
     */
    public function setTotalShotsXm1014(int $total_shots_xm1014): void
    {
        $this->total_shots_xm1014 = $total_shots_xm1014;
    }

    /**
     * @return int
     */
    public function getTotalShotsM249(): int
    {
        return $this->total_shots_m249;
    }

    /**
     * @param int $total_shots_m249
     */
    public function setTotalShotsM249(int $total_shots_m249): void
    {
        $this->total_shots_m249 = $total_shots_m249;
    }

    /**
     * @return int
     */
    public function getTotalHitsDeagle(): int
    {
        return $this->total_hits_deagle;
    }

    /**
     * @param int $total_hits_deagle
     */
    public function setTotalHitsDeagle(int $total_hits_deagle): void
    {
        $this->total_hits_deagle = $total_hits_deagle;
    }

    /**
     * @return int
     */
    public function getTotalHitsGlock(): int
    {
        return $this->total_hits_glock;
    }

    /**
     * @param int $total_hits_glock
     */
    public function setTotalHitsGlock(int $total_hits_glock): void
    {
        $this->total_hits_glock = $total_hits_glock;
    }

    /**
     * @return int
     */
    public function getTotalHitsElite(): int
    {
        return $this->total_hits_elite;
    }

    /**
     * @param int $total_hits_elite
     */
    public function setTotalHitsElite(int $total_hits_elite): void
    {
        $this->total_hits_elite = $total_hits_elite;
    }

    /**
     * @return int
     */
    public function getTotalHitsFiveseven(): int
    {
        return $this->total_hits_fiveseven;
    }

    /**
     * @param int $total_hits_fiveseven
     */
    public function setTotalHitsFiveseven(int $total_hits_fiveseven): void
    {
        $this->total_hits_fiveseven = $total_hits_fiveseven;
    }

    /**
     * @return int
     */
    public function getTotalHitsAwp(): int
    {
        return $this->total_hits_awp;
    }

    /**
     * @param int $total_hits_awp
     */
    public function setTotalHitsAwp(int $total_hits_awp): void
    {
        $this->total_hits_awp = $total_hits_awp;
    }

    /**
     * @return int
     */
    public function getTotalHitsAk47(): int
    {
        return $this->total_hits_ak47;
    }

    /**
     * @param int $total_hits_ak47
     */
    public function setTotalHitsAk47(int $total_hits_ak47): void
    {
        $this->total_hits_ak47 = $total_hits_ak47;
    }

    /**
     * @return int
     */
    public function getTotalHitsAug(): int
    {
        return $this->total_hits_aug;
    }

    /**
     * @param int $total_hits_aug
     */
    public function setTotalHitsAug(int $total_hits_aug): void
    {
        $this->total_hits_aug = $total_hits_aug;
    }

    /**
     * @return int
     */
    public function getTotalHitsFamas(): int
    {
        return $this->total_hits_famas;
    }

    /**
     * @param int $total_hits_famas
     */
    public function setTotalHitsFamas(int $total_hits_famas): void
    {
        $this->total_hits_famas = $total_hits_famas;
    }

    /**
     * @return int
     */
    public function getTotalHitsG3sg1(): int
    {
        return $this->total_hits_g3sg1;
    }

    /**
     * @param int $total_hits_g3sg1
     */
    public function setTotalHitsG3sg1(int $total_hits_g3sg1): void
    {
        $this->total_hits_g3sg1 = $total_hits_g3sg1;
    }

    /**
     * @return int
     */
    public function getTotalHitsP90(): int
    {
        return $this->total_hits_p90;
    }

    /**
     * @param int $total_hits_p90
     */
    public function setTotalHitsP90(int $total_hits_p90): void
    {
        $this->total_hits_p90 = $total_hits_p90;
    }

    /**
     * @return int
     */
    public function getTotalHitsMac10(): int
    {
        return $this->total_hits_mac10;
    }

    /**
     * @param int $total_hits_mac10
     */
    public function setTotalHitsMac10(int $total_hits_mac10): void
    {
        $this->total_hits_mac10 = $total_hits_mac10;
    }

    /**
     * @return int
     */
    public function getTotalHitsUmp45(): int
    {
        return $this->total_hits_ump45;
    }

    /**
     * @param int $total_hits_ump45
     */
    public function setTotalHitsUmp45(int $total_hits_ump45): void
    {
        $this->total_hits_ump45 = $total_hits_ump45;
    }

    /**
     * @return int
     */
    public function getTotalHitsXm1014(): int
    {
        return $this->total_hits_xm1014;
    }

    /**
     * @param int $total_hits_xm1014
     */
    public function setTotalHitsXm1014(int $total_hits_xm1014): void
    {
        $this->total_hits_xm1014 = $total_hits_xm1014;
    }

    /**
     * @return int
     */
    public function getTotalHitsM249(): int
    {
        return $this->total_hits_m249;
    }

    /**
     * @param int $total_hits_m249
     */
    public function setTotalHitsM249(int $total_hits_m249): void
    {
        $this->total_hits_m249 = $total_hits_m249;
    }

    /**
     * @return int
     */
    public function getTotalRoundsMapCsOffice(): int
    {
        return $this->total_rounds_map_cs_office;
    }

    /**
     * @param int $total_rounds_map_cs_office
     */
    public function setTotalRoundsMapCsOffice(int $total_rounds_map_cs_office): void
    {
        $this->total_rounds_map_cs_office = $total_rounds_map_cs_office;
    }

    /**
     * @return int
     */
    public function getTotalRoundsMapDeCbble(): int
    {
        return $this->total_rounds_map_de_cbble;
    }

    /**
     * @param int $total_rounds_map_de_cbble
     */
    public function setTotalRoundsMapDeCbble(int $total_rounds_map_de_cbble): void
    {
        $this->total_rounds_map_de_cbble = $total_rounds_map_de_cbble;
    }

    /**
     * @return int
     */
    public function getTotalRoundsMapDeDust2(): int
    {
        return $this->total_rounds_map_de_dust2;
    }

    /**
     * @param int $total_rounds_map_de_dust2
     */
    public function setTotalRoundsMapDeDust2(int $total_rounds_map_de_dust2): void
    {
        $this->total_rounds_map_de_dust2 = $total_rounds_map_de_dust2;
    }

    /**
     * @return int
     */
    public function getTotalRoundsMapDeInferno(): int
    {
        return $this->total_rounds_map_de_inferno;
    }

    /**
     * @param int $total_rounds_map_de_inferno
     */
    public function setTotalRoundsMapDeInferno(int $total_rounds_map_de_inferno): void
    {
        $this->total_rounds_map_de_inferno = $total_rounds_map_de_inferno;
    }

    /**
     * @return int
     */
    public function getTotalRoundsMapDeNuke(): int
    {
        return $this->total_rounds_map_de_nuke;
    }

    /**
     * @param int $total_rounds_map_de_nuke
     */
    public function setTotalRoundsMapDeNuke(int $total_rounds_map_de_nuke): void
    {
        $this->total_rounds_map_de_nuke = $total_rounds_map_de_nuke;
    }

    /**
     * @return int
     */
    public function getTotalRoundsMapDeTrain(): int
    {
        return $this->total_rounds_map_de_train;
    }

    /**
     * @param int $total_rounds_map_de_train
     */
    public function setTotalRoundsMapDeTrain(int $total_rounds_map_de_train): void
    {
        $this->total_rounds_map_de_train = $total_rounds_map_de_train;
    }

    /**
     * @return int
     */
    public function getLastMatchTWins(): int
    {
        return $this->last_match_t_wins;
    }

    /**
     * @param int $last_match_t_wins
     */
    public function setLastMatchTWins(int $last_match_t_wins): void
    {
        $this->last_match_t_wins = $last_match_t_wins;
    }

    /**
     * @return int
     */
    public function getLastMatchCtWins(): int
    {
        return $this->last_match_ct_wins;
    }

    /**
     * @param int $last_match_ct_wins
     */
    public function setLastMatchCtWins(int $last_match_ct_wins): void
    {
        $this->last_match_ct_wins = $last_match_ct_wins;
    }

    /**
     * @return int
     */
    public function getLastMatchWins(): int
    {
        return $this->last_match_wins;
    }

    /**
     * @param int $last_match_wins
     */
    public function setLastMatchWins(int $last_match_wins): void
    {
        $this->last_match_wins = $last_match_wins;
    }

    /**
     * @return int
     */
    public function getLastMatchMaxPlayers(): int
    {
        return $this->last_match_max_players;
    }

    /**
     * @param int $last_match_max_players
     */
    public function setLastMatchMaxPlayers(int $last_match_max_players): void
    {
        $this->last_match_max_players = $last_match_max_players;
    }

    /**
     * @return int
     */
    public function getLastMatchKills(): int
    {
        return $this->last_match_kills;
    }

    /**
     * @param int $last_match_kills
     */
    public function setLastMatchKills(int $last_match_kills): void
    {
        $this->last_match_kills = $last_match_kills;
    }

    /**
     * @return int
     */
    public function getLastMatchDeaths(): int
    {
        return $this->last_match_deaths;
    }

    /**
     * @param int $last_match_deaths
     */
    public function setLastMatchDeaths(int $last_match_deaths): void
    {
        $this->last_match_deaths = $last_match_deaths;
    }

    /**
     * @return int
     */
    public function getLastMatchMvps(): int
    {
        return $this->last_match_mvps;
    }

    /**
     * @param int $last_match_mvps
     */
    public function setLastMatchMvps(int $last_match_mvps): void
    {
        $this->last_match_mvps = $last_match_mvps;
    }

    /**
     * @return int
     */
    public function getLastMatchFavweaponId(): int
    {
        return $this->last_match_favweapon_id;
    }

    /**
     * @param int $last_match_favweapon_id
     */
    public function setLastMatchFavweaponId(int $last_match_favweapon_id): void
    {
        $this->last_match_favweapon_id = $last_match_favweapon_id;
    }

    /**
     * @return int
     */
    public function getLastMatchFavweaponShots(): int
    {
        return $this->last_match_favweapon_shots;
    }

    /**
     * @param int $last_match_favweapon_shots
     */
    public function setLastMatchFavweaponShots(int $last_match_favweapon_shots): void
    {
        $this->last_match_favweapon_shots = $last_match_favweapon_shots;
    }

    /**
     * @return int
     */
    public function getLastMatchFavweaponHits(): int
    {
        return $this->last_match_favweapon_hits;
    }

    /**
     * @param int $last_match_favweapon_hits
     */
    public function setLastMatchFavweaponHits(int $last_match_favweapon_hits): void
    {
        $this->last_match_favweapon_hits = $last_match_favweapon_hits;
    }

    /**
     * @return int
     */
    public function getLastMatchFavweaponKills(): int
    {
        return $this->last_match_favweapon_kills;
    }

    /**
     * @param int $last_match_favweapon_kills
     */
    public function setLastMatchFavweaponKills(int $last_match_favweapon_kills): void
    {
        $this->last_match_favweapon_kills = $last_match_favweapon_kills;
    }

    /**
     * @return int
     */
    public function getLastMatchDamage(): int
    {
        return $this->last_match_damage;
    }

    /**
     * @param int $last_match_damage
     */
    public function setLastMatchDamage(int $last_match_damage): void
    {
        $this->last_match_damage = $last_match_damage;
    }

    /**
     * @return int
     */
    public function getLastMatchMoneySpent(): int
    {
        return $this->last_match_money_spent;
    }

    /**
     * @param int $last_match_money_spent
     */
    public function setLastMatchMoneySpent(int $last_match_money_spent): void
    {
        $this->last_match_money_spent = $last_match_money_spent;
    }

    /**
     * @return int
     */
    public function getLastMatchDominations(): int
    {
        return $this->last_match_dominations;
    }

    /**
     * @param int $last_match_dominations
     */
    public function setLastMatchDominations(int $last_match_dominations): void
    {
        $this->last_match_dominations = $last_match_dominations;
    }

    /**
     * @return int
     */
    public function getLastMatchRevenges(): int
    {
        return $this->last_match_revenges;
    }

    /**
     * @param int $last_match_revenges
     */
    public function setLastMatchRevenges(int $last_match_revenges): void
    {
        $this->last_match_revenges = $last_match_revenges;
    }

    /**
     * @return int
     */
    public function getTotalMvps(): int
    {
        return $this->total_mvps;
    }

    /**
     * @param int $total_mvps
     */
    public function setTotalMvps(int $total_mvps): void
    {
        $this->total_mvps = $total_mvps;
    }

    /**
     * @return int
     */
    public function getTotalRoundsMapDeLake(): int
    {
        return $this->total_rounds_map_de_lake;
    }

    /**
     * @param int $total_rounds_map_de_lake
     */
    public function setTotalRoundsMapDeLake(int $total_rounds_map_de_lake): void
    {
        $this->total_rounds_map_de_lake = $total_rounds_map_de_lake;
    }

    /**
     * @return int
     */
    public function getTotalRoundsMapDeSafehouse(): int
    {
        return $this->total_rounds_map_de_safehouse;
    }

    /**
     * @param int $total_rounds_map_de_safehouse
     */
    public function setTotalRoundsMapDeSafehouse(int $total_rounds_map_de_safehouse): void
    {
        $this->total_rounds_map_de_safehouse = $total_rounds_map_de_safehouse;
    }

    /**
     * @return int
     */
    public function getTotalRoundsMapDeStmarc(): int
    {
        return $this->total_rounds_map_de_stmarc;
    }

    /**
     * @param int $total_rounds_map_de_stmarc
     */
    public function setTotalRoundsMapDeStmarc(int $total_rounds_map_de_stmarc): void
    {
        $this->total_rounds_map_de_stmarc = $total_rounds_map_de_stmarc;
    }

    /**
     * @return int
     */
    public function getTotalRoundsMapDeBank(): int
    {
        return $this->total_rounds_map_de_bank;
    }

    /**
     * @param int $total_rounds_map_de_bank
     */
    public function setTotalRoundsMapDeBank(int $total_rounds_map_de_bank): void
    {
        $this->total_rounds_map_de_bank = $total_rounds_map_de_bank;
    }

    /**
     * @return int
     */
    public function getTotalGunGameRoundsWon(): int
    {
        return $this->total_gun_game_rounds_won;
    }

    /**
     * @param int $total_gun_game_rounds_won
     */
    public function setTotalGunGameRoundsWon(int $total_gun_game_rounds_won): void
    {
        $this->total_gun_game_rounds_won = $total_gun_game_rounds_won;
    }

    /**
     * @return int
     */
    public function getTotalGunGameRoundsPlayed(): int
    {
        return $this->total_gun_game_rounds_played;
    }

    /**
     * @param int $total_gun_game_rounds_played
     */
    public function setTotalGunGameRoundsPlayed(int $total_gun_game_rounds_played): void
    {
        $this->total_gun_game_rounds_played = $total_gun_game_rounds_played;
    }

    /**
     * @return int
     */
    public function getTotalWinsMapDeHouse(): int
    {
        return $this->total_wins_map_de_house;
    }

    /**
     * @param int $total_wins_map_de_house
     */
    public function setTotalWinsMapDeHouse(int $total_wins_map_de_house): void
    {
        $this->total_wins_map_de_house = $total_wins_map_de_house;
    }

    /**
     * @return int
     */
    public function getTotalWinsMapDeVertigo(): int
    {
        return $this->total_wins_map_de_vertigo;
    }

    /**
     * @param int $total_wins_map_de_vertigo
     */
    public function setTotalWinsMapDeVertigo(int $total_wins_map_de_vertigo): void
    {
        $this->total_wins_map_de_vertigo = $total_wins_map_de_vertigo;
    }

    /**
     * @return int
     */
    public function getTotalWinsMapArMonastery(): int
    {
        return $this->total_wins_map_ar_monastery;
    }

    /**
     * @param int $total_wins_map_ar_monastery
     */
    public function setTotalWinsMapArMonastery(int $total_wins_map_ar_monastery): void
    {
        $this->total_wins_map_ar_monastery = $total_wins_map_ar_monastery;
    }

    /**
     * @return int
     */
    public function getTotalRoundsMapArShoots(): int
    {
        return $this->total_rounds_map_ar_shoots;
    }

    /**
     * @param int $total_rounds_map_ar_shoots
     */
    public function setTotalRoundsMapArShoots(int $total_rounds_map_ar_shoots): void
    {
        $this->total_rounds_map_ar_shoots = $total_rounds_map_ar_shoots;
    }

    /**
     * @return int
     */
    public function getTotalRoundsMapArBaggage(): int
    {
        return $this->total_rounds_map_ar_baggage;
    }

    /**
     * @param int $total_rounds_map_ar_baggage
     */
    public function setTotalRoundsMapArBaggage(int $total_rounds_map_ar_baggage): void
    {
        $this->total_rounds_map_ar_baggage = $total_rounds_map_ar_baggage;
    }

    /**
     * @return int
     */
    public function getTotalWinsMapArShoots(): int
    {
        return $this->total_wins_map_ar_shoots;
    }

    /**
     * @param int $total_wins_map_ar_shoots
     */
    public function setTotalWinsMapArShoots(int $total_wins_map_ar_shoots): void
    {
        $this->total_wins_map_ar_shoots = $total_wins_map_ar_shoots;
    }

    /**
     * @return int
     */
    public function getTotalWinsMapArBaggage(): int
    {
        return $this->total_wins_map_ar_baggage;
    }

    /**
     * @param int $total_wins_map_ar_baggage
     */
    public function setTotalWinsMapArBaggage(int $total_wins_map_ar_baggage): void
    {
        $this->total_wins_map_ar_baggage = $total_wins_map_ar_baggage;
    }

    /**
     * @return int
     */
    public function getTotalWinsMapDeLake(): int
    {
        return $this->total_wins_map_de_lake;
    }

    /**
     * @param int $total_wins_map_de_lake
     */
    public function setTotalWinsMapDeLake(int $total_wins_map_de_lake): void
    {
        $this->total_wins_map_de_lake = $total_wins_map_de_lake;
    }

    /**
     * @return int
     */
    public function getTotalWinsMapDeStmarc(): int
    {
        return $this->total_wins_map_de_stmarc;
    }

    /**
     * @param int $total_wins_map_de_stmarc
     */
    public function setTotalWinsMapDeStmarc(int $total_wins_map_de_stmarc): void
    {
        $this->total_wins_map_de_stmarc = $total_wins_map_de_stmarc;
    }

    /**
     * @return int
     */
    public function getTotalWinsMapDeSafehouse(): int
    {
        return $this->total_wins_map_de_safehouse;
    }

    /**
     * @param int $total_wins_map_de_safehouse
     */
    public function setTotalWinsMapDeSafehouse(int $total_wins_map_de_safehouse): void
    {
        $this->total_wins_map_de_safehouse = $total_wins_map_de_safehouse;
    }

    /**
     * @return int
     */
    public function getTotalMatchesWon(): int
    {
        return $this->total_matches_won;
    }

    /**
     * @param int $total_matches_won
     */
    public function setTotalMatchesWon(int $total_matches_won): void
    {
        $this->total_matches_won = $total_matches_won;
    }

    /**
     * @return int
     */
    public function getTotalMatchesPlayed(): int
    {
        return $this->total_matches_played;
    }

    /**
     * @param int $total_matches_played
     */
    public function setTotalMatchesPlayed(int $total_matches_played): void
    {
        $this->total_matches_played = $total_matches_played;
    }

    /**
     * @return int
     */
    public function getTotalGgMatchesWon(): int
    {
        return $this->total_gg_matches_won;
    }

    /**
     * @param int $total_gg_matches_won
     */
    public function setTotalGgMatchesWon(int $total_gg_matches_won): void
    {
        $this->total_gg_matches_won = $total_gg_matches_won;
    }

    /**
     * @return int
     */
    public function getTotalGgMatchesPlayed(): int
    {
        return $this->total_gg_matches_played;
    }

    /**
     * @param int $total_gg_matches_played
     */
    public function setTotalGgMatchesPlayed(int $total_gg_matches_played): void
    {
        $this->total_gg_matches_played = $total_gg_matches_played;
    }

    /**
     * @return int
     */
    public function getTotalProgressiveMatchesWon(): int
    {
        return $this->total_progressive_matches_won;
    }

    /**
     * @param int $total_progressive_matches_won
     */
    public function setTotalProgressiveMatchesWon(int $total_progressive_matches_won): void
    {
        $this->total_progressive_matches_won = $total_progressive_matches_won;
    }

    /**
     * @return int
     */
    public function getTotalTrbombMatchesWon(): int
    {
        return $this->total_trbomb_matches_won;
    }

    /**
     * @param int $total_trbomb_matches_won
     */
    public function setTotalTrbombMatchesWon(int $total_trbomb_matches_won): void
    {
        $this->total_trbomb_matches_won = $total_trbomb_matches_won;
    }

    /**
     * @return int
     */
    public function getTotalContributionScore(): int
    {
        return $this->total_contribution_score;
    }

    /**
     * @param int $total_contribution_score
     */
    public function setTotalContributionScore(int $total_contribution_score): void
    {
        $this->total_contribution_score = $total_contribution_score;
    }

    /**
     * @return int
     */
    public function getLastMatchContributionScore(): int
    {
        return $this->last_match_contribution_score;
    }

    /**
     * @param int $last_match_contribution_score
     */
    public function setLastMatchContributionScore(int $last_match_contribution_score): void
    {
        $this->last_match_contribution_score = $last_match_contribution_score;
    }

    /**
     * @return int
     */
    public function getLastMatchRounds(): int
    {
        return $this->last_match_rounds;
    }

    /**
     * @param int $last_match_rounds
     */
    public function setLastMatchRounds(int $last_match_rounds): void
    {
        $this->last_match_rounds = $last_match_rounds;
    }

    /**
     * @return int
     */
    public function getTotalKillsHkp2000(): int
    {
        return $this->total_kills_hkp2000;
    }

    /**
     * @param int $total_kills_hkp2000
     */
    public function setTotalKillsHkp2000(int $total_kills_hkp2000): void
    {
        $this->total_kills_hkp2000 = $total_kills_hkp2000;
    }

    /**
     * @return int
     */
    public function getTotalShotsHkp2000(): int
    {
        return $this->total_shots_hkp2000;
    }

    /**
     * @param int $total_shots_hkp2000
     */
    public function setTotalShotsHkp2000(int $total_shots_hkp2000): void
    {
        $this->total_shots_hkp2000 = $total_shots_hkp2000;
    }

    /**
     * @return int
     */
    public function getTotalHitsHkp2000(): int
    {
        return $this->total_hits_hkp2000;
    }

    /**
     * @param int $total_hits_hkp2000
     */
    public function setTotalHitsHkp2000(int $total_hits_hkp2000): void
    {
        $this->total_hits_hkp2000 = $total_hits_hkp2000;
    }

    /**
     * @return int
     */
    public function getTotalHitsP250(): int
    {
        return $this->total_hits_p250;
    }

    /**
     * @param int $total_hits_p250
     */
    public function setTotalHitsP250(int $total_hits_p250): void
    {
        $this->total_hits_p250 = $total_hits_p250;
    }

    /**
     * @return int
     */
    public function getTotalKillsP250(): int
    {
        return $this->total_kills_p250;
    }

    /**
     * @param int $total_kills_p250
     */
    public function setTotalKillsP250(int $total_kills_p250): void
    {
        $this->total_kills_p250 = $total_kills_p250;
    }

    /**
     * @return int
     */
    public function getTotalShotsP250(): int
    {
        return $this->total_shots_p250;
    }

    /**
     * @param int $total_shots_p250
     */
    public function setTotalShotsP250(int $total_shots_p250): void
    {
        $this->total_shots_p250 = $total_shots_p250;
    }

    /**
     * @return int
     */
    public function getTotalKillsSg556(): int
    {
        return $this->total_kills_sg556;
    }

    /**
     * @param int $total_kills_sg556
     */
    public function setTotalKillsSg556(int $total_kills_sg556): void
    {
        $this->total_kills_sg556 = $total_kills_sg556;
    }

    /**
     * @return int
     */
    public function getTotalShotsSg556(): int
    {
        return $this->total_shots_sg556;
    }

    /**
     * @param int $total_shots_sg556
     */
    public function setTotalShotsSg556(int $total_shots_sg556): void
    {
        $this->total_shots_sg556 = $total_shots_sg556;
    }

    /**
     * @return int
     */
    public function getTotalHitsSg556(): int
    {
        return $this->total_hits_sg556;
    }

    /**
     * @param int $total_hits_sg556
     */
    public function setTotalHitsSg556(int $total_hits_sg556): void
    {
        $this->total_hits_sg556 = $total_hits_sg556;
    }

    /**
     * @return int
     */
    public function getTotalHitsScar20(): int
    {
        return $this->total_hits_scar20;
    }

    /**
     * @param int $total_hits_scar20
     */
    public function setTotalHitsScar20(int $total_hits_scar20): void
    {
        $this->total_hits_scar20 = $total_hits_scar20;
    }

    /**
     * @return int
     */
    public function getTotalKillsScar20(): int
    {
        return $this->total_kills_scar20;
    }

    /**
     * @param int $total_kills_scar20
     */
    public function setTotalKillsScar20(int $total_kills_scar20): void
    {
        $this->total_kills_scar20 = $total_kills_scar20;
    }

    /**
     * @return int
     */
    public function getTotalShotsScar20(): int
    {
        return $this->total_shots_scar20;
    }

    /**
     * @param int $total_shots_scar20
     */
    public function setTotalShotsScar20(int $total_shots_scar20): void
    {
        $this->total_shots_scar20 = $total_shots_scar20;
    }

    /**
     * @return int
     */
    public function getTotalShotsSsg08(): int
    {
        return $this->total_shots_ssg08;
    }

    /**
     * @param int $total_shots_ssg08
     */
    public function setTotalShotsSsg08(int $total_shots_ssg08): void
    {
        $this->total_shots_ssg08 = $total_shots_ssg08;
    }

    /**
     * @return int
     */
    public function getTotalHitsSsg08(): int
    {
        return $this->total_hits_ssg08;
    }

    /**
     * @param int $total_hits_ssg08
     */
    public function setTotalHitsSsg08(int $total_hits_ssg08): void
    {
        $this->total_hits_ssg08 = $total_hits_ssg08;
    }

    /**
     * @return int
     */
    public function getTotalKillsSsg08(): int
    {
        return $this->total_kills_ssg08;
    }

    /**
     * @param int $total_kills_ssg08
     */
    public function setTotalKillsSsg08(int $total_kills_ssg08): void
    {
        $this->total_kills_ssg08 = $total_kills_ssg08;
    }

    /**
     * @return int
     */
    public function getTotalShotsMp7(): int
    {
        return $this->total_shots_mp7;
    }

    /**
     * @param int $total_shots_mp7
     */
    public function setTotalShotsMp7(int $total_shots_mp7): void
    {
        $this->total_shots_mp7 = $total_shots_mp7;
    }

    /**
     * @return int
     */
    public function getTotalHitsMp7(): int
    {
        return $this->total_hits_mp7;
    }

    /**
     * @param int $total_hits_mp7
     */
    public function setTotalHitsMp7(int $total_hits_mp7): void
    {
        $this->total_hits_mp7 = $total_hits_mp7;
    }

    /**
     * @return int
     */
    public function getTotalKillsMp7(): int
    {
        return $this->total_kills_mp7;
    }

    /**
     * @param int $total_kills_mp7
     */
    public function setTotalKillsMp7(int $total_kills_mp7): void
    {
        $this->total_kills_mp7 = $total_kills_mp7;
    }

    /**
     * @return int
     */
    public function getTotalKillsMp9(): int
    {
        return $this->total_kills_mp9;
    }

    /**
     * @param int $total_kills_mp9
     */
    public function setTotalKillsMp9(int $total_kills_mp9): void
    {
        $this->total_kills_mp9 = $total_kills_mp9;
    }

    /**
     * @return int
     */
    public function getTotalShotsMp9(): int
    {
        return $this->total_shots_mp9;
    }

    /**
     * @param int $total_shots_mp9
     */
    public function setTotalShotsMp9(int $total_shots_mp9): void
    {
        $this->total_shots_mp9 = $total_shots_mp9;
    }

    /**
     * @return int
     */
    public function getTotalHitsMp9(): int
    {
        return $this->total_hits_mp9;
    }

    /**
     * @param int $total_hits_mp9
     */
    public function setTotalHitsMp9(int $total_hits_mp9): void
    {
        $this->total_hits_mp9 = $total_hits_mp9;
    }

    /**
     * @return int
     */
    public function getTotalHitsNova(): int
    {
        return $this->total_hits_nova;
    }

    /**
     * @param int $total_hits_nova
     */
    public function setTotalHitsNova(int $total_hits_nova): void
    {
        $this->total_hits_nova = $total_hits_nova;
    }

    /**
     * @return int
     */
    public function getTotalKillsNova(): int
    {
        return $this->total_kills_nova;
    }

    /**
     * @param int $total_kills_nova
     */
    public function setTotalKillsNova(int $total_kills_nova): void
    {
        $this->total_kills_nova = $total_kills_nova;
    }

    /**
     * @return int
     */
    public function getTotalShotsNova(): int
    {
        return $this->total_shots_nova;
    }

    /**
     * @param int $total_shots_nova
     */
    public function setTotalShotsNova(int $total_shots_nova): void
    {
        $this->total_shots_nova = $total_shots_nova;
    }

    /**
     * @return int
     */
    public function getTotalHitsNegev(): int
    {
        return $this->total_hits_negev;
    }

    /**
     * @param int $total_hits_negev
     */
    public function setTotalHitsNegev(int $total_hits_negev): void
    {
        $this->total_hits_negev = $total_hits_negev;
    }

    /**
     * @return int
     */
    public function getTotalKillsNegev(): int
    {
        return $this->total_kills_negev;
    }

    /**
     * @param int $total_kills_negev
     */
    public function setTotalKillsNegev(int $total_kills_negev): void
    {
        $this->total_kills_negev = $total_kills_negev;
    }

    /**
     * @return int
     */
    public function getTotalShotsNegev(): int
    {
        return $this->total_shots_negev;
    }

    /**
     * @param int $total_shots_negev
     */
    public function setTotalShotsNegev(int $total_shots_negev): void
    {
        $this->total_shots_negev = $total_shots_negev;
    }

    /**
     * @return int
     */
    public function getTotalShotsSawedoff(): int
    {
        return $this->total_shots_sawedoff;
    }

    /**
     * @param int $total_shots_sawedoff
     */
    public function setTotalShotsSawedoff(int $total_shots_sawedoff): void
    {
        $this->total_shots_sawedoff = $total_shots_sawedoff;
    }

    /**
     * @return int
     */
    public function getTotalHitsSawedoff(): int
    {
        return $this->total_hits_sawedoff;
    }

    /**
     * @param int $total_hits_sawedoff
     */
    public function setTotalHitsSawedoff(int $total_hits_sawedoff): void
    {
        $this->total_hits_sawedoff = $total_hits_sawedoff;
    }

    /**
     * @return int
     */
    public function getTotalKillsSawedoff(): int
    {
        return $this->total_kills_sawedoff;
    }

    /**
     * @param int $total_kills_sawedoff
     */
    public function setTotalKillsSawedoff(int $total_kills_sawedoff): void
    {
        $this->total_kills_sawedoff = $total_kills_sawedoff;
    }

    /**
     * @return int
     */
    public function getTotalShotsBizon(): int
    {
        return $this->total_shots_bizon;
    }

    /**
     * @param int $total_shots_bizon
     */
    public function setTotalShotsBizon(int $total_shots_bizon): void
    {
        $this->total_shots_bizon = $total_shots_bizon;
    }

    /**
     * @return int
     */
    public function getTotalHitsBizon(): int
    {
        return $this->total_hits_bizon;
    }

    /**
     * @param int $total_hits_bizon
     */
    public function setTotalHitsBizon(int $total_hits_bizon): void
    {
        $this->total_hits_bizon = $total_hits_bizon;
    }

    /**
     * @return int
     */
    public function getTotalKillsBizon(): int
    {
        return $this->total_kills_bizon;
    }

    /**
     * @param int $total_kills_bizon
     */
    public function setTotalKillsBizon(int $total_kills_bizon): void
    {
        $this->total_kills_bizon = $total_kills_bizon;
    }

    /**
     * @return int
     */
    public function getTotalKillsTec9(): int
    {
        return $this->total_kills_tec9;
    }

    /**
     * @param int $total_kills_tec9
     */
    public function setTotalKillsTec9(int $total_kills_tec9): void
    {
        $this->total_kills_tec9 = $total_kills_tec9;
    }

    /**
     * @return int
     */
    public function getTotalShotsTec9(): int
    {
        return $this->total_shots_tec9;
    }

    /**
     * @param int $total_shots_tec9
     */
    public function setTotalShotsTec9(int $total_shots_tec9): void
    {
        $this->total_shots_tec9 = $total_shots_tec9;
    }

    /**
     * @return int
     */
    public function getTotalHitsTec9(): int
    {
        return $this->total_hits_tec9;
    }

    /**
     * @param int $total_hits_tec9
     */
    public function setTotalHitsTec9(int $total_hits_tec9): void
    {
        $this->total_hits_tec9 = $total_hits_tec9;
    }

    /**
     * @return int
     */
    public function getTotalShotsMag7(): int
    {
        return $this->total_shots_mag7;
    }

    /**
     * @param int $total_shots_mag7
     */
    public function setTotalShotsMag7(int $total_shots_mag7): void
    {
        $this->total_shots_mag7 = $total_shots_mag7;
    }

    /**
     * @return int
     */
    public function getTotalHitsMag7(): int
    {
        return $this->total_hits_mag7;
    }

    /**
     * @param int $total_hits_mag7
     */
    public function setTotalHitsMag7(int $total_hits_mag7): void
    {
        $this->total_hits_mag7 = $total_hits_mag7;
    }

    /**
     * @return int
     */
    public function getTotalKillsMag7(): int
    {
        return $this->total_kills_mag7;
    }

    /**
     * @param int $total_kills_mag7
     */
    public function setTotalKillsMag7(int $total_kills_mag7): void
    {
        $this->total_kills_mag7 = $total_kills_mag7;
    }

    /**
     * @return int
     */
    public function getTotalGunGameContributionScore(): int
    {
        return $this->total_gun_game_contribution_score;
    }

    /**
     * @param int $total_gun_game_contribution_score
     */
    public function setTotalGunGameContributionScore(int $total_gun_game_contribution_score): void
    {
        $this->total_gun_game_contribution_score = $total_gun_game_contribution_score;
    }

    /**
     * @return int
     */
    public function getLastMatchGgContributionScore(): int
    {
        return $this->last_match_gg_contribution_score;
    }

    /**
     * @param int $last_match_gg_contribution_score
     */
    public function setLastMatchGgContributionScore(int $last_match_gg_contribution_score): void
    {
        $this->last_match_gg_contribution_score = $last_match_gg_contribution_score;
    }

    /**
     * @return int
     */
    public function getTotalKillsM4a1(): int
    {
        return $this->total_kills_m4a1;
    }

    /**
     * @param int $total_kills_m4a1
     */
    public function setTotalKillsM4a1(int $total_kills_m4a1): void
    {
        $this->total_kills_m4a1 = $total_kills_m4a1;
    }

    /**
     * @return int
     */
    public function getTotalKillsGalilar(): int
    {
        return $this->total_kills_galilar;
    }

    /**
     * @param int $total_kills_galilar
     */
    public function setTotalKillsGalilar(int $total_kills_galilar): void
    {
        $this->total_kills_galilar = $total_kills_galilar;
    }

    /**
     * @return int
     */
    public function getTotalKillsMolotov(): int
    {
        return $this->total_kills_molotov;
    }

    /**
     * @param int $total_kills_molotov
     */
    public function setTotalKillsMolotov(int $total_kills_molotov): void
    {
        $this->total_kills_molotov = $total_kills_molotov;
    }

    /**
     * @return int
     */
    public function getTotalKillsTaser(): int
    {
        return $this->total_kills_taser;
    }

    /**
     * @param int $total_kills_taser
     */
    public function setTotalKillsTaser(int $total_kills_taser): void
    {
        $this->total_kills_taser = $total_kills_taser;
    }

    /**
     * @return int
     */
    public function getTotalShotsM4a1(): int
    {
        return $this->total_shots_m4a1;
    }

    /**
     * @param int $total_shots_m4a1
     */
    public function setTotalShotsM4a1(int $total_shots_m4a1): void
    {
        $this->total_shots_m4a1 = $total_shots_m4a1;
    }

    /**
     * @return int
     */
    public function getTotalShotsGalilar(): int
    {
        return $this->total_shots_galilar;
    }

    /**
     * @param int $total_shots_galilar
     */
    public function setTotalShotsGalilar(int $total_shots_galilar): void
    {
        $this->total_shots_galilar = $total_shots_galilar;
    }

    /**
     * @return int
     */
    public function getTotalShotsTaser(): int
    {
        return $this->total_shots_taser;
    }

    /**
     * @param int $total_shots_taser
     */
    public function setTotalShotsTaser(int $total_shots_taser): void
    {
        $this->total_shots_taser = $total_shots_taser;
    }

    /**
     * @return int
     */
    public function getTotalHitsM4a1(): int
    {
        return $this->total_hits_m4a1;
    }

    /**
     * @param int $total_hits_m4a1
     */
    public function setTotalHitsM4a1(int $total_hits_m4a1): void
    {
        $this->total_hits_m4a1 = $total_hits_m4a1;
    }

    /**
     * @return int
     */
    public function getTotalHitsGalilar(): int
    {
        return $this->total_hits_galilar;
    }

    /**
     * @param int $total_hits_galilar
     */
    public function setTotalHitsGalilar(int $total_hits_galilar): void
    {
        $this->total_hits_galilar = $total_hits_galilar;
    }

    /**
     * @return int
     */
    public function getTotalRoundsMapArMonastery(): int
    {
        return $this->total_rounds_map_ar_monastery;
    }

    /**
     * @param int $total_rounds_map_ar_monastery
     */
    public function setTotalRoundsMapArMonastery(int $total_rounds_map_ar_monastery): void
    {
        $this->total_rounds_map_ar_monastery = $total_rounds_map_ar_monastery;
    }

    /**
     * @return int
     */
    public function getTotalMatchesWonTrain(): int
    {
        return $this->total_matches_won_train;
    }

    /**
     * @param int $total_matches_won_train
     */
    public function setTotalMatchesWonTrain(int $total_matches_won_train): void
    {
        $this->total_matches_won_train = $total_matches_won_train;
    }

    /**
     * @return int
     */
    public function getTotalRoundsMapDeVertigo(): int
    {
        return $this->total_rounds_map_de_vertigo;
    }

    /**
     * @param int $total_rounds_map_de_vertigo
     */
    public function setTotalRoundsMapDeVertigo(int $total_rounds_map_de_vertigo): void
    {
        $this->total_rounds_map_de_vertigo = $total_rounds_map_de_vertigo;
    }

    /**
     * @return int
     */
    public function getTotalMatchesWonShoots(): int
    {
        return $this->total_matches_won_shoots;
    }

    /**
     * @param int $total_matches_won_shoots
     */
    public function setTotalMatchesWonShoots(int $total_matches_won_shoots): void
    {
        $this->total_matches_won_shoots = $total_matches_won_shoots;
    }

    /**
     * @return int
     */
    public function getTotalMatchesWonBaggage(): int
    {
        return $this->total_matches_won_baggage;
    }

    /**
     * @param int $total_matches_won_baggage
     */
    public function setTotalMatchesWonBaggage(int $total_matches_won_baggage): void
    {
        $this->total_matches_won_baggage = $total_matches_won_baggage;
    }

    /**
     * @return int
     */
    public function getTotalMatchesWonLake(): int
    {
        return $this->total_matches_won_lake;
    }

    /**
     * @param int $total_matches_won_lake
     */
    public function setTotalMatchesWonLake(int $total_matches_won_lake): void
    {
        $this->total_matches_won_lake = $total_matches_won_lake;
    }

    /**
     * @return int
     */
    public function getTotalMatchesWonStmarc(): int
    {
        return $this->total_matches_won_stmarc;
    }

    /**
     * @param int $total_matches_won_stmarc
     */
    public function setTotalMatchesWonStmarc(int $total_matches_won_stmarc): void
    {
        $this->total_matches_won_stmarc = $total_matches_won_stmarc;
    }

    /**
     * @return int
     */
    public function getTotalMatchesWonSafehouse(): int
    {
        return $this->total_matches_won_safehouse;
    }

    /**
     * @param int $total_matches_won_safehouse
     */
    public function setTotalMatchesWonSafehouse(int $total_matches_won_safehouse): void
    {
        $this->total_matches_won_safehouse = $total_matches_won_safehouse;
    }

    /**
     * @return int
     */
    public function getTotalRescuedHostages(): int
    {
        return $this->total_rescued_hostages;
    }

    /**
     * @param int $total_rescued_hostages
     */
    public function setTotalRescuedHostages(int $total_rescued_hostages): void
    {
        $this->total_rescued_hostages = $total_rescued_hostages;
    }

    /**
     * @return int
     */
    public function getTotalWinsMapCsAssault(): int
    {
        return $this->total_wins_map_cs_assault;
    }

    /**
     * @param int $total_wins_map_cs_assault
     */
    public function setTotalWinsMapCsAssault(int $total_wins_map_cs_assault): void
    {
        $this->total_wins_map_cs_assault = $total_wins_map_cs_assault;
    }

    /**
     * @return int
     */
    public function getTotalWinsMapCsItaly(): int
    {
        return $this->total_wins_map_cs_italy;
    }

    /**
     * @param int $total_wins_map_cs_italy
     */
    public function setTotalWinsMapCsItaly(int $total_wins_map_cs_italy): void
    {
        $this->total_wins_map_cs_italy = $total_wins_map_cs_italy;
    }

    /**
     * @return int
     */
    public function getTotalWinsMapDeAztec(): int
    {
        return $this->total_wins_map_de_aztec;
    }

    /**
     * @param int $total_wins_map_de_aztec
     */
    public function setTotalWinsMapDeAztec(int $total_wins_map_de_aztec): void
    {
        $this->total_wins_map_de_aztec = $total_wins_map_de_aztec;
    }

    /**
     * @return int
     */
    public function getTotalWinsMapDeDust(): int
    {
        return $this->total_wins_map_de_dust;
    }

    /**
     * @param int $total_wins_map_de_dust
     */
    public function setTotalWinsMapDeDust(int $total_wins_map_de_dust): void
    {
        $this->total_wins_map_de_dust = $total_wins_map_de_dust;
    }

    /**
     * @return int
     */
    public function getTotalRoundsMapCsAssault(): int
    {
        return $this->total_rounds_map_cs_assault;
    }

    /**
     * @param int $total_rounds_map_cs_assault
     */
    public function setTotalRoundsMapCsAssault(int $total_rounds_map_cs_assault): void
    {
        $this->total_rounds_map_cs_assault = $total_rounds_map_cs_assault;
    }

    /**
     * @return int
     */
    public function getTotalRoundsMapCsItaly(): int
    {
        return $this->total_rounds_map_cs_italy;
    }

    /**
     * @param int $total_rounds_map_cs_italy
     */
    public function setTotalRoundsMapCsItaly(int $total_rounds_map_cs_italy): void
    {
        $this->total_rounds_map_cs_italy = $total_rounds_map_cs_italy;
    }

    /**
     * @return int
     */
    public function getTotalRoundsMapDeAztec(): int
    {
        return $this->total_rounds_map_de_aztec;
    }

    /**
     * @param int $total_rounds_map_de_aztec
     */
    public function setTotalRoundsMapDeAztec(int $total_rounds_map_de_aztec): void
    {
        $this->total_rounds_map_de_aztec = $total_rounds_map_de_aztec;
    }

    /**
     * @return int
     */
    public function getTotalRoundsMapDeDust(): int
    {
        return $this->total_rounds_map_de_dust;
    }

    /**
     * @param int $total_rounds_map_de_dust
     */
    public function setTotalRoundsMapDeDust(int $total_rounds_map_de_dust): void
    {
        $this->total_rounds_map_de_dust = $total_rounds_map_de_dust;
    }

    /**
     * @return int
     */
    public function getTotalTRPlantedBombs(): int
    {
        return $this->total_TR_planted_bombs;
    }

    /**
     * @param int $total_TR_planted_bombs
     */
    public function setTotalTRPlantedBombs(int $total_TR_planted_bombs): void
    {
        $this->total_TR_planted_bombs = $total_TR_planted_bombs;
    }

    /**
     * @return int
     */
    public function getTotalWinsMapDeBank(): int
    {
        return $this->total_wins_map_de_bank;
    }

    /**
     * @param int $total_wins_map_de_bank
     */
    public function setTotalWinsMapDeBank(int $total_wins_map_de_bank): void
    {
        $this->total_wins_map_de_bank = $total_wins_map_de_bank;
    }

    /**
     * @return int
     */
    public function getTotalWinsMapCsMilitia(): int
    {
        return $this->total_wins_map_cs_militia;
    }

    /**
     * @param int $total_wins_map_cs_militia
     */
    public function setTotalWinsMapCsMilitia(int $total_wins_map_cs_militia): void
    {
        $this->total_wins_map_cs_militia = $total_wins_map_cs_militia;
    }

    /**
     * @return int
     */
    public function getTotalRoundsMapCsMilitia(): int
    {
        return $this->total_rounds_map_cs_militia;
    }

    /**
     * @param int $total_rounds_map_cs_militia
     */
    public function setTotalRoundsMapCsMilitia(int $total_rounds_map_cs_militia): void
    {
        $this->total_rounds_map_cs_militia = $total_rounds_map_cs_militia;
    }

    /**
     * @return int
     */
    public function getSteamStatXpearnedgames(): int
    {
        return $this->steam_stat_xpearnedgames;
    }

    /**
     * @param int $steam_stat_xpearnedgames
     */
    public function setSteamStatXpearnedgames(int $steam_stat_xpearnedgames): void
    {
        $this->steam_stat_xpearnedgames = $steam_stat_xpearnedgames;
    }
}