<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
	public function index()
	{
		$user = User::find(1);		
		auth()->login($user);
		$search = request('name');
		$result = User::where('name', 'like', '%'.$search.'%')->get();
		return response()->json($result, 200);
	}
}
