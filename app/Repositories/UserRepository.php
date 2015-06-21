<?php

namespace App\Repositories;

use App\Twitch\Models\TwitchLiveStream;
use App\Twitch\TwitchApiWrapper;
use App\User;

class UserRepository
{
    /**
     * @var TwitchApiWrapper
     */
    private $apiWrapper;

    /**
     * UserRepository constructor.
     * @param TwitchApiWrapper $apiWrapper
     */
    public function __construct(TwitchApiWrapper $apiWrapper)
    {
        $this->apiWrapper = $apiWrapper;
    }


    /**
     * @param $userData
     * @return User
     */
    public function findOrCreateUserByUsername($userData)
    {
        $user = $this->getUserByUsername($userData->name);

        if(is_null($user)){
            $user = User::create([
                'username' => $userData->name,
                'email' => $userData->email,
                'bio' => $userData->user['bio'],
                'logo' => $userData->user['logo'],
                'nickname' => $userData->nickname,
                'twitch_id' => $userData->id,
            ]);
        }

        $this->syncUserEditableProperties($user, $userData);

        return $user;
    }


    /**
     * @param $userName
     * @return User|null
     */
    public function getUserByUsername($userName)
    {
        return User::where('username', '=', $userName)->first();
    }

    /**
     * @param User $user
     * @param $userData
     * @return bool
     */
    private function syncUserEditableProperties(User $user, $userData)
    {
        $user->bio = $userData->user['bio'];
        $user->logo = $userData->user['logo'];
        $user->email = $userData->email;
        $user->nickname = $userData->nickname;

        return $user->save();
    }

    /**
     * @param $username
     * @return TwitchLiveStream[]
     */
    public function getFollowedChannelsFor($username)
    {

        $rawStreams = $this->apiWrapper->getUserFollowedStreams($username);

        $streams = [];
        foreach($rawStreams->streams as $rawStream){
            $streams[] = new TwitchLiveStream($rawStream);
        }

        return $streams;
    }

    /**
     * @param User $user
     * @return mixed
     */
    public function getUsersWatchingConnectedUserStream(User $user)
    {
        $users = array();

        if(!is_null($user->current_channel))
        {
            $users = User::where('current_channel', '=', $user->current_channel)
                ->where('username', '!=', $user->username)
                ->orderBy('last_activity', 'desc')
                ->get()
                ->toArray();
        }

        return $users;
    }

}
