<post-create :data="{{$user}}"></post-create>

@if(count($errors))
<ul class="alert alert-danger noStyleList">

  @foreach($errors->all() as $error)
  <li> {{$error}}</li>
  @endforeach 
</ul>
@endif