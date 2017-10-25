<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class NotificationsController extends Controller
{
	public function index(User $user)
	{
		$notifications = $user->notifications;
		$user->notifications->markAsRead();
		
		return view('home.notifications', compact('notifications'));
	}
}
