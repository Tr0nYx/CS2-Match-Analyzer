<?php


namespace App\MessageHandler;


use App\Message\DownloadDemo;
use App\Services\Demo;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;


/**
 * Class AnalyzeDemoHandler
 * @package App\MessageHandler
 */
#[AsMessageHandler]
readonly class DownloadDemoHandler
{
    /**
     * DownloadDemo constructor.
     * @param Demo $demo
     */
    public function __construct(private Demo $demo)
    {
    }

    /**
     * @throws \Exception
     */
    public function __invoke(DownloadDemo $message): void
    {
        $this->demo->DownloadDemo($message);
    }
}