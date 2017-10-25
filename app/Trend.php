<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trend extends Model
{
	protected $guarded = [];

	public function posts()
	{
		return $this->belongsToMany(Post::class);
	}

	public static function getTrends()
	{
		return static::orderBy('post_count', 'DESC')->has('posts')->limit(10)->get();
	}

	public function getRouteKeyName()
	{
		return 'name';
	}
}
