<div class="message-panel">
	<div class="row" style="margin-bottom: 20px">
		<div class="col-sm-2">
			<img height="55px" width="55px"  src="{{asset('storage/'.$message->owner->avatar_path)}}">
		</div>
		<div class="col-sm-10" style="padding-left: 0">
			<div class="level">
				<span class="flex" style="font-size: 16px">&nbsp; 	<i aria-hidden="true" class="fa fa-user-o"></i>&nbsp; {{$message->owner->name}}</span>
				<small class="pull-right ">{{$message->created_at->diffForHumans()}}</small><br>
			</div>
			<div style="padding-left: 7px; padding-top:10px">
				<span >{{words($message->body)}}</span>
			</div>
		</div>
	</div>
	@foreach($message->replies as $reply)
	<div class="row" style="margin-bottom: 20px">
		<div class="col-sm-2">
			<img height="55px" width="55px"  src="{{asset('storage/'.$reply->owner->avatar_path)}}">
		</div>
		<div class="col-sm-10" style="padding-left: 0">
			<div class="level">
				<span class="flex" style="font-size: 16px">&nbsp; 	<i aria-hidden="true" class="fa fa-user-o"></i>&nbsp; {{$reply->owner->name}}</span>
				<small class="pull-right ">{{$reply->created_at->diffForHumans()}}</small><br>
			</div>
			<div style="padding-left: 7px; padding-top:10px">
				<span >{{words($reply->body)}}</span>
			</div>
		</div>
	</div>
	@endforeach
	
</div>
<div style="background-color: #E5F2F7; padding: 10px;">
	<form action="/profiles/{{auth()->user()->name}}/messages/{{$message->id}}/createReply" method="POST">
		{{csrf_field()}}
		<div class="row" >
			<div class="col-sm-10" style="padding-right: 0">
				<div class="form-group">
					<input type="text" class="form-control" name="body">
				</div>
			</div>
			<div class="col-sm-2">
				<button type="submit" class="btn btn-success">Send</button>
			</div>
		</div>
	</form>
</div>
<flash message="{{session('flash')}}" type="{{session('type')}}"></flash>

