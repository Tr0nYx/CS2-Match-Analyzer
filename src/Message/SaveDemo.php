<?php


namespace App\Message;


/**
 * Class SaveDemo
 * @package App\Message
 */
class SaveDemo
{
    /**
     * @var string|null
     */
    private ?string $matchId;

    private ?bool $force;

    /**
     * SaveDemo constructor.
     * @param string|null $matchId
     * @param bool|null $force
     */
    public function __construct(?string $matchId, ?bool $force)
    {
        $this->matchId = $matchId;
        $this->force = $force;
    }

    /**
     * @return string|null
     */
    public function getMatchId(): ?string
    {
        return $this->matchId;
    }

    public function isForce(): ?bool
    {
        return $this->force;
    }
}