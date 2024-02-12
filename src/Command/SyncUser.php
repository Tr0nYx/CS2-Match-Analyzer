<?php

namespace App\Command;

use App\Entity\User;
use App\Services\UserStatistics;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Command\LockableTrait;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Messenger\MessageBusInterface;

#[AsCommand(
    name: 'user:sync',
    description: 'Sync user',
)]
class SyncUser extends Command
{
    use LockableTrait;
    public const MAX_USERS = 100;

    /**
     * SyncUser constructor.
     * @param EntityManagerInterface $entityManager
     * @param MessageBusInterface $bus
     * @param UserStatistics $userStatistics
     */
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly MessageBusInterface $bus,
        private readonly UserStatistics $userStatistics
    ) {
        parent::__construct();
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|void
     * @throws \Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $steamIds = [];
        /** @var User[] $users */
        $users = $this->entityManager->getRepository(User::class)->findNotSynced(self::MAX_USERS);
        foreach ($users as $user) {
            //$userUpdated = new UserUpdated($user->getId());
            //$this->bus->dispatch($userUpdated);
            $steamIds[] = $user['steamId'];
        }
        $this->userStatistics->getUserSummary($steamIds);

        return Command::SUCCESS;
    }

}
