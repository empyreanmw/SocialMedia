
@forelse($posts as $post)

<posts :data="{{$post}}"></posts>
@empty
<p>No replies</p>
@endforelse