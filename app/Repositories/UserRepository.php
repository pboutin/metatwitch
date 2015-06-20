<?php

namespace App\Repositories;

use App\User;

class UserRepository
{
    /**
     * @param $userData
     * @return User
     */
    public function findOrCreateUserByUsername($userData)
    {
        $user = User::firstOrCreate([
            'username' => $userData->name,
            'email' => $userData->email,
            'bio' => $userData->user['bio'],
            'logo' => $userData->user['logo'],
            'nickname' => $userData->nickname,
            'twitch_id' => $userData->id,
        ]);

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
}
