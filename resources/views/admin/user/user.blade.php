@extends('admin.parent')
@section('title', 'Usuários')
@section('content')

<section class="container-full">
@include('admin.admin-header')
<section class="container">


	@if($u->id!=null)
		{!! Form::open(['route'=>['admin.update', $u->id], 'id'=>'form-submit', 'class'=>'conteudo-form']) !!}
	@else
		{!! Form::open(['route'=>'admin.save','id'=>'form-submit', 'class'=>'conteudo-form']) !!}
	@endif
	@if($errors->any())
		<ul class="error">
		@foreach($errors->all() as $error)	
			<li>{{ $error }}</li>
		@endforeach
		</ul>
	@endif
	{!!Form::label('name', 'Nome:')!!}
	{!!Form::text('name', $u->name, null)!!}
	<br/>
	{!!Form::label('email', 'Email:')!!}
	{!!Form::text('email', $u->email, null)!!}
	<br/>
	{!!Form::label('admin', 'Admin:')!!}
	@if($u->admin)
	{!!Form::checkbox('admin', true, true)!!}
	@else
	{!!Form::checkbox('admin', true)!!}
	@endif
	<br/>
	{!!Form::label('moderator', 'Moderador:')!!}
	@if($u->moderator)
	{!!Form::checkbox('moderator', true, true)!!}
	@else
	{!!Form::checkbox('moderator', true)!!}
	@endif
	<br/>
	{!!Form::label('author', 'Autor:')!!}
	@if($u->author)
	{!!Form::checkbox('author', true, true)!!}
	@else
	{!!Form::checkbox('author', true)!!}
	@endif
	<br/>
	{!!Form::submit('Salvar')!!}

	{!!Form::close()!!}
</section>
@endsection