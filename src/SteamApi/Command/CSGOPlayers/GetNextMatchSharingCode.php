<?php

namespace App\SteamApi\Command\CSGOPlayers;

use Steam\Command\CommandInterface;

/**
 * Class GetNextMatchSharingCode
 * @package App\SteamApi\Command\CSGOPlayers
 */
class GetNextMatchSharingCode implements CommandInterface
{
    /**
     * @var
     */
    private $steamid;

    /**
     * @var
     */
    private $steamidkey;

    /**
     * @var string
     */
    private $knowncode;

    /**
     * @inheritDoc
     */
    public function getInterface()
    {
        return 'ICSGOPlayers_730';
    }

    /**
     * @inheritDoc
     */
    public function getMethod()
    {
        return 'GetNextMatchSharingCode';
    }

    /**
     * @inheritDoc
     */
    public function getVersion()
    {
        return 'v1';
    }

    /**
     * @inheritDoc
     */
    public function getRequestMethod()
    {
        return 'GET';
    }

    /**
     * @inheritDoc
     */
    public function getParams()
    {
        if (null === $this->getSteamid()) {
            throw new \InvalidArgumentException('Invalid SteamID.');
        }
        if (null === $this->getSteamidkey()) {
            throw new \InvalidArgumentException('Invalid SteamIDKey.');
        }
        if (null === $this->getKnowncode()) {
            throw new \InvalidArgumentException('Invalid KnownCode.');
        }
        $params = [];

        empty($this->steamid) ?: $params['steamid'] = $this->steamid;
        empty($this->steamidkey) ?: $params['steamidkey'] = $this->steamidkey;
        empty($this->knowncode) ?: $params['knowncode'] = $this->knowncode;

        return $params;
    }

    /**
     * @return mixed
     */
    public function getSteamid()
    {
        return $this->steamid;
    }

    /**
     * @param mixed $steamid
     */
    public function setSteamid($steamid): void
    {
        $this->steamid = $steamid;
    }

    /**
     * @return mixed
     */
    public function getSteamidkey()
    {
        return $this->steamidkey;
    }

    /**
     * @param mixed $steamidkey
     */
    public function setSteamidkey($steamidkey): void
    {
        $this->steamidkey = $steamidkey;
    }

    /**
     * @return mixed
     */
    public function getKnowncode()
    {
        return $this->knowncode;
    }

    /**
     * @param mixed $knowncode
     */
    public function setKnowncode($knowncode): void
    {
        $this->knowncode = $knowncode;
    }

}
