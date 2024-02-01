<?php


namespace App\MessageHandler;


use App\Message\SaveDemo;
use App\Services\Demo;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

/**
 * Class SaveDemoHandler
 * @package App\MessageHandler
 */
#[\Symfony\Component\Messenger\Attribute\AsMessageHandler]
class SaveDemoHandler
{
    private Demo $demo;

    /**
     * SaveDemoHandler constructor.
     * @param Demo $demo
     */
    public function __construct(Demo $demo)
    {
        $this->demo = $demo;
    }

    /**
     * @throws \Exception
     */
    public function __invoke(SaveDemo $message)
    {
        $this->demo->saveDemo($message);
    }
}