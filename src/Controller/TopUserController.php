<?php

namespace App\Controller;

use App\Entity\MatchUserScoreboard;
use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TopUserController extends AbstractController
{
    public function __construct(private readonly UserRepository $userRepository)
    {

    }

    #[Route('/top/user', name: 'top_user')]
    public function index(): Response
    {
        $rating = $this->userRepository->getAllUserAvgValues();

        uasort($rating, [$this, 'cmp']);

        return $this->render('top_user/index.html.twig', [
            'ratings' => $rating,
        ]);
    }

    private function cmp($a, $b)
    {
        return $a["rank"] < $b["rank"];
    }
}
