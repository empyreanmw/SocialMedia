<div class="col-sm-3 offset-sm-1 blog-sidebar">
@if(count($peopleYouMayKnow))
 <div class="panel panel-default" style="padding:10px">
 <h3 style="margin-top:0px">Who to follow</h3>
    @foreach($peopleYouMayKnow as $user)
        <div class="level">
         <div class="flex">
         							<username-link :data="{{$user}}"></username-link>
     
         </div>
          <follow :data="{{$user}}"></follow>
        </div>
    @endforeach
  </div>
  @endif
</div><!-- /.blog-sidebar -->