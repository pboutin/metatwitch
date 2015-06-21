<?php

namespace App\Authentication;

use App\Repositories\UserRepository;
use App\Session\TwitchSessionWrapper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Laravel\Socialite\Contracts\Factory as Socialite;

class AuthenticateUser
{
    /**
     * @var Socialite
     */
    private $socialite;
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var TwitchSessionWrapper
     */
    private $sessionWrapper;


    /**
     * AuthenticateUser constructor.
     *
     * @param UserRepository $userRepository
     * @param Socialite $socialite
     * @param TwitchSessionWrapper $sessionWrapper
     */
    public function __construct(UserRepository $userRepository, Socialite $socialite, TwitchSessionWrapper $sessionWrapper)
    {
        $this->socialite = $socialite;
        $this->userRepository = $userRepository;
        $this->sessionWrapper = $sessionWrapper;
    }

    /**
     * Will try to Authorise the user wit the twitch api.
     * If it receives a confirmation that the code already exist
     * Will fetch the user data.
     *
     * @param $hasCode
     * @return mixed
     */
    public function execute($hasCode)
    {
        if(!$hasCode){
            return $this->getAuthorisation();
        }

        $twitchUserData = $this->getTwitchUser();

        $user = $this->userRepository->findOrCreateUserByUsername($twitchUserData);

        $this->sessionWrapper->setTwitchToken($twitchUserData->token);

        Auth::login($user, false);

        return redirect()->route('home');
    }


    private function getAuthorisation()
    {
        return $this->socialite->with('twitch')->redirect();
    }


    private function getTwitchUser()
    {
        return $this->socialite->with('twitch')->user();
    }
}