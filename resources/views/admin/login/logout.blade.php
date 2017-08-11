@extends('admin.parent')
@section('title', 'Login')
@section('content')

<section class="container-full">
@include('admin.admin-header', ['facebook'=>true])
<section class="container">
	<section class="conteudo-form">
	{!!Form::open(['route'=>'logout','id'=>'form-logout'])!!}
		<h3>Deseja realmente realizar o logout?</h3>
		<p class="logout-link"><a href="javascript:doLogout();">Sim</a></p>
		<p class="logout-link-red"><a href="{{route('posts')}}">Não, voltar para o incio</a></p>
	{!!Form::close()!!}
	</section>
</section>
@endsection
