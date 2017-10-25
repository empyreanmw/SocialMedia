<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class message extends Model
{
	use Repliable;

	protected $guarded = [];
	protected $with = ['owner', 'receiver'];


	public function owner()
	{
		return $this->belongsTo(User::class, 'sender_id');
	}

	public function receiver()
	{
		return $this->belongsTo(User::class, 'receiver_id');
	}

	static function messageExist($user)
	{
		$sender = static::where('sender_id', auth()->user()->id)->where('receiver_id', $user);
		$receiver = static::where('sender_id', $user)->where('receiver_id', auth()->user()->id);
		
		return $sender->exists() ?  $sender : $receiver;
	}
}
