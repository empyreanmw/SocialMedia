<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Replies extends Model
{
	use favoritable;
	protected $appends = ['favoritesCount', 'isFavorited', 'favoritesParent'];
	protected $guarded = [];
	protected $with = ['owner'];


	public function replied()
	{
		return $this->morphTo();
	}

	public function owner()
	{
		return $this->belongsTo(User::class, 'user_id');
	}

	public function setBodyAttribute($body)
	{
		$this->attributes['body'] = preg_replace('/@([^\s]+)/', '<a href="/profiles/$1"> $0 </a>', $body);
	}
}
