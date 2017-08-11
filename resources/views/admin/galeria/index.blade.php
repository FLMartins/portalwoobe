@extends('admin.parent')
@section('title', 'Galeria')
@section('content')

<section class="container-full">
@include('admin.admin-header')
<section class="container">
	<section class="conteudo-form-upload">
	
	@if($errors->any())
		<ul class="error">
			<li>{{$errors->first()}}</li>
		</ul>
	@endif

	@if(Session::has('error'))
	<ul class="error">
		<li>{!! Session::get('error') !!}</li>
	</ul>
	@endif
	@if(Session::has('success'))
	<ul class="success">
		<li>{!! Session::get('success') !!}</li>
	</ul>
	@endif

	{!! Form::open(['route'=>'galeria.upload', 'files'=>true]) !!}
		{!! Form::file('image') !!}
		{!! Form::submit('Enviar') !!}
	{!! Form::close() !!}

	{!! Form::open(['route'=>'galeria.delete', 'id'=>'form-delete']) !!}
		{!! Form::hidden('image', null, ['id'=>'imageHidden']) !!}
	{!! Form::close() !!}
	</section>
	<textarea id="copyboard"></textarea>
	<section class="conteudo-imagem">
		@each('admin.galeria.item-imagem', $files, 'f', 'admin.galeria.item-imagem-vazio')
		<span class="clearfix"></span>
	</section>
</section>
<section id="toast-status" class="hidden"><p id="toast-status-text">copiado na area de transferência</p></section>
<script type="text/javascript">
var interval;
function copiar(texto){
	var textarea = document.getElementById('copyboard');
	textarea.value = texto;
	textarea.select();
    if(document.execCommand("Copy")){
	    $("#toast-status-text").html("'" + texto + "' copiado para area de transferência");
	    $("#toast-status").fadeIn();
	    interval = setInterval(limpaCampo, 4000);
	}
}
function limpaCampo(){
	$("#toast-status").fadeOut();
	clearInterval(interval);
}
$(function(){
	$(".btn-excluir").click(function(){
		var image = $(this).attr("data-image");
		$("#imageHidden").val(image);
		if(confirm('Deseja realmente excluir a imagem?'))
			$("#form-delete").submit();
		return false;
	});
});
</script>
@endsection
