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
     * @return array
     */
    public function getUserFollowedStreams($username)
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

        $channelString = [];

        foreach($channels as $channel){
            $name = $channel->channel->name;
            $channelString[] = $name;
        }

        $filteredStreams = [];
        $streams = $this->getStreams(implode(',', $channelString));

        dd($streams);


        return $filteredStreams;
    }

    /**
     * @param $streamString
     * @return mixed
     */
    public function getStreams($streamString){
        return json_decode($this->curl('/streams?channel=' . $streamString . '&limit=100' ));
    }

    /**
     * @param $channelName
     * @return mixed
     */
    public function getChannelStream($channelName)
    {
       return json_decode($this->curl('/streams/' . $channelName ));
    }

    /**
     * @param $channelSteamData
     * @return bool
     */
    public function isChannelStreaming($channelSteamData)
    {
        $is_live = false;
        if(!is_null($channelSteamData->stream)){
            $is_live = true;
        }

        return $is_live;
    }

    /**
     * @param $url
     * @return mixed
     */
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