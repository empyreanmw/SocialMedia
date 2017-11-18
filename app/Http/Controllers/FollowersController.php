<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Notifications\FollowerNotification;

class FollowersController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

       $followTarget = User::find(request('id')); 
       auth()->user()->follow($followTarget);
       $followTarget->notify(new FollowerNotification(auth()->user()));
    }

    public function destroy()
    {
        auth()->user()->unFollow(User::find(request('id')));
    }

    public function displayFollowing(User $user)
    {
        $users = $user->following()->get();

        return view('profiles.followers', compact('users'));
    }

    public function displayFollowers(User $user)
    {
        $users = $user->followers()->get();

        return view('profiles.followers', compact('users'));
    }
}
