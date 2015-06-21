<?php

namespace App\Twitch;


use App\Session\TwitchSessionWrapper;

class TwitchApiWrapper
{
    const BASE_TWITCH_API_URL = 'https://api.twitch.tv/kraken';

    /**
     * @var TwitchSessionWrapper
     */
    private $sessionWrapper;

    /**
     * TwitchApiWrapper constructor.
     * @param TwitchSessionWrapper $sessionWrapper
     */
    public function __construct(TwitchSessionWrapper $sessionWrapper)
    {
        $this->sessionWrapper = $sessionWrapper;
    }

    public function getUserFollowedStreams($username)
    {
        return $this->curl('/users/' . $username . '/follows/channels');
    }

    private function curl($url)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, self::BASE_TWITCH_API_URL . $url);
        $output = curl_exec($curl);
        curl_close($curl);

        return $output;

    }
}