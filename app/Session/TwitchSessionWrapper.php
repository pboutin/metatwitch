<?php

namespace App\Session;

use Illuminate\Support\Facades\Session;

class TwitchSessionWrapper
{

    const TWITCH_TOKEN_KEY = 'twitch_token';

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

}