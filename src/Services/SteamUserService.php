<?php

namespace App\Services;

use Steam\Command\User\GetPlayerSummaries;
use Steam\Steam;

readonly class SteamUserService
{
    public function __construct(private Steam $steam)
    {

    }

    public function getUserData($communityId)
    {
        $GetPlayerSummaries = new GetPlayerSummaries([$communityId]);
        $playerSummaries = $this->steam->run($GetPlayerSummaries);
        dd($playerSummaries);

        /**
         * $response = $this->guzzle->request('GET', 'GetPlayerSummaries/v0002/', ['query' => ['steamids' => $communityId, 'key' => $this->steamKey]]);
         * $userdata = json_decode($response->getBody(), true);
         * if (isset($userdata['response']['players'][0])) {
         * return $userdata['response']['players'][0];
         * }
         * return NULL;
         * */
    }


}
