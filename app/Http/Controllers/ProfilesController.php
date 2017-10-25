<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\FriendRequest;
use App\Post;
use App\Activity;
use Illuminate\Support\Facades\Redis;

class ProfilesController extends Controller
{
	public function __construct(User $user)
	{
		$this->middleware('authUser:'.$user->id)->only('friends');
	}	
	
	public function show(User $user)
	{
		$posts = array();
		$collection = Post::where('profile_id', $user->id)->get();

		Redis::zincrby('popularity', 1, $user->name);
		
		if ($collection->count()>0)
		{
			$posts[0] = $collection;
		}
		
		return view('profiles.show', compact('user', 'posts'));
	}

}

