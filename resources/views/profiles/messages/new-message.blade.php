@extends('layouts.master')
@section('content')

<div class="row">
	@include('home.left-sidebar')
	<div class="col-sm-6 blog-main">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="text-center">New Messages</h4>
			</div>
			<new-message v-cloak class="panel-body" style=" border-bottom: none" inline-template>
				<div class="list-group" style="margin-bottom:none">		
					<form action="/profiles/{{$user->name}}/messages/newMessage/create" method="POST">
						{{csrf_field()}}	
						<div class="form-group">
							<label for="user">Send message to:</label>
							<input v-model="receiverField" type="text" class="form-control" id="name" placeholder="Name" value="{{old('name')}}" name="name">
						</div>
						<div >
							<label for="avatar">Recent:</label><br>
							<div class="list-group">
								@foreach($receivers as $receiver)
								<a v-on:click.prevent="setReceiver('{{$receiver->owner->name}}')" style="border:none" href="#" class="list-group-item">
									<img id="avatar" class="avatar-rounded" src="{{asset('storage/'.$receiver->owner->avatar_path)}}"> 

									<span ><strong >{{$receiver->owner->name}}</strong></span>
								</a>
								@endforeach
							</div>
						</div>
						<div class="form-group">
							<label for="bodt">Message body:</label>
							<textarea class="form-control" placeholder="Message" name="body">{{old('body')}}</textarea> 
						</div>
						<button class="btn btn-primary btn-sm" type="submit">Send</button>
					</form>
					@include('layouts.errors')				
				</div>
			</new-message>
		</div>
	</div>
	<flash message="{{session('flash')}}" type="{{session('type')}}"></flash>
	
</div>
@endsection