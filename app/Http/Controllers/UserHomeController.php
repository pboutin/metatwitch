<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Repositories\UserRepository;
use App\Session\TwitchSessionWrapper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserHomeController extends Controller
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
            'followed' => $userRepository->getFollowedChannelsFor(Auth::user()->username)
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

        return route('room');
    }

    /**
     * @param TwitchSessionWrapper $sessionWrapper
     * @return array|\Illuminate\View\View|mixed
     */
    public function room(TwitchSessionWrapper $sessionWrapper)
    {
        return view('room', ['channelName' => $sessionWrapper->getCurrentTwitchChannel()]);
    }

}
