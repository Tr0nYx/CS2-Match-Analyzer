<?php


namespace App\SteamApi\Command\InventoryService;


use Steam\Command\CommandInterface;

/**
 * Class GetInventory
 * @package App\SteamApi\Command\InventoryService
 */
class GetInventory implements CommandInterface
{
    /**
     * @var int
     */
    private $appid;

    /**
     * @var string
     */
    private $steamid;

    /**
     * @inheritDoc
     */
    public function getInterface()
    {
        return 'IInventoryService';
    }

    /**
     * @inheritDoc
     */
    public function getMethod()
    {
        return 'GetInventory';
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

    public function __construct($steamid, $appid)
    {
        $this->steamid = $steamid;
        $this->appid = $appid;
    }

    /**
     * @inheritDoc
     */
    public function getParams()
    {
        if (null === $this->getSteamid()) {
            throw new \InvalidArgumentException('Invalid SteamID.');
        }
        if (null === $this->getAppid()) {
            throw new \InvalidArgumentException('Invalid AppId.');
        }
        $params = [];

        empty($this->steamid) ?: $params['steamid'] = $this->steamid;
        empty($this->appid) ?: $params['appid'] = $this->appid;

        return $params;
    }

    /**
     * @return int
     */
    public function getAppid(): int
    {
        return $this->appid;
    }

    /**
     * @param int $appid
     */
    public function setAppid(int $appid): void
    {
        $this->appid = $appid;
    }

    /**
     * @return string
     */
    public function getSteamid(): string
    {
        return $this->steamid;
    }

    /**
     * @param string $steamid
     */
    public function setSteamid(string $steamid): void
    {
        $this->steamid = $steamid;
    }

}