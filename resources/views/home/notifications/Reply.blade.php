<li class="list-group-item" style="border-left: none;">
	<img id="avatar" class="avatar-rounded" src="{{asset('storage/'.$notification->data['model']['owner']['avatar_path'])}}"> &nbsp;
	<a href="/profiles/{{$notification->data['model']['owner']['name']}}">{{$notification->data['replyOwner']}}</a>
	has replied to your <a data-toggle="modal" data-target="#{{$notification->data['model']['id']}}" href="" >post</a>
</li>
<post :data="{{json_encode($notification->data['model'])}}"></post>