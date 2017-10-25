  <div class="blog-masthead">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">  
          <nav style="margin-top: 5px">
            <a class="nav-link" href="{{ route('home') }}"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
            <a class="nav-link" href="{{ route('notifications', auth()->user()) }}"><i class="fa fa-bell" aria-hidden="true"></i> 
              Notifications @if(auth()->user()->unreadNotifications->where('type', '!=', 'App\Notifications\MessageNotifications')->count()>0)
              <span style="margin-bottom: 4px;" class="badge">{{auth()->user()->unreadNotifications->where('type', '!=', 'App\Notifications\MessageNotifications')->count()}}</span>
              @endif
            </a>
            <a class="nav-link" href="/profiles/{{auth()->user()->name}}/messages"><i class="fa fa-envelope" aria-hidden="true"></i> Messages 
              <span style="margin-bottom: 4px;" class="badge">
                {{auth()->user()->notificationCount('App\Notifications\MessageNotifications' ) ? auth()->user()->notificationCount('App\Notifications\MessageNotifications' ) : ""}}
              </span>
            </a>
          </nav>    
        </div><!-- /input-group -->
        <div class="col-lg-6">
          <nav style="margin-top: 5px" class="nav pull-right">
          <div class="row">
                <div class="col-lg-6">
                    <div>
                      <form method="GET" action="/people">
                        <div class="input-group" style="position:relative; top:-5px; ">
                          <input type="text" class="form-control" style="height: 32px" name="name" placeholder="Search for...">
                          <span class="input-group-btn">
                            <button class="btn btn-default" style="height: 32px" type="submit">Go!</button>
                          </span>
                          </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6">
                   <div class="dropdown">
                <a onclick="myFunction()" style="padding:0" class="dropbtn">
                  <i class="fa fa-user" aria-hidden="true"></i> 
                  {{Auth::user()->name}} 
                </a>
                <div id="myDropdown" class="dropdown-content">
                  <a href="/profiles/{{auth()->user()->name}}"> <i class="fa fa-user-o" aria-hidden="true"></i>  My Profile</a>
                  <a  href="{{ route('logout') }}"  onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">
                  <i class="fa fa-power-off" aria-hidden="true"></i> Logout
                </a>
                @foreach(auth()->user()->notificationNav() as $nav)     
                <a href="/profiles/{{auth()->user()->name}}/{{$nav->data['link']}}">{{$nav->data['name']}} <span class="badge">{{auth()->user()->notificationCount($nav->type)}}</span></a>
                @endforeach
              </div>
            </div>
            @if(!auth::check())
            <a class="nav-link active" href="{{ route('login') }}"><i class="fa fa-sign-in" aria-hidden="true"></i> Login</a>
            <a class="nav-link" href="{{ route('register') }}"><i class="fa fa-pencil-square" aria-hidden="true"></i> Register</a>

            @else

            <a class="nav-link" href="{{ route('logout') }}"  onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
            <i class="fa fa-power-off" aria-hidden="true"></i> Logout
          </a>

          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
          </form>
                </div>                
          </div>
            
           
          @endif


        </nav>

      </div><!-- /.col-lg-6 -->
    </div>
  </div>
</div>


