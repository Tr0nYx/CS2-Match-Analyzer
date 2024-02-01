<?php declare(strict_types=1);

namespace App\Command;

use App\Services\Demo;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Command\LockableTrait;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'demo:download',
    description: 'Download Demo',
)]
class DownloadDemo extends Command
{
    use LockableTrait;

    /**
     * DownloadDemo constructor.
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
            ->setDescription('Downloads latest Demo.')
            ->addArgument('matchid')

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
        if ($input->getArgument('matchid') != null) {
            $this->demo->DownloadDemo(new \App\Message\DownloadDemo($input->getArgument('matchid')));
        } else {
            $this->demo->DownloadDemo(new \App\Message\DownloadDemo(null));
        }
        $this->release();

        return Command::SUCCESS;
    }
}