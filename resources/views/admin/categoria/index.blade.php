@extends('admin.parent')
@section('title', 'Categorias')
@section('content')

<section class="container-full">
@include('admin.admin-header')
<section class="container">
	<section class="conteudo-form">
	@if($errors->any())
	<ul class="error">
		@foreach($errors->all() as $error)	
			<li>{{ $error }}</li>
		@endforeach
	</ul>
	@endif
	@if(Session::has('success'))
	<ul class="success">
		<li>{!! Session::get('success') !!}</li>
	</ul>
	@endif

	{!! Form::open(['route'=>'categoria.save','id'=>'form-submit', 'class'=>'conteudo-form-inline']) !!}
	{!! Form::label('name', 'Categoria:') !!}
	{!! Form::text('name', null, null) !!}
	{!! Form::submit('Cadastrar') !!}
	{!! Form::close() !!}

	@each('admin.categoria.item-categoria', $categorias, 'c', 'admin.categoria.item-categoria-vazio')

	</section>
</section>

{!!Form::open(['route'=>'categoria.delete', 'method'=>'delete', 'id'=>'form-delete'])!!}
{!!Form::hidden('id', null, ['id'=>'nameHidden'])!!}
{!!Form::close()!!}

<script type="text/javascript">
$(function(){
	$('.btn-excluir').click(function(){
		var id = $(this).attr('data-id');
		$("#nameHidden").val(id);
		if(confirm("Deseja realmente deletar a categoria?"))
			$("#form-delete").submit();
	});
	$('.btn-editar').click(function(){
		var categoria = $(this).parent().parent();
		var texto = $(categoria).find('.categoria-text');
		var nome = $(texto).html();
		var campo = $(categoria).find('.categoria-edit');
		if($(texto).css('display')=='block'){
			$(texto).hide();
			$(campo).find('input[type=text]').val(nome);
			$(campo).show();
		}else{
			$(texto).show();
			$(campo).find('input[type=text]').val(nome);
			$(campo).hide();
		}
	});
});
</script>
@endsection
