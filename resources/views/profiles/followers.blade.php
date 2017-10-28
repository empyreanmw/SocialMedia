@extends('layouts.master')
@section('content')
<div class="row">
    @include('home.left-sidebar')
        @forelse($users as $user)
        <div class="col-sm-3 blog-main">
            <user-info-popup :data="{{$user}}"></user-info-popup>
              </div>
        @empty
        This thing is empty
        @endforelse
</div>
@endsection