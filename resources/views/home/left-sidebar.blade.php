<div class="col-sm-3 offset-sm-1 blog-sidebar">
  <div class="panel panel-default" style="padding: 10px">
   <img style="width:100px; height:100px; border-radius: 75px" src="{{asset('storage/'.auth()->user()->avatar_path)}}">
   <strong style="position:absolute; top:70px; font-size: 18px">{{auth()->user()->name}}</strong>
   <div style="margin-top: 10px">
    <ul style="list-style: none; display: table; padding: 0px; "> 
      <li style="float: left; margin-right: 15px">
        <a href="/profiles/{{auth()->user()->name}}/following">
          <span style="color:#657786; font-weight: bold">Following</span> <br>
          <span>{{auth()->user()->followingCount}}</span>
        </a>
      </li>
      <li style="float: left; margin-right: 15px" >
        <a href="/profiles/{{auth()->user()->name}}/followers">
          <span style="color:#657786; font-weight: bold">Followers</span> <br>
          <span>{{auth()->user()->followersCount}}</span>
        </a>
      </li>
      <li style="float: left">
        <a href="#">
          <span style="color:#657786; font-weight: bold">Posts</span> <br>
          <span>{{auth()->user()->postCount}}</span>
        </a>
      </li>
    </ul>
  </div>
</div>
@if($trends->count() > 0)
<div class="panel panel-default" style="padding: 10px">
  <h4>Trends for you</h4>
  <ol class="list-unstyled">
    @foreach($trends as $trend)
    <li style="margin-bottom: 10px">
      <a href="/trending/{{$trend->name}}">#{{$trend->name}}</a>
      <br>
      <small>{{ $trend->post_count}} {{str_plural('post', $trend->post_count)}}</small></li>
      @endforeach
    </ol>
  </div>
  @endif
  </div><!-- /.blog-sidebar -->