@extends('layouts.master')
@section('head')
<link rel="stylesheet" type="text/css" href="{{ asset('css/vendor/jquery.atwho.css') }}">
@endsection
@section('content')

<div class="row">
	<profile-info :user="{{$user}}"></profile-info>

	<div class="col-sm-6 blog-main">
		<div class="level">
			<h2 class="flex">{{$user->display_name}}</h2>
			@if(!Auth::guest() && auth()->user()->id != $user->id)
			<follow :data="{{$user}}"></follow>
			@endif
			
		</div>
		
		@if($user->id == auth()->id());
		@include('layouts.posts.create')
		@endif

		@include('profiles.replies')
		
		<flash message="{{session('flash')}}"></flash>
	</div>

	@include('home.right-sidebar')

</div>
@endsection