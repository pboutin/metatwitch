<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class UserHomeController extends Controller
{
    /**
     * Home page
     *
     * @return \Illuminate\View\View
     */
    public function home()
    {
        dd(Auth::user());
    }

}
