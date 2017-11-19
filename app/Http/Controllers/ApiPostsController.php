<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Events\Mentionable;
use App\Inspections\Spam;
use App\Rules\SpamDetection;
use App\Post;


class ApiPostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.auth')->except('index');
    }

    public function index()
    {

        if (Post::all()->isNotEmpty()) {
            $posts = Post::all()->sortByDesc('popularity')->take(10);
            $posts = array_values($posts->toArray()); //converting collection to array, otherwise ordering will be messed up byy json function
            return response()->json($posts);
        }

        return response()->json(['message' => 'There  are no posts!']);

    }

    public function store(Request $request, Spam $spam)
    {
        if (!$user = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['msg' => 'user not found']);
        }

        $this->validate($request, [
            'body' => ['required', 'min:2', new SpamDetection($spam, "posts")]
        ]);

        $post = Post::create([
            'body' => request('body'),
            'user_id' => auth()->id(),
            'profile_id' => $user->id
        ]);

        $post->createTrend(request('body'));

        event(new Mentionable($post->load('owner', 'replies')));

        return response()->json($post);

    }
}
