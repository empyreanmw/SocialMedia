<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
	public function index()
	{
		$search = request('name');
		return User::where('name', 'LIKE', "$search%")->take(5)->pluck('name');
	}
}
