@extends('post.parent')
@section('content')
@include('common-header', ['top'=>null,'categorias'=>$categorias,'user'=>$user])
<section id="conteudo">
	<section class="conteudo-fix">
		<h3 class="error">Ops! Algo não saiu como esperado...</h3>
		{{link_to_route('posts', 'Voltar para a tela inicial', [], ['class'=>'link-error'])}}
	</section>	
</section>
@endsection