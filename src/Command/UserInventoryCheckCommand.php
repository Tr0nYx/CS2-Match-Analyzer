<?php

namespace App\Command;

use App\Entity\User;
use App\Services\SteamSkinService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Command\LockableTrait;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'user:inventorycheck',
    description: 'Add a short description for your command',
)]
class UserInventoryCheckCommand extends Command
{
    use LockableTrait;

    public function __construct(private SteamSkinService $skinService, private EntityManagerInterface $entityManager)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        if (!$this->lock()) {
            $io->error('The command is already running in another process.');

            return Command::SUCCESS;
        }
        $user = $this->entityManager->getRepository(User::class)->findOneBy([], ['lastInventoryUpdate' => 'ASC']);
        //$user = $this->entityManager->getRepository(User::class)->find(1);
        $skins = $this->skinService->getInventory($user);


        return Command::SUCCESS;
    }
}
