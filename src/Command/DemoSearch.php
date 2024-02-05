<?php

namespace App\Command;

use App\Services\Demo;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Command\LockableTrait;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Messenger\MessageBusInterface;

#[AsCommand(
    name: 'demo:search',
    description: 'Search next Demo',
)]
class DemoSearch extends Command
{
    use LockableTrait;

    /**
     * DemoSearch constructor.
     * @param MessageBusInterface $bus
     * @param Demo $demo
     */
    public function __construct(private readonly MessageBusInterface $bus, private readonly Demo $demo)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            // the short description shown while running "php bin/console list"
            ->setDescription('Downloads latest Demo.')

            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp('This command downloads the latest demo');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        if (!$this->lock()) {
            $output->writeln('The command is already running in another process.');

            return Command::SUCCESS;
        }

        $this->demo->searchDemo();
        //$this->bus->dispatch(new SearchDemo());
        $this->release();

        return Command::SUCCESS;
    }
}
