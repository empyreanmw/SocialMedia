<a href="/profiles/{{$user->name}}/messages/{{$message->id}}/show" class="list-group-item ">
	<div class="row"> 
		<div class="col-sm-2">
			<img height="55px" width="55px" src="{{$message->owner->name == $user->name ? asset('storage/'.$message->receiver->avatar_path) : asset('storage/'.$message->owner->avatar_path)}}">
		</div>
		<div class="col-sm-10" style="padding-left: 0">
			<div class="level">
				<span class="flex" style="font-size: 16px">&nbsp; 	<i aria-hidden="true" class="fa fa-user-o"></i>&nbsp; 
					{{$message->owner->name == $user->name ? $message->receiver->name : $message->owner->name }}
				</span>
				<small class="pull-right ">{{$message->created_at->diffForHumans()}}</small><br>
			</div>
			<div style="padding-left: 7px; padding-top:10px">			
				<span>
					@if($message->replies()->exists())
					{{$message->replies->last()->owner->name == $user->name ? "You:" : "" }}
					@endif
					{{$message->replies()->exists() ? words($message->replies->last()->body) : words($message->body)}}
				</span>
			</div>

		</div>
	</div>

</a>