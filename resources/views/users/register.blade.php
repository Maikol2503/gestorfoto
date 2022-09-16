@extends('layout')
@section('content')
	{{-- <x-form tipoform='registro'/> --}}
	<form method="POST" action="http://127.0.0.1:8000/do-register">
		@csrf 
		    <h1>Registrarse</h1>
			<div class="mb-3">
			<label for="inputEmail" class="form-label">Email</label>
			<input type="email" name="email" required  id="inputEmail" class="form-control"
			  value=""
			>
				</div>
		  <div class="mb-3">
		  <label for="inputName" class="form-label">Nombre de usuario</label>
		  <input type="text" maxlength="30" id="inputName" name="name" required aria-describedby="nameHelp" class="form-control"
			value=""
		  >
				<div id="nameHelp" class="form-text">Tu nombre para acceder a la aplicación. Debe ser único.</div>
				</div>
		<div class="mb-3">
		  <label for="inputPassword" class="form-label">Password</label>
		  <input type="password" name="password" id="inputPassword" required aria-describedby="passwordHelp" class="form-control">
				<div id="passwordHelp" class="form-text">Debe tener al menos 6 caracteres con letras mayúsculas, minúsculas y números.</div>
				</div>
		  <button type="submit" class="btn btn-primary">Enviar</button>
	  </form>
@endsection