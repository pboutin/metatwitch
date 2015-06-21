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

    /**
     * @param $username
     * @param bool|false $filterLive
     * @return array
     */
    public function getUserFollowedStreams($username, $filterLive = false)
    {

        $limit = 100;
        $data = json_decode($this->curl('/users/' . $username . '/follows/channels?limit=' . $limit));

        $totalCount = $data->_total;
        if($totalCount > $limit){

            $channels = $data->follows;

            $maximumRecursion = ceil($totalCount/$limit);

            for ($increment = 1; $increment <= $maximumRecursion; $increment++) {
                $offset = $limit * $increment;
                $data = json_decode(
                    $this->curl('/users/' . $username . '/follows/channels?limit=' . $limit . '&offset=' . $offset)
                );

                $channels = array_merge($channels, $data->follows);
            }

        }else{
            $channels = $data->follows;
        }

        $filteredChannels = [];

        foreach($channels as $channel){

            $name = $channel->channel->name;
            $channelStreamData = $this->getChannelStream($name);

            $isChannelStreaming = $this->isChannelStreaming($channelStreamData);

            if($isChannelStreaming){
                $channel->stream = $channelStreamData->stream;
            }


            if($filterLive){
                if($isChannelStreaming){
                    $filteredChannels[] = $channel;
                }
            }else{
                $filteredChannels[] = $channel;
            }
        }

        return $filteredChannels;
    }

    public function getChannelStream($channel_name)
    {
       return json_decode($this->curl('/streams/' . $channel_name ));
    }

    public function isChannelStreaming($channelSteamData)
    {
        $is_live = false;
        if(!is_null($channelSteamData->stream)){
            $is_live = true;
        }

        return $is_live;
    }

    private function curl($url)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, self::BASE_TWITCH_API_URL . $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($curl);
        curl_close($curl);

        return $output;

    }
}