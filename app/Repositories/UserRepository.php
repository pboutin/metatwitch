<?php

namespace App\Repositories;

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
     * @return mixed
     */
    public function getFollowedChannelsFor($username)
    {
        return $this->apiWrapper->getUserFollowedStreams($username);
    }

    /**
     * @param $username
     * @return array
     */
    public function getFollowedLiveChannelsFor($username)
    {
        return $this->apiWrapper->getUserFollowedStreams($username, true);
    }
}
