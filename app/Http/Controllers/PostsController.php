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



<<<<<<< HEAD

=======
>>>>>>> 03e45cb... Added a new feature: Autoload posts on home page while iddle
class PostsController extends Controller
{
	public function __construct()
	{
<<<<<<< HEAD
		$this->middleware('auth');	
=======
		//$this->middleware('auth');	
>>>>>>> 6f555e7... Added api support for listing Top trends, post and users. Also added support for creating users via API.
	}
	
	public function trends(Trend $trend)
	{
		$posts = $trend->posts()->latest()->get();

		return view ('home.show', compact('posts'));
	}

	public function store(Request $request, User $user, Spam $spam)
	{
			$this->validate($request, [
				'body' => ['required','min:2', new SpamDetection($spam, "posts")]
			]);

			$post = Post::create([
				'body' => request('body'),
				'user_id' => auth()->id(),
				'profile_id' => $user->id		
			]);
			
			$post->createTrend(request('body'));
			event(new Mentionable($post->load('owner', 'replies')));
		
<<<<<<< HEAD
			if (request()->expectsJson()){
				return $post->load('owner');
			}
=======
		//	return $request()->json($post);
		if (request()->expectsJson()){
			return $post->load('owner');
		}
>>>>>>> 6f555e7... Added api support for listing Top trends, post and users. Also added support for creating users via API.

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

	public function autoLoadNewPosts()
	{
		$latestPostId = collect(request('posts'))->first()['id'];
		$posts = array();

<<<<<<< HEAD
<<<<<<< HEAD
		if(!$latestPostId) return 	Post::getFollowingPosts();

=======
>>>>>>> 03e45cb... Added a new feature: Autoload posts on home page while iddle
=======
		if(!$latestPostId) return 	Post::getFollowingPosts();

>>>>>>> 6f555e7... Added api support for listing Top trends, post and users. Also added support for creating users via API.
		Post::getFollowingPosts()->each(function($post) use ($latestPostId, &$posts){
			if($post->id>$latestPostId)
			{
				$posts[] = $post;
			}
		});

<<<<<<< HEAD
		return $posts;  
=======
		return $posts;
   
>>>>>>> 03e45cb... Added a new feature: Autoload posts on home page while iddle
	}

	public function popularPosts()
	{
		$user = User::find(1);
		auth()->login($user);

			if(Post::all()->isNotEmpty())
			{
				$posts= Post::all()->sortByDesc('popularity')->take(10);
				$posts = array_values($posts->toArray()); //converting collection to array, otherwise ordering will be messed up byy json function
				return response()->json($posts);
		    }

			return response()->json(['message' => 'There  are no posts!']);
	}
		 

}
