<?php declare(strict_types=1);

namespace App\Controller;

use App\Repository\MatchRepository;
use App\Repository\UserRepository;
use App\Repository\UserSkinRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
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
    public function index(): Response
    {
        $dailyMatches = $this->matchRepository->getMatchStats();
        $matchCount = $this->matchRepository->getCount();

        $userCount = $this->userRepository->getCount();
        $inventoryCount = $this->userSkin->getCount();

        return $this->render('index/index.html.twig', [
            'dailyMatches' => $dailyMatches,
            'matchCount' => $matchCount,
            'userCount' => $userCount,
            'inventoryCount' => $inventoryCount,
        ]);
    }

    #[Route('/latest_matches', name: 'latest_matches')]
    public function latestMatches(): Response
    {
        $latestMatches = $this->matchRepository->findBy(
            ['saved' => true],
            ['matchTime' => 'DESC'],
            10
        );

        return $this->render('index/matches.html.twig', [
            'latestmatches' => $latestMatches,
        ]);
    }

    #[Route('/latest_users', name: 'latest_users')]
    public function latestUsers(): Response
    {
        $newusers = $this->userRepository->findLatestUsers();

        return $this->render('index/users.html.twig', [
            'newusers' => $newusers,
        ]);
    }
}
