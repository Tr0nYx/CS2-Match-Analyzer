<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\MatchRepository;
use App\Repository\UserRepository;
use App\Repository\UserSkinRepository;
use Symfony\Bridge\Twig\Attribute\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class IndexController
 * @package App\Controller
 */
class IndexController extends AbstractController
{
    /**
     * @param UserRepository $userRepository
     * @param MatchRepository $matchRepository
     * @param UserSkinRepository $userSkin
     */
    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly MatchRepository $matchRepository,
        private readonly UserSkinRepository $userSkin
    ) {
    }

    #[Route(path: '/', name: 'index')]
    #[Template('index/index.html.twig')]
    public function index(): array
    {
        $dailyMatches = $this->matchRepository->getMatchStats();
        $matchCount = $this->matchRepository->getCount();

        $userCount = $this->userRepository->getCount();
        $inventoryCount = $this->userSkin->getCount();

        return [
            'dailyMatches' => $dailyMatches,
            'matchCount' => $matchCount,
            'userCount' => $userCount,
            'inventoryCount' => $inventoryCount,
        ];
    }

    #[Route('/latest_matches', name: 'latest_matches')]
    #[Template('index/matches.html.twig')]
    public function latestMatches(): array
    {
        $latestMatches = $this->matchRepository->findBy(
            ['saved' => true],
            ['matchTime' => 'DESC'],
            10
        );

        return ['latestmatches' => $latestMatches];
    }

    #[Route('/latest_users', name: 'latest_users')]
    #[Template('index/users.html.twig')]
    public function latestUsers(): array
    {
        $newusers = $this->userRepository->findLatestUsers();

        return ['newusers' => $newusers];
    }
}
