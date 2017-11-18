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

<<<<<<< HEAD
	public static function get($search=null)
=======
	public static function get()
>>>>>>> 6f555e7... Added api support for listing Top trends, post and users. Also added support for creating users via API.
	{
		return static::where('name', 'like', '%'.$search.'%')->orderBy('post_count', 'DESC')->has('posts')->limit(10)->get();
	}

	public function getRouteKeyName()
	{
		return 'name';
	}
}
