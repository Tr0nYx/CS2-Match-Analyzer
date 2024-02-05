<?php

namespace App\Command;

use App\Entity\Matches;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;

#[AsCommand(
    name: 'demo:heatmap',
    description: 'Create Heatmap',
)]
class Heatmap extends Command
{
    public function __construct(private readonly EntityManagerInterface $entityManager)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $oMatch = $this->entityManager->getRepository(Matches::class)->findOneBy(
            ['downloaded' => true, 'analyzed' => true, 'heatmap' => false],
            ['updatedAt' => 'ASC']
        );
        $command = '/usr/local/go/bin/go run assets/go/heatmap.go -demo assets/matches/heatmaps/'.$oMatch->getId(
        ).'.dem > public/media/'.$oMatch->getId().'.jpg';
        dd($command);
        $process = Process::fromShellCommandline($command);
        $process->start();
        $oMatch->setHeatmap(true);
        $this->entityManager->persist($oMatch);
        $this->entityManager->flush();

        return Command::SUCCESS;
    }
    //go run heatmap.go - demo / path / to / demo.dem > out.jpg
}
