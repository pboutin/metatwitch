<?php

namespace App\Session;

use Illuminate\Support\Facades\Session;

class TwitchSessionWrapper
{

    const TWITCH_TOKEN_KEY = 'twitch_token';
    const TWITCH_CURRENT_STREAM_KEY = 'twitch_current_stream';

    public function setTwitchToken($token)
    {
        Session::put(self::TWITCH_TOKEN_KEY, $token);
    }

    /**
     * @return string Token from twitch api
     */
    public function getTwitchToken()
    {

        $token = Session::get(self::TWITCH_TOKEN_KEY);

        if(is_null($token)){
            redirect()->route('login');
        }

        return $token;
    }

    /**
     * Remove the twitch token
     */
    public function removeTwitchIdToken()
    {
        $this->setTwitchToken(null);
    }

    /**
     * @return string
     */
    public function getCurrentTwitchChannel(){
        return Session::get(self::TWITCH_CURRENT_STREAM_KEY);
    }


    /**
     * @param $channelName
     */
    public function setCurrentTwitchChannel($channelName){
        Session::put(self::TWITCH_CURRENT_STREAM_KEY, $channelName);
    }
}