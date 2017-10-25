@extends('layouts.master')
@section('content')
<div class="row">
	@include('home.left-sidebar')
	<div class="col-sm-6 blog-main">
		<div class="panel panel-default">
			@if(Request::path() == 'profiles/'.$user->urlFriendly().'/messages')
			<div class="panel-heading level">
				<span class="flex">Direct Messages</span>
				<a href="/profiles/{{$user->name}}/messages/newMessage" class="btn btn-default">New Message</a>
			</div>
			@else
			<div class="panel-heading level">
				<a href="{{route('messages', $user)}}" class="flex"><i class="fa fa-chevron-left" aria-hidden="true"></i></a>
				<a href="/profiles/{{$user->name}}" style="font-size: 18px" class="text-center">Zeljko Bogicevic</a>
			</div>
			@endif
			<div class="panel-body" style="padding:0; border-bottom: none">
				<div class="list-group" style="margin-bottom:none">

					@foreach($messages as $message)
					@if(Request::path() == 'profiles/'.$user->urlFriendly().'/messages')
					@include('profiles.messages.message-list')
					@else
					@include('profiles.messages.message')
					@endif
					@endforeach
				</div>
			</div>
		</div>
	</div>

	@include('home.right-sidebar')

</div>
@endsection