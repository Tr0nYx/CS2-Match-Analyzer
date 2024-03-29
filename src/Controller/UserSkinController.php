<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserSkinRepository;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bridge\Twig\Attribute\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class UserSkinController extends AbstractController
{
    public function __construct(private readonly UserSkinRepository $userSkinRepository)
    {

    }

    #[Route('/skins/{user_steam_id}', name: 'app_user_skin')]
    #[Template('user_skin/index.html.twig')]
    public function index(#[MapEntity(mapping: ['user_steam_id' => 'steamId'])] User $user): array
    {
        $skins = $this->userSkinRepository->findByUser($user);

        return ['skins' => $skins];
    }
}
