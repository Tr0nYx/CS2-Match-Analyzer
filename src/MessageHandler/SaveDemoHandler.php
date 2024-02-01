<?php


namespace App\MessageHandler;


use App\Message\SaveDemo;
use App\Services\Demo;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

/**
 * Class SaveDemoHandler
 * @package App\MessageHandler
 */
#[AsMessageHandler]
readonly class SaveDemoHandler
{
    /**
     * SaveDemoHandler constructor.
     * @param Demo $demo
     */
    public function __construct(private Demo $demo)
    {
    }

    /**
     * @throws \Exception
     */
    public function __invoke(SaveDemo $message): void
    {
        $this->demo->saveDemo($message);
    }
}