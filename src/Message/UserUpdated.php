<?php


namespace App\Message;


class UserUpdated
{
    /**
     * @var string
     */
    public string $userid;

    /**
     * UserUpdated constructor.
     * @param string $userid
     */
    public function __construct(string $userid)
    {
        $this->userid = $userid;
    }

    /**
     * @return string
     */
    public function getUserId(): string
    {
        return $this->userid;
    }
}