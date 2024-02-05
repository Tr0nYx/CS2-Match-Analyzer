<?php

namespace App\MessageHandler;

use App\Entity\User;
use App\Message\UserUpdated;
use App\Repository\UserRepository;
use App\Services\UserStatistics;
use Steam\Command\User\GetFriendList;
use Steam\Steam;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
readonly class UserUpdatedHandler
{
    /**
     * UserUpdatedHandler constructor.
     * @param UserRepository $userRepository
     * @param UserStatistics $userStatistics
     * @param Steam $steam
     */
    public function __construct(
        private UserRepository $userRepository,
        private UserStatistics $userStatistics,
        private Steam $steam
    ) {
    }

    /**
     * @param UserUpdated $userUpdated
     * @throws \Exception
     */
    public function __invoke(UserUpdated $userUpdated): void
    {
        /** @var User $user */
        $user = $this->userRepository->find($userUpdated->getUserId());
        $date = new \DateTime();
        $date->modify('-1 Day');
        if ($user->getLastSteamUpdate() < $date) {
            $this->userStatistics->getSingleUserSummary($user);
            $this->userStatistics->getStats($user);
            $this->getFriends($user);
            $user->setLastSteamUpdate(new \DateTimeImmutable());
            $this->userRepository->add($user);
        }
    }

    /**
     * @param User $user
     */
    private function getFriends(User $user): void
    {
        $friendsRequest = new GetFriendList($user->getSteamId());
        $request = $this->steam->run($friendsRequest);
        if (!empty($request)) {
            foreach ($request["friendslist"]["friends"] as $friend) {
                /** @var User $oFriend */
                if (!$oFriend = $this->userRepository->findOneBy(['steamId' => $friend["steamid"]])) {
                    $oFriend = new User($friend["steamid"]);
                }
                if (!$user->getMyFriends()->contains($oFriend) && !$user->getFriendsWithMe()->contains($oFriend)) {
                    $user->addFriend($oFriend);
                    $oFriend->addFriend($user);
                    $this->userRepository->add($user);
                    $this->userRepository->add($oFriend);
                }
            }
        }
    }
}
