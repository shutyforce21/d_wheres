<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    public function getFollows()
    {
        $userId = Auth::id();
    }

    public function getFollowers()
    {

    }
}
