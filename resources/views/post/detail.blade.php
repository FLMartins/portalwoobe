@extends('post.parent')
@section('content')
@include('common-header', ['post'=>$post,'categorias'=>$categorias,'user'=>$user, 'facebook'=>true])
	<section id="conteudo-post-full">
		@include('post.advertise-corner')
		<section class="conteudo-fix-post-full">
			<article class="conteudo-fix-post-full-content">
				<div class="conteudo-fix-post-full-content-texto">{!! $post->text !!}</div>
				<div class="fb-like" data-href="{{Request::url()}}" data-width="200" data-layout="button_count" data-action="like" data-size="large" data-show-faces="true" data-share="true"></div>
			</article>
			<div class="fb-comments" data-href="{{Request::url()}}" data-numposts="2" data-width="100%"></div>
			<span class="clearfix"></span>
		</section>
		@include('post.advertise-post')
		<span class="clearfix"></span>
	</section> 
	{{--
	@if(count($latest)>0)
	<section id="ultimas">
		<section class="ultimas-content">
			<p class="title">Últimas postagens</p>
			@foreach($latest as $p)
				@include('post.item',['p'=>$p, 'user'=>$user])
			@endforeach
		<span class="clearfix"></span>
		</section>	
	</section>
	@endif
	--}}
<script type="text/javascript">
$(function(){
	var topContent = $("#topo").attr('data-content');
	$(document).scroll(function(){
		var scrollHeight = $(this).height() - $(window).height();
		var scrolledPixels = $(this).scrollTop();
		if (scrolledPixels+80 >= scrollHeight) {
			ajaxLoad();
		}
		if (topContent=="true") {
			var inicio = $("#conteudo-post-full");
			controlPixels = inicio.position().top;
		}else{
			controlPixels=170;
		}

		if(scrolledPixels>=controlPixels) {
	    	$('#ad-woobe-wrapper').css({position:"fixed", top:10}); 
		}else{
			$('#ad-woobe-wrapper').css({position:"absolute", top:10}); 
		}
	});
});
</script>
@endsection