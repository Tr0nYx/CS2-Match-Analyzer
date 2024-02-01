<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TopInventoryController extends AbstractController
{
    public function __construct(private readonly UserRepository $userRepository)
    {

    }

    #[Route('/top/inventory', name: 'app_top_inventory')]
    public function index(): Response
    {
        $inventories = $this->userRepository->findWithInventory();

        return $this->render('top_inventory/index.html.twig', [
            'inventories' => $inventories,
        ]);
    }
}
