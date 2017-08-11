<section class="imagem">
	<section class="imagem-content-action">
		<p class="imagem-link-red"><a href="javascript:void(0);" data-image="{{$f['name']}}" class="btn-excluir">Excluir</a></p>
	</section>
	<img src="{{$f['url']}}">
	<p class="imagem-text">{{$f['name']}} - <a href='javascript:copiar("{{$f['url']}}");'>Copiar URL</a></p>
	<p class="imagem-data">Upload em {{$f['data']}}</p>
</section>