<?php

namespace App\Controller;

use App\Entity\Matches;
use App\Entity\User;
use App\Message\DownloadDemo;
use App\Services\SharecodeDecoder;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class SearchController.
 */
#[Route(path: '/search', name: 'search_')]
class SearchController extends AbstractController
{
    /**
     * SearchController constructor.
     * @param EntityManagerInterface $entityManager
     * @param SharecodeDecoder $decoder
     * @param MessageBusInterface $bus
     */
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private SharecodeDecoder $decoder,
        private readonly MessageBusInterface $bus
    ) {
        $this->decoder = $decoder;
    }

    /**
     * @return void
     */
    #[Route(path: '/result', name: 'index')]
    public function index()
    {
    }

    /**
     * http://replay271.valve.net/730/003636975409297359261_1950236337.dem.bz2
     * @param Request $request
     * @return RedirectResponse
     */
    #[Route(path: '/', name: 'entity')]
    public function search(Request $request): RedirectResponse
    {
        $result = null;
        $q = $request->get('searchterm');

        if (is_numeric($q)) {
            $result = $this->entityManager->getRepository(User::class)->findOneBy(['steamId' => $q]);
            if (null !== $result) {
                return $this->redirectToRoute('user.detail', ['steamid' => $q]);
            }
        }

        if ($match = $this->entityManager->getRepository(Matches::class)->findOneBy(['shareCode' => $q])) {
            return $this->redirectToRoute('match.detail', ['match_id' => $match->getId()]);
        }

        if (preg_match('/csgo/i', $q) !== false) {
            preg_match('/csgo-(.*)/i', $q, $matches);
            $sharecode = $matches[0];
            $output = $this->decoder->decode($sharecode);
            if (!$match = $this->entityManager->getRepository(Matches::class)->findOneBy(['shareCode' => $sharecode])) {
                $match = new Matches();
                $match->setShareCode($sharecode);
                $this->entityManager->persist($match);
                $this->entityManager->flush();
                $this->addFlash("success", "CSGO Match added");
                $this->bus->dispatch(new DownloadDemo($match->getId()));
            }
        }

        if (preg_match('/dem.bz2/i', $q) !== false) {
            preg_match('/\/(.*).dem.bz2/i', $q, $matches);
            $sharecode = $matches[0];
            if (!$match = $this->entityManager->getRepository(Matches::class)->findOneBy(['shareCode' => $sharecode])) {
                $match = new Matches();
                $match->setShareCode($sharecode);
                $this->entityManager->persist($match);
                $this->entityManager->flush();
                $this->addFlash("success", "CS2 Match added");
                $this->bus->dispatch(new DownloadDemo($match->getId()));
            }
        }

        return $this->redirectToRoute('index');
    }
}
