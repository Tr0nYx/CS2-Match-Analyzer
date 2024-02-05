<?php

declare(strict_types=1);

namespace App\Command;

use App\Services\Demo;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Command\LockableTrait;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'demo:save',
    description: 'Save Damo',
)]
class SaveDemo extends Command
{
    use LockableTrait;

    /**
     * SaveDemo constructor.
     * @param Demo $demo
     */
    public function __construct(private readonly Demo $demo)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            // the short description shown while running "php bin/console list"
            ->setDescription('Saves latest Demo.')
            ->addArgument('matchid')
            ->addOption('all', 'a', InputOption::VALUE_NONE)
            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp('This command Saves the latest demo');
    }

    /**
     * @throws \Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        if (!$this->lock()) {
            $output->writeln('The command is already running in another process.');

            return Command::SUCCESS;
        }
        if ($input->getOption('all')) {
            $this->demo->saveDemo(new \App\Message\SaveDemo('all', true), $output);

            return Command::SUCCESS;
        }
        if ($input->getArgument('matchid') != null) {
            $this->demo->saveDemo(new \App\Message\SaveDemo($input->getArgument('matchid'), true));
        } else {
            $this->demo->saveDemo(new \App\Message\SaveDemo(null, false));
        }


        return Command::SUCCESS;
    }
}
