<?php

declare(strict_types=1);

namespace App\Command;

use App\Message\AnalyzeDemo;
use App\Services\Demo;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Command\LockableTrait;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'demo:analyze',
    description: 'Analyze Demo',
)]
class AnalyzeDemoCommand extends Command
{
    use LockableTrait;

    /**
     * AnalyzeDemo constructor.
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
            ->setDescription('Anaylzes latest Demo.')
            ->addArgument('matchid')
            ->addOption('all', 'a', InputOption::VALUE_NONE)

            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp('This command Analyzes the latest demo');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        if (!$this->lock()) {
            $io->error('The command is already running in another process.');

            return Command::SUCCESS;
        }
        if ($input->getOption('all')) {
            $this->demo->AnalyzeDemo(new AnalyzeDemo('all'), $output);

            return Command::SUCCESS;
        }
        if ($input->getArgument('matchid') != null) {
            $this->demo->AnalyzeDemo(new AnalyzeDemo($input->getArgument('matchid')), $output);
        } else {
            $this->demo->AnalyzeDemo(new AnalyzeDemo(null), $output);
        }
        $this->release();

        return Command::SUCCESS;
    }
}
