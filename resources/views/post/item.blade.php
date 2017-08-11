<article class="conteudo-content">
	<section class="conteudo-content-holder">
		@if(isset($user) && ($user->moderator || ($user->author && $p->user()->id == $user->id)))
		<section class="conteudo-content-action">
			<p class="categoria-link"><a href="javascript:void(0);" data-id="{{$p->id}}" class="btn-editar">Editar</a></p>
			@if($p->active)
			<p class="categoria-link-blue"><a href="javascript:void(0);" data-id="{{$p->id}}" data-active="0" class="btn-ativar">Desativar</a></p>
			@else
			<p class="categoria-link-blue"><a href="javascript:void(0);" data-id="{{$p->id}}" data-active="1" class="btn-ativar">Ativar</a></p>
			@endif
			<p class="categoria-link-red"><a href="javascript:void(0);" data-id="{{$p->id}}" class="btn-excluir">Excluir</a></p>
		</section>
		@endif
		<a href="{{ route('post', [$p->key]) }}"><div class="conteudo-content-holder-img" style="background-image: url('{{$p->url_imagem}}');"></div></a>
		<section class="conteudo-content-holder-text">
			<p class="conteudo-content-categoria"><a href="{{ route('posts.categoria', [$p->categoria()->id]) }}">{{$p->categoria()->name}}</a></p>
			<p class="conteudo-content-data">{{$p->getFormattedCreatedDate()}}</p>
			<p class="conteudo-content-titulo"><a href="{{ route('post', [$p->key]) }}">{{ $p->title }}</a></p>
			<p class="conteudo-content-texto">{{$p->descricao}}</p>	
		</section>
	</section>	
</article>