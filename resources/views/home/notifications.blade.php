@extends('layouts.master')
@section('content')

<div class="rows">
	@include('home.left-sidebar')
	<div class="col-sm-6 blog-main">
		<div class="panel panel-default" style="padding: none">
			<div class="panel-body" style="padding: 0">
				<ul class="list-group">
					@forelse($notifications as $notification)

					@include('home.notifications.'.shortClassName($notification->type))
					@empty
					You do not have any notifications.
					@endforelse
				</ul>
			</div>
		</div>


	</div>	
</div>
</div>

@endsection