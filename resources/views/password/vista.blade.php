<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="{{asset('css/mensaje.css')}}">
    <title>Document</title>
</head>
<body>
    <a href="login"><button class="volver">Volver</button></a>
    @if($errors->any())
    <p style="color:white;">La contraseña debe tener minimo 6 caracteres, 1 letra mayuscula y almenos 1 numero</p>
    @endif
    <form action="/verificarCorreo" method="POST">
      @csrf
      @method("put")
      <div class="login-box">
      <h2>UPDATE</h2>
      <form>
        <div class="user-box">
          <input type="text" name="email" required="">
          <label>Email</label>
        </div>
        <div class="user-box">
          <input type="password" name="password" required="">
          <label>Password</label>
        </div>
        <button class="custom-btn btn-15">Guardar</button>
      </form>
    
    
  </div>
</body>
</html>