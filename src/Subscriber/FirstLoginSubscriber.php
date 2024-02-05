<?php

namespace App\Subscriber;

use App\Entity\User;
use Knojector\SteamAuthenticationBundle\Event\AuthenticateUserEvent;
use Knojector\SteamAuthenticationBundle\Event\FirstLoginEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

readonly class FirstLoginSubscriber implements EventSubscriberInterface
{
    public function __construct(private EventDispatcherInterface $eventDispatcher)
    {
    }

    /**
     * @inheritDoc
     */
    public static function getSubscribedEvents()
    {
        return [
            FirstLoginEvent::NAME => 'onFirstLogin',
        ];
    }

    public function onFirstLogin(FirstLoginEvent $event)
    {
        $communityId = $event->getCommunityId();

        $user = new User($communityId);
        //$user->setUsername($communityId);

        // e.g. call the Steam API to fetch more profile information
        // e.g. create user entity and persist it

        // dispatch the authenticate event in order to sign in the new created user.
        $this->eventDispatcher->dispatch(new AuthenticateUserEvent($user), AuthenticateUserEvent::NAME);
    }
}