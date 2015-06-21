<?php

namespace App\Twitch\Models;


use stdClass;

class TwitchLiveStream
{

    public $game;

    public $viewers;

    public $channel;

    public $preview;

    /**
     * TwitchChannel constructor.
     * @param StdClass $properties
     */
    public function __construct(StdClass $properties)
    {
        $this->channel  = new TwitchChannel($properties->channel);
        $this->game     = $properties->game;
        $this->viewers  = $properties->viewers;
        $this->preview  = new StdClass();

        $this->preview->medium = $properties->preview->medium;
    }
}