<?php


namespace App\MessageHandler;


use App\Message\DownloadDemo;
use App\Services\Demo;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;


/**
 * Class AnalyzeDemoHandler
 * @package App\MessageHandler
 */
#[\Symfony\Component\Messenger\Attribute\AsMessageHandler]
class DownloadDemoHandler
{
    protected $demo;

    /**
     * DownloadDemo constructor.
     * @param Demo $demo
     */
    public function __construct(Demo $demo)
    {
        $this->demo = $demo;
    }

    public function __invoke(DownloadDemo $message)
    {
        $this->demo->DownloadDemo($message);
    }
}