@foreach($posts as $p)
	@include('post.item',['p'=>$p, 'user'=>$user])
@endforeach
