<?php

namespace App\Command;

use App\Services\SteamSkinService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Command\LockableTrait;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'steam:skinprice',
    description: 'Add a short description for your command',
)]
class SteamSkinpriceCommand extends Command
{
    use LockableTrait;

    public function __construct(private readonly SteamSkinService $skinService)
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
        $this->skinService->getSkinPrice();
        $this->release();

        return Command::SUCCESS;
    }
}
