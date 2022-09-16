<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @if($errors->any())
    <p>La contraseña debe tener minimo 6 caracteres, 1 letra mayuscula y almenos 1 numero</p>
    @endif
<form action="{{route('update',Auth::user()->id)}}" method="POST">
    @csrf
    @method('put')
    <input type="text" placeholder="Escriba Su Nueva Contraseña" name="password">
    <button>Guardar</button>
</form>
</body>
</html>