@extends('post.parent')
@section('content')
@include('common-header', ['top'=>$top,'categorias'=>$categorias,'user'=>$user])
<section id="conteudo">
	@include('post.advertise-corner')
	<section id="conteudo-posts" class="conteudo-fix">
		@if(isset($search_label))
			<p class="text-block">{{$search_label}}</p>
		@endif
		@forelse($posts as $p)
			@include('post.item',['p'=>$p, 'user'=>$user])
		@empty
			@include('post.item-vazio', [])
		@endforelse
	</section>
	@include("post.advertise-post")
	<span class="clearfix"></span>
</section>

@if(isset($user) && ($user->moderator || $user->author))
	{!!Form::open(['route'=>'post.delete', 'method'=>'delete', 'id'=>'form-delete'])!!}
	{!!Form::hidden('id', null, ['id'=>'hidden-delete'])!!}
	{!!Form::close()!!}
	{!!Form::open(['route'=>'post.edit', 'id'=>'form-edit'])!!}
	{!!Form::hidden('id', null, ['id'=>'hidden-edit'])!!}
	{!!Form::close()!!}
	{!!Form::open(['route'=>'post.active', 'id'=>'form-active'])!!}
	{!!Form::hidden('post_id', null, ['id'=>'hidden-active-id'])!!}
	{!!Form::hidden('active', null, ['id'=>'hidden-active'])!!}
	{!!Form::close()!!}
@endif
<script type="text/javascript">
$(function(){
	var topContent = $("#topo").attr('data-content');
@if(isset($user) && ($user->moderator || $user->author))
	$('#conteudo-posts').on('click', '.btn-editar', function(){
		var id = $(this).attr('data-id');
		$("#hidden-edit").val(id);
		$("#form-edit").submit();
	});
	$('#conteudo-posts').on('click', '.btn-ativar', function(){
		var id = $(this).attr('data-id');
		var active = $(this).attr('data-active');
		$("#hidden-active-id").val(id);
		$("#hidden-active").val(active);
		$("#form-active").submit();
	});
	$('#conteudo-posts').on('click', '.btn-excluir', function(){
		var id = $(this).attr('data-id');
		$("#hidden-delete").val(id);
		if(confirm("Deseja realmente deletar o post?"))
			$("#form-delete").submit();
		return false;
	});
@endif
	$(document).scroll(function(){
		var scrollHeight = $(this).height() - $(window).height();
		var scrolledPixels = $(this).scrollTop();
		if (scrolledPixels+80 >= scrollHeight) {
			ajaxLoad();
		}
		if (topContent == "true") {
			var menu = $("#categorias");
			controlPixels = menu.position().top + menu.height();
		}else{
			controlPixels = 170;
		}

		if(scrolledPixels>=controlPixels) {
	    	$('#ad-woobe-wrapper').css({position:"fixed", top:10}); 
		}else{
			$('#ad-woobe-wrapper').css({position:"absolute", top:10}); 
		}
	});
});

var ajaxRunning = false,
	pageHolderControl = {{$pageHolder}};
@if(isset($categoriaId))
	pageCategoryControl = {{$categoriaId}}
@else
	pageCategoryControl = null;
@endif
function ajaxLoad(){
	if(!ajaxRunning){
		$.ajax({
			url: '{{route("ajax.load")}}',
			data: {'pageHolderControl': pageHolderControl,
				   'pageCategoryControl': pageCategoryControl},
			headers: {'X-CSRF-TOKEN': '{{csrf_token()}}'},
			method: 'post',
			beforeSend:function(){
				ajaxRunning = true;
			},
			success: function(data){
				if(data!="")
					addAdvertise();
				$("#conteudo-posts").append(data);
				pageHolderControl+={{$pageHolder}};
			},
			complete: function(){
				ajaxRunning = false;
			}
		});
	}
}

function addAdvertise(){
	var clone = $("#ad-woobe-post-wrapper").clone();
	$("#conteudo-posts").append(clone);
}

$.fn.isOnScreen = function(){

    var win = $(window);

    var viewport = {
        top : win.scrollTop(),
        left : win.scrollLeft()
    };
    viewport.right = viewport.left + win.width();
    viewport.bottom = viewport.top + win.height();

    var bounds = this.offset();
    bounds.right = bounds.left + this.outerWidth();
    bounds.bottom = bounds.top + this.outerHeight();

    return (!(viewport.right < bounds.left || viewport.left > bounds.right || viewport.bottom < bounds.top || viewport.top > bounds.bottom));

};
</script>
@endsection