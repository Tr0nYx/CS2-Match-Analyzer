<?php


namespace App\Controller;


use App\Entity\Matches;
use App\Repository\MatchRepository;
use App\Repository\MatchUserScoreboardRepository;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bridge\Twig\Attribute\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class MatchController
 * @package App\Controller
 */
class MatchController extends AbstractController
{
    public function __construct(
        private readonly MatchRepository $matchRepository,
        private readonly MatchUserScoreboardRepository $matchUserScoreboardRepository
    ) {

    }

    /**
     * @return array
     */
    #[Route(path: '/match', methods: ['GET', 'HEAD'])]
    #[Template()]
    public function index(): array
    {
        $match = $this->matchRepository->findBy([], ['createdAt' => 'DESC'], 1)[0];
        $scoreboard = $match->getScoreboard();

        return ['scoreboard' => $scoreboard];
    }

    /**
     * @param Matches $match
     * @return array
     */
    #[Route("/match/{match_id}", name: "match.detail")]
    #[Template('match/detail.html.twig')]
    public function detail(#[Mapentity(id: 'match_id')] Matches $match): array
    {
        $orderedMatch = $this->matchUserScoreboardRepository->findByMatchIdSorted(
            $match->getId()
        );

        return ['match' => $match, 'scoreboard' => $orderedMatch];
    }

    public function SteamID3SteamID64(
        $steamid3
    ): string {
        $args = explode(":", $steamid3);
        $accountid = substr($args[2], 0, -1);

        if (($accountid % 2) == 0) {
            $Y = 0;
            $Z = ($accountid / 2);
        } else {
            $Y = 1;
            $Z = (($accountid - 1) / 2);
        }

        return "7656119".(($Z * 2) + (7960265728 + $Y));
    }
}