<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bridge\Twig\Attribute\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TopInventoryController extends AbstractController
{
    public function __construct(private readonly UserRepository $userRepository)
    {
    }

    #[Route('/top/inventory', name: 'app_top_inventory')]
    #[Template('top_inventory/index.html.twig')]
    public function index(): array
    {
        $inventories = $this->userRepository->findWithInventory();

        return ['inventories' => $inventories];
    }
}
