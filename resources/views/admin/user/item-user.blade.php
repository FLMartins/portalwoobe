	<article class="conteudo-content">
	<section class="conteudo-content-holder">
		<section class="conteudo-content-holder-text">
			<p class="conteudo-content-data">{{$u->name}}</p>
			<p class="conteudo-content-titulo">{{$u->email}}</p>
			<section>
				
			<section class="conteudo-content-holder-text-left">
				<p class="conteudo-content-categoria"><a href="{{ route('admin.edit', ['id'=>$u->id]) }}">Editar</a></p>
				<p class="conteudo-content-categoria-blue"><a href="javascript:resetar({{$u->id}});">Resetar senha</a></p>
				<p class="conteudo-content-categoria-red"><a href="javascript:excluir({{$u->id}});">Excluir</a></p>
			</section>											
	</section>	
</article>