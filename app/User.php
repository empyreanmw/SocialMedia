<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\FriendRequest;
use App\Notifications\FriendRequestNotification;
use App\Message;
use Illuminate\Support\Facades\Redis;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'avatar_path', 'data', 'display_name'
    ];


    protected $casts = [
        'data' => 'array',
    ];

    protected $appends = ['followingCount', 'followersCount', 'postCount', 'popularity', 'isFollowing'];
   


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'email'
    ];

    public function getRouteKeyName()
    {
        return 'name';
    }

    public function posts()
    {
        return $this->hasMany(Post::class)->latest();
    }

    public function following()
    {
        return $this->belongsToMany('App\User', 'friend_user', 'user_id', 'friend_id')->with('posts');
    }

    public function followers()
    {
        return $this->belongsToMany('App\User', 'friend_user', 'friend_id', 'user_id')->with('posts');     
    }

    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'receiver_id')->orWhere('sender_id', $this->id);
    }

    public function follow(User $user)
    {
        $this->following()->attach($user);
    }

    public function unFollow(User $user)
    {
        auth()->user()->following()->detach($user->id);
    }

    public function getFollowingCountAttribute()
    {
        return $this->following()->count();
    }

    public function getFollowersCountAttribute()
    {
        return $this->followers()->count();
    }

    public function getPostCountAttribute()
    {
        return $this->posts()->count();
    }

    public function notificationCount($notification)
    {
        return auth()->user()->unreadNotifications()->where('type', $notification)->count();
    }

    public function notificationNav()
    {
        return auth()->user()->unreadNotifications()->where('type', '!=', 'App\Notifications\MessageNotifications');
    }

    public function removeNotification($notificationName, $limit = 1)
    {
        $this->notifications()->where('type', $notificationName)->limit($limit)->delete();
    }

    public function urlFriendly()
    {
        return str_replace(' ', '%20', $this->name);
    }

    static function findUserByName($name)
    {
        return static::where('name', $name)->firstOrFail();
    }

    public function popularity()
    {
        return Redis::zscore('popularity', $this->name) + $this->following()->count();
    }

    public function getPopularityAttribute()
    {
        return $this->popularity();
    }

    public function getIsFollowingAttribute()
    {
        return auth()->user()->following()->where('users.id', $this->id)->count() ? true : false;
    }
}
