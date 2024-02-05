<?php

namespace App\MessageHandler;

use App\Message\AnalyzeDemo;
use App\Services\Demo;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

/**
 * Class AnalyzeDemoHandler
 * @package App\MessageHandler
 */
#[AsMessageHandler]
readonly class AnalyzeDemoHandler
{
    /**
     * DownloadDemo constructor.
     * @param Demo $demo
     */
    public function __construct(private Demo $demo)
    {
    }

    public function __invoke(AnalyzeDemo $message): void
    {
        $this->demo->AnalyzeDemo($message);
    }
}
