@if(isset($facebook) && $facebook)
	@section('facebook-api')
	<script>
	window.fbAsyncInit = function() {
	FB.init({
			appId      : '1127685080630443',
			xfbml      : true,
			version    : 'v2.7'
		});
	};
	(function(d, s, id){
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) {return;}
		js = d.createElement(s); js.id = id;
		js.src = "//connect.facebook.net/pt_BR/sdk.js";
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));

	function checkLoginState() {
		FB.getLoginStatus(function(response) {
			statusChangeCallback(response);
		});
	}

	// This is called with the results from from FB.getLoginStatus().
	function statusChangeCallback(response) {
		// The response object is returned with a status field that lets the
		// app know the current login status of the person.
		// Full docs on the response object can be found in the documentation
		// for FB.getLoginStatus().
		if (response.status === 'connected') {
			// Logged into your app and Facebook.
			doFacebookLogin();
		} else if (response.status === 'not_authorized') {
			// The person is logged into Facebook, but not your app.
			document.getElementById('status').innerHTML = 'Please log ' +
			'into this app.';
		} else {
			// The person is not logged into Facebook, so we're not sure if
			// they are logged into this app or not.
			document.getElementById('status').innerHTML = 'Please log ' +
			'into Facebook.';
		}
	}
	function doFacebookLogin() {
		FB.api('/me?fields=id,name,email', function(response) {
			document.getElementById('id-facebook').value = response.id;
			document.getElementById('email-facebook').value = response.email;
			document.getElementById('name-facebook').value = response.name;
			document.getElementById('form-facebook').submit();
		});
	}
	function doLogout(){
		FB.getLoginStatus(function(response) {
	        if (response && response.status === 'connected') {
	            FB.logout(function(response) {
	                document.getElementById('form-logout').submit();
	            });
	        }else{
        	    document.getElementById('form-logout').submit();
	        }
	    });
	}
	</script>
	<div id="fb-root"></div>
	{!!Form::open(['route'=>'login.facebook', 'id'=>'form-facebook'])!!}
		{!!Form::hidden('id-facebook', null, ['id'=>'id-facebook'])!!}
		{!!Form::hidden('email-facebook', null, ['id'=>'email-facebook'])!!}
		{!!Form::hidden('name-facebook', null, ['id'=>'name-facebook'])!!}
	{!!Form::close()!!}
	@endsection
@endif
<header id="topo">
	<section class="overlay"></section>
	<section class="topo-content">
		<section class="topo-menu">
			<a class="logo" href="{{route('posts')}}" alt="Woobe"><img src="/img/logo.fw.png"></a>
			<nav class="menu">
				<ul class="umenu" id="menu">
					<li class="icon"><a href="javascript:void(0);" onclick="menu()">&#9776;</a></li>
					<li>{{ link_to_route('posts', 'Home') }}</li>
					@if(isset($user))
						@if($user->admin)
							<li>{{ link_to_route('admin', 'Usuários') }}</li>
						@endif
						@if($user->moderator || $user->author)
							<li>{{ link_to_route('post.add', 'Novo Post') }}</li>
							<li>{{ link_to_route('categoria', 'Categorias') }}</li>
							<li>{{ link_to_route('galeria', 'Galeria') }}</li>
						@endif
						<li>{{ link_to_route('login.password', 'Alterar senha') }}</li>
						<li>{{ link_to_route('logout', 'Logout') }}</li>
					@else
						<li>{{ link_to_route('login', 'Login') }}</li>
					@endif
				</ul>
			</nav>
		</section>
	</section>
</header>