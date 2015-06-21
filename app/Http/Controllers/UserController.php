<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Repositories\UserRepository;
use App\Session\TwitchSessionWrapper;
use App\User;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Home page
     *
     * @param UserRepository $userRepository
     * @return \Illuminate\View\View
     */
    public function home(UserRepository $userRepository)
    {
        return view('home', [
            'followed' => $userRepository->getFollowedChannelsFor($this->getConnectedUser()->username)
        ]);
    }

    /**
     * @param Request $request
     * @param TwitchSessionWrapper $sessionWrapper
     * @return string
     */
    public function gotoRoom(Request $request, TwitchSessionWrapper $sessionWrapper)
    {
        $channelName = $request->input('channel_name');
        $sessionWrapper->setCurrentTwitchChannel($channelName);

        $user = $this->getConnectedUser();
        $user->current_channel = $channelName;
        $user->save();

        return redirect()->route('room');
    }

    /**
     * @param TwitchSessionWrapper $sessionWrapper
     * @return array|\Illuminate\View\View|mixed
     */
    public function room(TwitchSessionWrapper $sessionWrapper)
    {
        return view('room', ['channelName' => $sessionWrapper->getCurrentTwitchChannel()]);
    }

    /**
     * Update the user last activity. This route is likely to get pulled by ajax.
     */
    public function pingUser()
    {
        /** @var User $user */
        $user = $this->getConnectedUser();
        $user->updateLastActivity();
        $user->save();
    }

    /**
     * @return User|null
     */
    private function getConnectedUser()
    {
        return Auth::user();
    }

}
