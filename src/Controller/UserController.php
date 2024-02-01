<?php


namespace App\Controller;


use App\Entity\MatchUserScoreboard;
use App\Entity\User;
use App\Form\ThemeSettingsType;
use App\Form\UserSettingsType;
use App\Repository\MatchUserScoreboardRepository;
use App\Repository\UserRepository;
use App\Services\UserStatistics;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\Cache;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class UserController
 * @package App\Controller
 */
class UserController extends AbstractController
{
    private array $stats;

    /**
     * UserController constructor.
     * @param UserRepository $userRepository
     * @param MatchUserScoreboardRepository $matchUserScoreboardRepository
     * @param EntityManagerInterface $entityManager
     * @param UserStatistics $userStatistics
     */
    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly MatchUserScoreboardRepository $matchUserScoreboardRepository,
        private readonly EntityManagerInterface $entityManager,
        private readonly UserStatistics $userStatistics
    ) {
    }

    #[Route(path: '/user/{user_steam_id}/settings', name: 'user.settings.detail', methods: ['GET', 'POST'])]
    public function showUserSettings(
        #[MapEntity(mapping: ['user_steam_id' => 'steamId'])] User $user,
        Request $request
    ): Response {
        $form = $this->createForm(UserSettingsType::class, $user);
        $form->handleRequest($request);

        $themeform = $this->createForm(ThemeSettingsType::class, $user);
        $themeform->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();

            $this->entityManager->persist($user);
            $this->entityManager->flush();

            //return $this->redirectToRoute('task_success');
        }

        if ($themeform->isSubmitted() && $themeform->isValid()) {
            $user = $themeform->getData();

            $this->entityManager->persist($user);
            $this->entityManager->flush();

            //return $this->redirectToRoute('task_success');
        }

        return $this->render('user/settings.html.twig', [
            'form' => $form,
            'themeform' => $themeform,
            'user' => $user,
        ]);
    }

    /**
     * @return Response
     * @throws Exception
     */
    #[Route(path: '/users', methods: ['GET', 'HEAD'])]
    public function index(): Response
    {
        $userstats = [];
        $steamIds = [];
        /** @var User[] $users */
        $users = $this->userRepository->findAll();
        foreach ($users as $user) {
            if (($user->getCommunityvisibilitystate() === 3 && $user->getUpdatedAt() < new \DateTime('-24 hours'))
                || null === $user->getCommunityvisibilitystate()) {
                $steamIds[] = $user->getSteamId();
                $userstats = $this->userStatistics->getStats($user);
            }
        }
        $this->userStatistics->getUserSummary($steamIds);

        return $this->render('user/list.html.twig', ['users' => $users, 'stats' => $userstats]);
    }

    /**
     * @param User $user
     * @return Response
     * @throws Exception
     */
    #[Route(path: '/user/{steamid}', name: 'user.detail', methods: ['GET', 'HEAD'])]
    #[Cache(maxage: 3600, lastModified: 'user.getUpdatedAt()', etag: 'user.getLastDemoFound().getTimestamp()')]
    public function showUser(#[MapEntity(mapping: ['steamid' => 'steamId'])] User $user): Response
    {
        $userstats = $this->userStatistics->getStats($user);
        /** @var MatchUserScoreboard[] $matches */
        $matches = $this->matchUserScoreboardRepository->getAllOrderedByUser($user);

        $mates = $this->userRepository->getMates($user);

        $stats = $this->getStats($matches);
        //$weaponstats = $this->getWeaponStats($user);
        $avgStats = $this->userRepository->getUserAvgValues();

        return $this->render(
            'user/index.html.twig',
            [
                'player' => $user,
                'stats' => $stats,
                'avgstats' => $avgStats,
                'matches' => $matches,
                'mates' => $mates,
                'steamstats' => json_decode(json_encode($userstats), true),
            ]
        );
    }

    private function getWeaponStats(User $user)
    {
        $accuracystats = $this->userRepository->getAccuracyStats($user);
        $damagestats = $this->userRepository->getDamageStats($user);
        $shootsstats = $this->userRepository->getShootsStats($user);
        $hitsstats = $this->userRepository->getHitsStats($user);
        $headshotstats = $this->userRepository->getHeadshotsStats($user);

        $this->buildStats($accuracystats, 'accuracy');
        $this->buildStats($damagestats, 'damage');
        $this->buildStats($shootsstats, 'shoots');
        $this->buildStats($hitsstats, 'hits');
        $this->buildStats($headshotstats, 'headshots');
    }

    private function buildStats($statsArray, $definition)
    {
        foreach ($statsArray as $array) {
            if (!isset($this->stats['weapon'])) {
                $this->stats['weapon'] = [];

            }
            $this->stats['weapon'][$array['weapon']][$definition] = $array['avg'];
        }
    }

    /**
     * @param int $steamid
     * @return Response
     * @throws Exception
     */
    #[Route(path: '/user/{steamid}/matches', name: 'user.matches.detail', methods: ['GET', 'HEAD'])]
    public function showUserMatches(int $steamid): Response
    {
        /** @var User $user */
        $user = $this->userRepository->findOneBy(['steamId' => $steamid]);
        if ($user instanceof User) {
            $matches = $this->matchUserScoreboardRepository->findBy(['user' => $user]);
            dd($matches);
        }


        return $this->render(
            'user/index.html.twig',
            ['user' => $user]
        );
    }

    /**
     * @param MatchUserScoreboard[] $matchUserScoreBoards
     * @return array
     */
    private function getStats(array $matchUserScoreBoards)
    {
        $stats = [
            'adr' => ['complete' => 0, 'avg' => 0],
            'kills' => ['complete' => 0, 'avg' => 0],
            'deaths' => ['complete' => 0, 'avg' => 0],
            'assists' => ['complete' => 0, 'avg' => 0],
            'hs' => ['complete' => 0, 'avg' => 0],
            'hspercent' => ['complete' => 0, 'avg' => 0],
            'mvps' => ['complete' => 0, 'avg' => 0],
            'kd' => ['complete' => 0, 'avg' => 0],
            'hltv' => ['complete' => 0, 'avg' => 0],
            'hltv2' => ['complete' => 0, 'avg' => 0],
            'wonv5' => ['complete' => 0, 'avg' => 0],
            'wonv4' => ['complete' => 0, 'avg' => 0],
            'wonv3' => ['complete' => 0, 'avg' => 0],
            'wonv2' => ['complete' => 0, 'avg' => 0],
            'wonv1' => ['complete' => 0, 'avg' => 0],
            'lostv5' => ['complete' => 0, 'avg' => 0],
            'lostv4' => ['complete' => 0, 'avg' => 0],
            'lostv3' => ['complete' => 0, 'avg' => 0],
            'lostv2' => ['complete' => 0, 'avg' => 0],
            'lostv1' => ['complete' => 0, 'avg' => 0],
            'lostvx' => ['complete' => 0, 'avg' => 0],
            'wonvx' => ['complete' => 0, 'avg' => 0],
        ];
        $statscount = count($matchUserScoreBoards);
        if ($statscount == 0) {
            return $stats;
        }

        foreach ($matchUserScoreBoards as $match) {
            $stats['adr']['complete'] += $match->getAdr();
            $stats['kills']['complete'] += $match->getKills();
            $stats['deaths']['complete'] += $match->getDeaths();
            $stats['assists']['complete'] += $match->getAssists();
            $stats['hs']['complete'] += $match->getHs();
            $stats['hspercent']['complete'] += $match->getHspercent();
            $stats['mvps']['complete'] += $match->getMvps();
            $stats['kd']['complete'] += $match->getKd();
            $stats['hltv']['complete'] += $match->getHltvrating();
            $stats['hltv2']['complete'] += $match->getHltv2rating();
            $stats['wonv5']['complete'] += $match->getRoundswonv5();
            $stats['wonv4']['complete'] += $match->getRoundswonv4();
            $stats['wonv3']['complete'] += $match->getRoundswonv3();
            $stats['wonv2']['complete'] += $match->getRoundswonv2();
            $stats['wonv1']['complete'] += $match->getRoundswonv1();
            $stats['lostv5']['complete'] += $match->getRoundslostv5();
            $stats['lostv4']['complete'] += $match->getRoundslostv4();
            $stats['lostv3']['complete'] += $match->getRoundslostv3();
            $stats['lostv2']['complete'] += $match->getRoundslostv2();
            $stats['lostv1']['complete'] += $match->getRoundslostv1();
            $stats['wonvx']['complete'] += $match->getRoundswonv5();
            $stats['wonvx']['complete'] += $match->getRoundswonv4();
            $stats['wonvx']['complete'] += $match->getRoundswonv3();
            $stats['wonvx']['complete'] += $match->getRoundswonv2();
            $stats['wonvx']['complete'] += $match->getRoundswonv1();
            $stats['lostvx']['complete'] += $match->getRoundslostv5();
            $stats['lostvx']['complete'] += $match->getRoundslostv4();
            $stats['lostvx']['complete'] += $match->getRoundslostv3();
            $stats['lostvx']['complete'] += $match->getRoundslostv2();
            $stats['lostvx']['complete'] += $match->getRoundslostv1();
        }
        $stats['adr']['avg'] = $stats['adr']['complete'] / $statscount;
        $stats['kills']['avg'] = $stats['kills']['complete'] / $statscount;
        $stats['deaths']['avg'] = $stats['deaths']['complete'] / $statscount;
        $stats['assists']['avg'] = $stats['assists']['complete'] / $statscount;
        $stats['hs']['avg'] = $stats['hs']['complete'] / $statscount;
        $stats['hspercent']['avg'] = $stats['hspercent']['complete'] / $statscount;
        $stats['mvps']['avg'] = $stats['mvps']['complete'] / $statscount;
        $stats['kd']['avg'] = $stats['kd']['complete'] / $statscount;
        $stats['hltv']['avg'] = $stats['hltv']['complete'] / $statscount;
        $stats['hltv2']['avg'] = $stats['hltv2']['complete'] / $statscount;
        $stats['wonv5']['avg'] = $stats['wonv5']['complete'] / $statscount;
        $stats['wonv4']['avg'] = $stats['wonv4']['complete'] / $statscount;
        $stats['wonv3']['avg'] = $stats['wonv3']['complete'] / $statscount;
        $stats['wonv2']['avg'] = $stats['wonv2']['complete'] / $statscount;
        $stats['wonv1']['avg'] = $stats['wonv1']['complete'] / $statscount;
        $stats['lostv5']['avg'] = $stats['lostv5']['complete'] / $statscount;
        $stats['lostv4']['avg'] = $stats['lostv4']['complete'] / $statscount;
        $stats['lostv3']['avg'] = $stats['lostv3']['complete'] / $statscount;
        $stats['lostv2']['avg'] = $stats['lostv2']['complete'] / $statscount;
        $stats['lostv1']['avg'] = $stats['lostv1']['complete'] / $statscount;

        return $stats;
    }
}