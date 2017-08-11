@if(isset($facebook) && $facebook)
	@section('facebook-api')
	<script>
		window.fbAsyncInit = function() {
		FB.init({
				appId      : '1127685080630443',
				xfbml      : true,
				version    : 'v2.7'
			});
		};
		(function(d, s, id){
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) {return;}
			js = d.createElement(s); js.id = id;
			js.src = "//connect.facebook.net/pt_BR/sdk.js";
			fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
	</script>
	<div id="fb-root"></div>
	@endsection
@endif
@if(isset($top))
<header id="topo" data-content="true" style="background-image: url('{{$top->url_imagem}}'); background: cover;">
@else
	@if(isset($post))
	<header id="topo" data-content="true" style="background-image: url('{{$post->url_imagem}}'); background: cover;">
	@else
	<header id="topo" data-content="false">
	@endif
@endif
	<section class="overlay"></section>
	<section class="topo-content">
		<section class="topo-menu">
			<a class="logo" href="{{route('posts')}}" alt="Woobe"><img src="/img/logo.fw.png"></a>
			<nav class="menu">
				<ul class="umenu" id="menu">
					<li class="icon"><a href="javascript:void(0);" onclick="menu()">&#9776;</a></li>
					<li>{{ link_to_route('posts', 'Home') }}</li>
					@if(isset($user))
						@if($user->admin)
							<li>{{ link_to_route('admin', 'Usuários') }}</li>
						@endif
						@if($user->moderator || $user->author)
							<li>{{ link_to_route('post.add', 'Novo Post') }}</li>
							<li>{{ link_to_route('categoria', 'Categorias') }}</li>
							<li>{{ link_to_route('galeria', 'Galeria') }}</li>
						@endif
						<li>{{ link_to_route('login.password', 'Alterar senha') }}</li>
						<li>{{ link_to_route('logout', 'Logout') }}</li>
					@else
						<li><a href="http://woobe.com.br" target="_blank">Conheça a Woobe</a></li>
						{{--<li>{{ link_to_route('login', 'Login') }}</li>--}}
					@endif
				</ul>
			</nav>
		</section>
		@if(isset($top))
		<article class="topo-post">
			<div class="post-destaque">Post em destaque</div>
			<p class="post-destaque-titulo">{{$top->title}}</p>
			<p class="post-destaque-texto">{{$top->descricao}}</p>
			<a class="topo-post-btn" href="{{route('post',[$top->key])}}">Leia mais</a>
		</article>
		@endif
		@if(isset($post))
		<article class="topo-post">
			<div class="post-destaque">Por {{$post->user()->name}}</div>
			<div class="post-data">Em {{$post->getFormattedCreatedDateExtended()}}</div>
			<p class="post-destaque-titulo">{{$post->title}}</p>
			<p class="post-destaque-texto">{{$post->descricao}}</p>
		</article>
		@endif
	</section>
</header>
@if(!isset($post))
<section id="categorias">
	<section class="categorias-content">
		<ul>
			@forelse($categorias as $c)
			<li><a href="{{ route('posts.categoria', [$c->id]) }}">{{$c->name}}</a></li>
			@empty
			<li><a href="javascript:void(0);">Nenhuma categoria para exibir</a></li>
			@endforelse
		</ul>
	</section>			
</section>
@endif