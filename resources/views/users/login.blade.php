@extends('layout')
@section('content')
	{{-- <x-form tipoform='login'/> --}}
	<form method="POST" action="http://127.0.0.1:8000/do-login">
		@csrf
		  <h1>Iniciar sesión</h1>
		  <div class="mb-3">
		  <label for="inputName" class="form-label">Nombre de usuario</label>
		  <input type="text" maxlength="30" id="inputName" name="name" required aria-describedby="nameHelp" class="form-control"
			value="">
				</div>
		<div class="mb-3">
		  <label for="inputPassword" class="form-label">Password</label>
		  <input type="password" name="password" id="inputPassword" required aria-describedby="passwordHelp" class="form-control">
				</div>
			<div class="mb-3 form-check">
			<input type="checkbox" class="form-check-input" id="checkRemember">
			<label class="form-check-label" for="checkRemember" name="remember">Mantener la sesión iniciada</label>
		  </div>
		  <button type="submit" class="btn btn-primary">Enviar</button>
		  <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{route('verificarEmail')}}">
			recuperar contraseña
		</a>
	  </form>	
@endsection