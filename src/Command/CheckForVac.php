<?php


namespace App\Command;


use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Steam\Command\User\GetPlayerBans;
use Steam\Steam;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Command\LockableTrait;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Messenger\MessageBusInterface;

#[AsCommand(
    name: 'check:vacstatus',
    description: 'check VacStatus',
)]
class CheckForVac extends Command
{
    use LockableTrait;

    /**
     * CheckForVac constructor.
     * @param EntityManagerInterface $entityManager
     * @param Steam $steam
     * @param MessageBusInterface $bus
     */
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly Steam $steam,
        private readonly MessageBusInterface $bus
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
        $ids = [];
        /** @var User[] $users */
        $users = $this->entityManager->getRepository(User::class)->findBy([], ['vaccheck' => 'ASC'], 100);
        foreach ($users as $user) {
            $ids[] = $user->getSteamId();
        }

        $getplayerbans = new GetPlayerBans($ids);
        $bans = $this->steam->run($getplayerbans);
        if (!empty($bans["players"])) {
            $i = 0;
            foreach ($bans["players"] as $checked) {
                /** @var User $user */
                $user = $this->entityManager->getRepository(User::class)->findOneBy(['steamId' => $checked["SteamId"]]);
                $user->setVaccheck(new \Datetime());
                if ($checked["NumberOfGameBans"] == true && $user->getOwbanned() == false) {
                    $start = new \DateTime();
                    $datetime = $start->modify('-'.$checked["DaysSinceLastBan"].' Days');
                    $user->setOwBanned($datetime);
                    $user->setRegisteredBanAt(new \DateTime());
                }
                if ($checked["VACBanned"] == true && $user->getVacbanned() == false) {
                    $start = new \DateTime();
                    $datetime = $start->modify('-'.$checked["DaysSinceLastBan"].' Days');
                    $user->setVacBanned($datetime);
                    $user->setRegisteredBanAt(new \DateTime());
                }
                $this->entityManager->persist($user);
                if (($i % 20) === 0) {
                    $this->entityManager->flush();
                    $this->entityManager->clear();
                }
                $i++;
            }
            $this->entityManager->flush();
            $this->entityManager->clear();
        }

        return Command::SUCCESS;
    }
}
/**
 * 0 => array:7 [
 * "SteamId" => "76561198863921408"
 * "CommunityBanned" => false
 * "VACBanned" => true
 * "NumberOfVACBans" => 1
 * "DaysSinceLastBan" => 0
 * "NumberOfGameBans" => 0
 * "EconomyBan" => "none"
 * ]
 */