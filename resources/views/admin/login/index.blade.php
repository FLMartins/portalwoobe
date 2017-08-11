@extends('admin.parent')
@section('title', 'Login')
@section('content')

<section class="container-full">
@include('admin.admin-header', ['facebook'=>true])
<section class="container">
	<section class="conteudo-form">
	{!!Form::open(['route'=>'login.authenticate'])!!}
	@if($errors->any())
		<ul class="error">
			<li>{{$errors->first()}}</li>
		</ul>
	@endif

	{!!Form::label('email', 'Email:')!!}
	{!!Form::text('email', null, null)!!}

	{!!Form::label('password', 'Senha:')!!}
	{!!Form::password('password', null, null)!!}

	<section class="action-form">
	{{--
		<fb:login-button scope="public_profile,email" data-size="xlarge" onlogin="checkLoginState();"></fb:login-button>
	--}}
		{!!Form::submit('Login')!!}
	</section>
	{!!Form::close()!!}
	</section>
</section>
@endsection
