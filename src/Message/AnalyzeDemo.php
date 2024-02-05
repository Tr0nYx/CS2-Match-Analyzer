<?php

namespace App\Message;

class AnalyzeDemo
{
    /**
     * @var string
     */
    private ?string $matchId;

    /**
     * SaveDemo constructor.
     * @param string|null $matchId
     */
    public function __construct(?string $matchId)
    {
        $this->matchId = $matchId;
    }

    /**
     * @return string|null
     */
    public function getMatchId(): ?string
    {
        return $this->matchId;
    }
}
