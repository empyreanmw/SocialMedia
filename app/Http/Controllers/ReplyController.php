<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Notifications\Reply;
use App\Replies;
use App\Inspections\Spam;

class ReplyController extends Controller
{
	public function store(Request $request, Spam $spam)
	{
		try {
			
			$this->validate($request, [
				'body' => 'required'
			]);
			
			$spam->check(request('body'));
	
			$post = Post::where('id', request('post_id'))->get()->first();
			$reply = $post->createReply(request('body'));
			
			if($post->owner->id != $reply->user_id)
			{
				$post->owner->notify(new Reply($post->load('owner'), $reply));
			}
		}

		catch (\Exception $e) {
			
			return response (
				$e->getMessage(), 422
			);
		}

		if (request()->expectsJson())
		{
			return $reply->load('owner');
		}

		return redirect()->back();
	}

	public function delete(Post $post, $replyId)
	{
		if (request()->expectsJson())
		{
			return $post->deleteReply($replyId);
		}
	}

	public function favorite(Replies $reply)
	{
		$reply->favorite();
	}

	public function unfavorite(Replies $reply)
	{
		$reply->unfavorite();
	}
}
