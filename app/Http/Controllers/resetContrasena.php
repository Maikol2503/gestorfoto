<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Mail;
use App\Mail\nuevaContrasenaMailable;



class resetContrasena extends Controller
{
    
    public function verificar(Request $request){
    if(User::where("email", $request->email)->exists()){//pregunto si el correo existe en la base de datos
        
        //hago una consulta con el email para q solo me de el id del correo introducido
        $data = User::select("id")->where("email", $request->email)->get();
        foreach ($data as $data) {
            $data = $data["id"];
        }
        
        $user = User::findOrFail($data);//le digo que actualice la fila con el id del correo introducido

        $request->validate([
            "password" => ["required",Password::min(6)->mixedCase()->numbers()]
        ]);
        $nuevoPassword = $request->password;
        $nuevoPassword = bcrypt($nuevoPassword);
        $user->update(["password" => $nuevoPassword]);//actualizo el password
    

        // $codigo = new nuevaContrasenaMailable;
        // Mail::to($request)->send($codigo);
         return redirect()->route("mensajePassword"); 

    } else{
         
        return redirect()->route("error");
    }

   
    }
}
