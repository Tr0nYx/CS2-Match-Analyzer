<?php


namespace App\MessageHandler;


use App\Message\SearchDemo;
use App\Services\Demo;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

/**
 * Class SearchDemoHandler
 * @package App\MessageHandler
 */
#[\Symfony\Component\Messenger\Attribute\AsMessageHandler]
class SearchDemoHandler
{
    protected $demo;

    /**
     * SearchDemoHandler constructor.
     * @param Demo $demo
     */
    public function __construct(Demo $demo)
    {
        $this->demo = $demo;
    }

    public function __invoke(SearchDemo $message)
    {
        $this->demo->searchDemo();
    }
}