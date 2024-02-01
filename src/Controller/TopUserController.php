<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bridge\Twig\Attribute\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TopUserController extends AbstractController
{
    public function __construct(private readonly UserRepository $userRepository)
    {

    }

    #[Route('/top/user', name: 'top_user')]
    #[Template('top_user/index.html.twig')]
    public function index(): array
    {
        $rating = $this->userRepository->getAllUserAvgValues();

        uasort($rating, [$this, 'cmp']);

        return ['ratings' => $rating];
    }

    private function cmp($a, $b)
    {
        return $a["rank"] < $b["rank"];
    }
}
