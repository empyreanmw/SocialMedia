@extends('layouts.master')
@section('content')
<div class="container">
	<div class="rows">
		<div class="col-sm-6 blog-main">
			@foreach ($requests as $request)
			<div class="friend">
				{{$request->owner->name}}
				<form method="POST" action="/profiles/{{$user->name}}/friends/create">
					{{csrf_field()}}
					<div class="form-check">
						<label class="form-check-label">
							<input class="form-check-input" type="radio" name="decision" id="exampleRadios1" value="1" checked>
							Accept
						</label>
					</div>
					<div class="form-check">
						<label class="form-check-label">
							<input class="form-check-input" type="radio" name="decision" id="exampleRadios2" value="0">
							Decline
						</label>
					</div>
					<input type="hidden" name="request_id" value="{{$request->request_id}}">
					<button type="submit" class="btn btn-primary btn-sm pull-right">Submit</button>
				</form>
			</div>
			@endforeach
		</div>
	</div>
</div>
@endsection