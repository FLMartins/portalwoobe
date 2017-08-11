@extends('admin.parent')
@section('title', 'Usuários')
@section('content')

<section class="container-full">
@include('admin.admin-header')
	<section class="container">
		<section class="conteudo-form">
			@if($errors->any())
				<ul class="error">
					@foreach($errors->all() as $e)
						<li>{{$e}}</li>
					@endforeach
				</ul>
			@endif
			@if(Session::has('success'))
			<ul class="success">
				<li>{!! Session::get('success') !!}</li>
			</ul>
			@endif
			{{ link_to_route('admin.user', 'Novo Usuário', [], ['class'=>'btn margin-baixo-20']) }}
			@each('admin.user.item-user', $users, 'u', 'admin.user.item-user-vazio')
			{!!Form::open(['route'=>'admin.delete', 'method'=>'delete', 'id'=>'form-delete'])!!}
			{!!Form::hidden('id', null, ['id'=>'hidden-delete'])!!}
			{!!Form::close()!!}
			{!!Form::open(['route'=>'admin.reset', 'id'=>'form-reset'])!!}
			{!!Form::hidden('id', null, ['id'=>'hidden-reset'])!!}
			{!!Form::close()!!}
		</section>
	</section>
	<script type="text/javascript">
		function excluir(id){
			$("#hidden-delete").val(id);
			if(confirm("Deseja realmente deletar o usuário?"))
				$("#form-delete").submit();
			return false;
		}
		function resetar(id){
			$("#hidden-reset").val(id);
			if(confirm("Deseja realmente resetar a senha do usuário?"))
				$("#form-reset").submit();
			return false;
		}
	</script>
</section>
@endsection