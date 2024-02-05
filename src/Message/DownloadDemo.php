<?php

namespace App\Message;

class DownloadDemo
{
    /**
     * @var string
     */
    private $matchId;

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
