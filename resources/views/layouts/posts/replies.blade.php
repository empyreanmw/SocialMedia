
@foreach($posts  as $post )

@foreach ($post->posts as $pest)

<post :attributes= "{{$pest}}" inline-template>
  <div class="panel panel-default">

    <div class="panel-body">
      <a href="/profiles/{{$pest->owner->name}}">{{$pest->owner->name}}</a> <small>{{$pest->created_at->diffForHumans()}}  </small>
      <br>
      {{$pest->body}}

      <div class="post-footer">    
        <span class="move-right" @click = "replies = !replies" ><i class="fa fa-comment-o" aria-hidden="true"></i> {{$pest->replies->count()}}</span>  <span  class="move-right"><i class="fa fa-heart-o" aria-hidden="true"></i> </span> <span  @click = "reply = !reply" class="move-right"><i class="fa fa-comments-o" aria-hidden="true"></i></span>
      </div>

      <div v-if="replies" class="reply-pannel">
       @foreach($pest->replies as $reply)
       <div class="post-replies">
        <a href="/profiles/{{$reply->owner->name}}">{{$reply->owner->name}}</a>
        {{$reply->body}}
        <br>
        <small>{{$reply->created_at->diffForHumans()}}</small> 
      </div>
      @endforeach
    </div>
    <div v-if="reply">
      <form  method="POST" action="/replies/create">

        {{csrf_field()}}
        <div class="form-group">
          <textarea style="resize:none;  box-shadow: none" class="form-control" rows="1" name="body" id="body" required placeholder="Write a comment.."></textarea>
          <input type="hidden" name="post_id" value={{$pest->id}}>
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-primary btn-sm">Post</button>
        </div>

      </form>
    </div>

  </div>

</div>
</post>
@endforeach

@endforeach