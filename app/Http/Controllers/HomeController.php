<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $friends = auth()->user()->following()->has('posts')->get();
        $posts = array();

        if (count($friends)) {
            foreach ($friends as $friend) {
                $posts[] = $friend->posts;
            }
        }
        
        return view('home.show', compact('posts'));
    }

    public function people()
    {
        $users = User::where('name', request('name'))->get();

        return view('home.people', compact('users'));
    }
}
