<?php


namespace App\MessageHandler;


use App\Message\AnalyzeDemo;
use App\Services\Demo;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;

/**
 * Class AnalyzeDemoHandler
 * @package App\MessageHandler
 */
#[\Symfony\Component\Messenger\Attribute\AsMessageHandler]
class AnalyzeDemoHandler
{
    /**
     * @var Demo
     */
    private $demo;

    /**
     * DownloadDemo constructor.
     * @param Demo $demo
     */
    public function __construct(Demo $demo)
    {
        $this->demo = $demo;
    }

    public function __invoke(AnalyzeDemo $message)
    {
        $this->demo->AnalyzeDemo($message);
    }
}