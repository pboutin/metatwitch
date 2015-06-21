<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Repositories\UserRepository;
use App\Session\TwitchSessionWrapper;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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

        return route('room');
    }

    /**
     * @param TwitchSessionWrapper $sessionWrapper
     * @param UserRepository $userRepository
     * @return array|\Illuminate\View\View|mixed
     */
    public function room(TwitchSessionWrapper $sessionWrapper, UserRepository $userRepository)
    {
        $user = $this->getConnectedUser();
        $user->updateLastActivity();

        $usersWatchingStream = $userRepository->getUsersWatchingConnectedUserStream($user);
        return view('room', [
            'channelName' => $sessionWrapper->getCurrentTwitchChannel(),
            'userWatchingStream' => $usersWatchingStream
        ]);
    }

    /**
     * Update the user last activity. This route is likely to get pulled by ajax.
     * @param UserRepository $userRepository
     * @return mixed
     */
    public function pingUser(UserRepository $userRepository)
    {
        /** @var User $user */
        $user = $this->getConnectedUser();
        $user->updateLastActivity();
        $user->save();

        $usersWatchingStream = $userRepository->getUsersWatchingConnectedUserStream($user);

        return response()->json($usersWatchingStream);
    }

    /**
     * @return User|null
     */
    private function getConnectedUser()
    {
        return Auth::user();
    }

}
