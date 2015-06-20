<?php

namespace App\Http\Controllers;

use App\Authentication\AuthenticateUser;
use App\Http\Requests;
use Illuminate\Http\Request;

class TwitchOauthController extends Controller
{
    /**
     * @param AuthenticateUser $authenticateUser
     * @param Request $request
     * @return mixed
     */
    public function login(AuthenticateUser $authenticateUser, Request $request)
    {
        return $authenticateUser->execute($request->has('code'));
    }
}
