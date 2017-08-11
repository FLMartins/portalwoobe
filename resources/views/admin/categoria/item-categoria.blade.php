<section class="categoria">
	<p class="categoria-text">{{$c->name}}</p>
	<section class="categoria-edit">
		{!! Form::open(['route'=>['categoria.update', $c->id],'id'=>'form-submit', 'class'=>'conteudo-form-inline']) !!}
		{!! Form::text('name', $c->name, null) !!}
		{!! Form::submit('Salvar') !!}
		{!! Form::close() !!}
	</section>
	<p class="categoria-link"><a href="javascript:void(0);" class="btn-editar">Editar</a></p>
	<p class="categoria-link-red"><a href="javascript:void(0);" data-id="{{$c->id}}" class="btn-excluir">Excluir</a></p>
</section>