<?php

namespace App\Twitch\Models;


use stdClass;

class TwitchChannel
{

    public $logo;
    public $followers;
    public $views;
    public $name;
    public $status;

    /**
     * TwitchChannel constructor.
     * @param StdClass $properties
     */
    public function __construct(StdClass $properties)
    {
        $this->logo         = $properties->logo;
        $this->followers    = $properties->followers;
        $this->views        = $properties->views;
        $this->name         = $properties->name;
        $this->status       = $properties->status;
    }
}