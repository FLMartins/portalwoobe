@extends('admin.parent')
@section('title', 'Post')
@section('content')

<section class="container-full">
@include('admin.admin-header')
	<section class="container">
		@if($errors->any())
			<ul class="error">
			@foreach($errors->all() as $error)	
				<li>{{ $error }}</li>
			@endforeach
			</ul>
		@endif
		@if(isset($erros))
			<ul class="error">
			@foreach($erros as $error)	
				<li>{{ $error }}</li>
			@endforeach
			</ul>
		@endif

		@if($post->id!=null)
			{!! Form::open(['route'=>['post.update',$post->id], 'id'=>'form-submit']) !!}
		@else
			{!! Form::open(['route'=>'post.save', 'id'=>'form-submit']) !!}
			{!! Form::hidden('user_id', $user->id, null) !!}
		@endif

		{!! Form::label('title', 'Título:') !!}
		{!! Form::text('title', $post->title, null) !!}

		{!! Form::label('descricao', 'Descrição:') !!}
		{!! Form::text('descricao', $post->descricao, null) !!}

		{!! Form::label('url_imagem', 'URL da imagem:') !!}
		{!! Form::text('url_imagem', $post->url_imagem, null) !!}
		<a href="javascript:void(0);" id="btn-upload-container" class="info">esqueceu de fazer o upload?</a>

		<div id="upload-container">
			<ul id="upload-error" class="error hidden"></ul>
			{!! Form::file('image', ["id"=>"input-upload"]) !!}
			<button id="button-upload" class="btn">Enviar</button>
		</div>

		{!! Form::label('categoria_id', 'Categoria:') !!}
		{!! Form::select('categoria_id', $categorias, $post->categoria_id, ['placeholder' => '-']) !!}
		<a href="{{route('categoria')}}" class="info">algum problema com as categorias?</a>

		{!!Form::label('destaque', 'É destaque?')!!}
		@if($post->destaque)
		{!!Form::checkbox('destaque', true, true)!!}
		@else
		{!!Form::checkbox('destaque', true)!!}
		@endif

		{!!Form::label('active', 'Ativo?')!!}
		@if($post->active)
		{!!Form::checkbox('active', true, true)!!}
		@else
		{!!Form::checkbox('active', true)!!}
		@endif

		{!! Form::textarea('text', $post->text, null) !!}

		{!! Form::submit('Salvar', ["id"=>"form-submit-button"]) !!}
		{!! Form::close() !!}
	</section>
</section>
<section id="toast-status" class="hidden"><p id="toast-status-text">Aguarde o upload da imagem<span id="toast-status-dots"></span></p></section>
<script>
var interval;
$(document).ready(function() {
	$('textarea').trumbowyg({
		lang: 'pt',
	});
	$("#btn-upload-container").click(function(){
		$("#upload-container").slideDown();
	});
	$("#button-upload").click(function(){
		$("#toast-status-dots").html("");
	    $("#toast-status").fadeIn();
	    $("#form-submit-button").attr("disabled","disabled");
	    interval = setInterval(incrementaDots, 1000);
	    doUpload();
		return false;
	});
	$("#form-submit-button").click(function(){
		window.onbeforeunload = null;
	});
	window.onbeforeunload = function() { return "You work will be lost."; };
});
function incrementaDots(){
	var text = $("#toast-status-dots").html();
	if(text.length == 4)
		text="";
	text+=".";
	$("#toast-status-dots").html(text);
}
function dismissToast(){
	clearInterval(interval);
	$("#form-submit-button").removeAttr("disabled");
	$("#toast-status").fadeOut();
}
function doUpload(){
	var formData = new FormData();
	formData.append('image', $("#input-upload").prop('files')[0]);
	$.ajax({
		url:' {{route("galeria.ajax.upload")}}',
		data: formData,
		type: 'post',
		headers: {'X-CSRF-TOKEN': '{{csrf_token()}}'},
		processData: false,
		contentType: false,
		success: function(data){
			console.log(data);
			if(data.error){
				$("#upload-error").html("<li>"+data.error+"</li>");
				$("#upload-error").show();
			}else if(data.success){
				$("#upload-container").slideUp();
				$("#upload-error").hide();
				$("#url_imagem").val(data.url);
			}
		},
		error: function(jqXHR, textStatus, errorThrown){
			console.log(textStatus+": "+errorThrown);
		},
		complete: function(){
			dismissToast();
		}
	});
}
</script>
@endsection	