<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Trend;
use App\Utilities\wordSearch;
use App\Events\Mentionable;
use App\Inspections\Spam;
use App\Rules\SpamDetection;


class PostsController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function trends(Trend $trend)
	{
		$posts = array();
		$collection = $trend->posts()->latest()->get();

		if ($collection->count()>0)
		{
			$posts[0] = $collection;
		}
		
		return view ('home.show', compact('posts'));
	}

	public function store(Request $request, User $user, Spam $spam)
	{

			$this->validate($request, [
				'body' => ['required', new SpamDetection($spam, $user)]
			]);
	
			$post = Post::create([
				'body' => request('body'),
				'user_id' => auth()->id(),
				'profile_id' => $user->id		
			]);
	
			$post->createTrend(request('body'));
	
			event(new Mentionable($post->load('owner', 'replies')));


		
		if (request()->expectsJson()){
			return $post->load('owner');
		}

		return redirect()->back();
	}

	public function destroy(Post $post)
	{
		$this->authorize('delete', $post);
		$post->delete();
	}

	public function favorite(Post $post)
	{
		$post->favorite();
	}

	public function unfavorite(Post $post)
	{
		$post->unfavorite();
	}

}
