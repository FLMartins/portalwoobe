@extends('admin.parent')
@section('title', 'Login')
@section('content')

<section class="container-full">
@include('admin.admin-header', ['facebook'=>true])
<section class="container">
	<section class="conteudo-form">

	{!!Form::open(['route'=>'login.password.change'])!!}
	@if($errors->any())
		<ul class="error">
			<li>{{$errors->first()}}</li>
		</ul>
	@endif

	{!!Form::label('password_actual', 'Senha Atual:')!!}
	{!!Form::password('password_actual', null, null)!!}

	{!!Form::label('password_1', 'Senha nova:')!!}
	{!!Form::password('password_1', null, null)!!}

	{!!Form::label('password_2', 'Confirmação senha nova:')!!}
	{!!Form::password('password_2', null, null)!!}

	{!!Form::submit('Continuar')!!}
	</section>
	{!!Form::close()!!}
	</section>
</section>
@endsection
