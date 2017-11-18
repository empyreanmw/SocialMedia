<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Reply;
use App\Trend;
use App\Replies;
use App\Utilities\wordSearch;





class Post extends Model
{
	use favoritable, Repliable;

	protected $appends = ['favoritesCount', 'isFavorited', 'repliesCount', 'favoritesParent', 'popularity'];

	protected $guarded = [];

	protected $with = ['owner', 'replies'];

	protected static function boot ()
	{
		parent::boot();

		static::deleting(function ($post){
			$post->replies()->delete();
			$post->trends()->decrement('post_count');
			$post->trends()->where('post_count', 0)->delete();

		}); 


	}

	public function owner()
	{
		return $this->belongsTo(User::class, 'user_id');
	}

	public function trends()
	{
		return $this->belongsToMany(Trend::class);
	}

	public function createTrend($body)
	{
		$trends = wordSearch::get(request('body'), '#');

		if (!empty($trends))
		{
			foreach($trends as $trend)
			{
				$existingTrend = Trend::where('name', $trend);

				if(!$existingTrend->exists())
				{
					$trend = Trend::create([
						'name' => $trend
					]);

					$this->trends()->attach($trend);
				}
				else
				{
					$this->trends()->attach($existingTrend->get());
					$existingTrend->increment('post_count');
				}

			}
		}
	}

	public function getRepliesCountAttribute()
	{
		return $this->replies()->count();
	}

	public function setBodyAttribute($body)
	{
		$this->attributes['body'] = preg_replace('/@([^\s]+)/', '<a class="modal-prevent" href="/profiles/$1"> $0 </a>', $body);
	}

	public static function getFollowingPosts()
	{
		if(auth()->guest()) return;
		$posts = array();
        
        auth()->user()->following()->has('posts')->get()->each(function($friend) use (&$posts){
             $posts[] = $friend->posts;
			 });
			 
		return collect($posts)->collapse();	 
	}

	public function getPopularityAttribute()
	{
		return $this->getFavoritesCountAttribute() + $this->getRepliesCountAttribute();
	}

}
