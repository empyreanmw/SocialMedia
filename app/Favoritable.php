<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

trait Favoritable
{

	protected static function bootFavoritable()
	{
		static::deleting(function ($model){
			$model->favorites->each->delete();
		});
	}
	public function favorites()
	{
		return $this->morphMany(Favorites::class, 'favorited');
	}

	public function favorite()
	{
		if (! $this->favorites()->where(['user_id' => auth()->id()])->exists())
			return $this->favorites()->create(['user_id' => auth()->id()]);
	}

	public function unfavorite()
	{
		$this->favorites()->where(['user_id' => auth()->id()])->get()->each(function($favorite)
		{
			$favorite->delete();
		});
	}

	public function isFavorited()
	{
		return $this->favorites->where('user_id', auth()->id())->count();
	}

	public function getIsFavoritedAttribute()
	{
		return $this->isFavorited();
	}

	public function getFavoritesCountAttribute()
	{
		return $this->favorites->count();
	}

	public function getFavoritesParentAttribute() //retuns the name of the parent class
	{
		$path = explode('\\', strtolower(ends_with(__CLASS__, 's') ? __CLASS__ : __CLASS__.'s'));
		return array_pop($path);
	}
}