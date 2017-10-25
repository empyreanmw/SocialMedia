@extends('layouts.master')
@section('content')
<div class="container">
	<div class="rows">
		@include('home.left-sidebar')
		<div class="col-sm-6 blog-main">
			@foreach($posts as $post)
			@foreach($post as $post)
			<div class="panel panel-default">

				<div class="panel-body">
					<a href="/profiles/{{$post->owner->name}}">{{$post->owner->name}}</a>
					{{$post->body}}
					<br>

					<div class="post-footer">     
						<small>{{$post->created_at->diffForHumans()}} - </small>  
						<small>Comment</small> - 
						<small>Like</small>
					</div>

					@foreach($post->replies as $reply)
					<div class="post-replies">
						<a href="/profiles/{{$reply->owner->name}}">{{$reply->owner->name}}</a>
						{{$reply->body}}
						<br>
						<small>{{$reply->created_at->diffForHumans()}}</small> 
					</div>
					@endforeach

					<form class="" method="POST" action="/replies/create">

						{{csrf_field()}}
						<div class="form-group">
							<textarea style="resize:none;  box-shadow: none" class="form-control" rows="1" name="body" id="body" required placeholder="Write a comment.."></textarea>
							<input type="hidden" name="post_id" value={{$post->id}}>
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-primary btn-sm">Post</button>
						</div>

					</form>
				</div>

			</div>
			@endforeach
			@endforeach
		</div>
		@include('home.left-sidebar')
	</div>
</div>
@endsection