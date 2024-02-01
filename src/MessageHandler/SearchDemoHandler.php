<?php


namespace App\MessageHandler;


use App\Message\SearchDemo;
use App\Services\Demo;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

/**
 * Class SearchDemoHandler
 * @package App\MessageHandler
 */
#[AsMessageHandler]
readonly class SearchDemoHandler
{
    /**
     * SearchDemoHandler constructor.
     * @param Demo $demo
     */
    public function __construct(private Demo $demo)
    {
    }

    public function __invoke(SearchDemo $message)
    {
        $this->demo->searchDemo();
    }
}