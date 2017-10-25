@extends('layouts.master')
@section('content')
<div class="row">

	@include('home.left-sidebar')
	<div class="col-sm-6 blog-main">
		<div class="panel panel-default" style="padding:10px">
			@forelse($users as $user)
			<div class="level">
				<img id="avatar" class="avatar-rounded" src="{{asset('storage/'.$user->avatar_path)}}"> &nbsp;
				<a class="flex" href="{{route('profile', $user->name)}}"> {{$user->name}}</a>
				@if(!Auth::guest())
				<follow :data="{{$user}}"></follow>
				@endif
				
			</div>
			@empty
			No user with this name.
			@endforelse
		</div>	
		
	</div><!-- /.blog-main -->

	@include('home.right-sidebar')
</div><!-- /.row -->
@endsection