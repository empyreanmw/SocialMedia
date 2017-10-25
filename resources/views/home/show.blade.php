@extends('layouts.master')
@section('content')
<div class="row">

	@include('home.left-sidebar')

	<div class="col-sm-6 blog-main">
		
		
		@include('profiles.replies')
		
		
	</div><!-- /.blog-main -->

	@include('home.right-sidebar')
	<flash message="{{session('flash')}}" type="{{session('type')}}"></flash>
	
</div><!-- /.row -->

@endsection