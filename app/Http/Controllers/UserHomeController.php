<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Repositories\UserRepository;
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

        $user = Auth::user();
        dd($userRepository->getFollowedChannelsFor($user->username));
        return view('dashboard');
    }

}
