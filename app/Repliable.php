<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Events\Mentionable;

trait Repliable
{

	public function replies()
	{
		return $this->morphMany(Replies::class, 'replied');
	}

	public function createReply($body)
	{
		$reply = $this->replies()->create([
			'user_id' => auth()->id(),
			'body' => $body
		]);

		event(new Mentionable($reply, $this));

		return $reply;
	}

	public function deleteReply($reply)
	{
		$this->replies()->where('id', $reply)->delete();
	}

}