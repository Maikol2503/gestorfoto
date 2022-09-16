<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Gestor de fotos</title>
	<link rel="stylesheet" href="../css/layuot.css">
	<link rel="stylesheet" type="text/css" href="{{asset('bootstrap-5.1.3-dist/css/bootstrap.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/star-rating.css')}}">
	<style type="text/css">
        body{
			display: flex;
			justify-content: center;
			flex-direction: column;
		}
		
		form{
			border: solid darkgray 1px;
			border-radius: 20px;
			padding: 50px;
			margin: 30px;
		}

		.container{
			margin-bottom:100px; 
			max-width: 1200px;
			margin: 0 auto 100px auto;
			
		}

		
	</style>
</head>
<body class="body">
	
	<div class="container1">
	    <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
			<a class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
	      		@auth
	      			Las fotos de {{Auth::user()->name}}
					  @endauth
					</a>
					<div class="col-md-3 text-end buscador">
						@auth
				
		        	<a href="{{route('logout')}}"><button type="button" class="btn btn-outline-primary me-2">Salir</button></a>
	      		@else
		        	<a href="{{route('login')}}"><button type="button" class="btn btn-outline-primary me-2">Entrar</button></a>
		        	<a href="{{route('register')}}"><button type="button" class="btn btn-primary">Registrarse</button></a>
		    	@endauth
	        </div>
	    </header>
	</div>
	@auth
	<div class="buscadores">
		<form id="buscador" class="" action="{{route("pictureDate")}}" method="POST">
			@csrf
			@method("put")
			<div>
			<p>Buscar por rango de fecha</p>
			<div class="divBuscador">
				<p style="font-size:14px">De</p>
				<input class="fechas" name="fechaDe" type="date" required>
				<p style="font-size:14px">A</p>
				<input class="fechas" name="fechaA" type="date" required>
				<select name="select">
					<option value="masReciente">Ordenar por</option>
					<option value="masReciente">Mas Recientes primero</option>
					<option value="masAntiguas">Mas antiguas primero</option>
					<option value="rating">Rating</option>
					<option value="alfabaticoA-Z">alfabetico A-Z</option>
					<option value="alfabaticoZ-A">alfabetico Z-A</option>
				</select>
				<button class="btn btn-success">Filtrar</button>
			</div>
			</div>
		</form>
		<form id="buscador" action="{{route("buscador")}}" method="POST">
			@csrf
			@method("put")
			<div>
			<p>Buscar por el nombre</p>
			<div class="divBuscador">
				<select name="select">
					<option value="masReciente">Ordenar por</option>
					<option value="masReciente">Mas Recientes primero</option>
					<option value="masAntiguas">Mas antiguas primero</option>
					<option value="rating">Rating</option>
					<option value="alfabaticoA-Z">alfabetico A-Z</option>
					<option value="alfabaticoZ-A">alfabetico Z-A</option>
				</select>
				<input type="text" id="buscador1" name="buscador">
				<button class="btn btn-primary">Buscar</button>
			</div>
		    </div>
		</form>
	</div>
	@endauth
	<article class="container">
		@if($errors->any() && $errors->getBag('default')->has('exception'))
			<div class="alert alert-danger" role="alert">
				{{$errors->getBag('default')->first('exception')}}
		  	</div>
		@endif
		@yield("cards")
		@yield('content')
		{{-- {{$pictures->links()}} --}}
	</article>
	<script type="text/javascript" src="{{asset('bootstrap-5.1.3-dist/js/bootstrap.min.js')}}"></script>
	@yield('scripts')
</body>
</html>