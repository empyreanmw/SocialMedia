<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {   
        $posts = Post::getFollowingPosts();
        $user = auth()->user();
        return view('home.show', compact('posts', 'user'));
    }

    public function people()
    {
        $users = User::where('name', request('name'))->get();

        return view('home.people', compact('users'));
    }
}
