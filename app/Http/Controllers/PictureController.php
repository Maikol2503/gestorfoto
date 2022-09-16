<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Models\Picture;

class PictureController extends Controller
{

    public function home(){
        // $orden = trim($request->get("select"));
            return view('pictures.list',["pictures" => Auth::user()->pictures()->orderBy('created_at', 'desc')->paginate(9)]);
    }

    public function buscador(Request $request){
        $texto = trim($request->get("buscador"));
        $orden = trim($request->get("select"));

        //buscador
        if($orden == "rating"){
            return view('pictures.list',["pictures" => Auth::user()->pictures()->where( "picture_name", "LIKE" , $texto."%")->orderBy('rating', 'desc')->get()]);
        } if($orden == "masAntiguas"){
            return view('pictures.list',["pictures" => Auth::user()->pictures()->where( "picture_name", "LIKE" , $texto."%")->orderBy('created_at', 'asc')->get()]);
        } if($orden == "alfabaticoA-Z"){
            return view('pictures.list',["pictures" => Auth::user()->pictures()->where( "picture_name", "LIKE" , $texto."%")->orderBy('picture_name', 'ASC')->get()]);
        } if($orden == "alfabaticoZ-A"){
            return view('pictures.list',["pictures" => Auth::user()->pictures()->where( "picture_name", "LIKE" , $texto."%")->orderBy('picture_name', 'DESC')->get()]);
        } else{
            return view('pictures.list',["pictures" => Auth::user()->pictures()->where( "picture_name", "LIKE" , $texto."%")->orderBy('created_at', 'desc')->get()]);
        }
    }

    public function RangoFecha(Request $request){
        $orden = trim($request->get("select"));
        $fecha_de = trim($request->get("fechaDe"));
        $fecha_a = trim($request->get("fechaA"));
        if ($orden == "rating"){
            return view('pictures.list',["pictures" => Auth::user()->pictures()->whereBetween("created_at" , [$fecha_de , $fecha_a])->orderBy('rating', 'desc')->get()]);
        } if($orden == "masAntiguas"){
            return view('pictures.list',["pictures" => Auth::user()->pictures()->whereBetween("created_at" , [$fecha_de , $fecha_a])->orderBy('created_at', 'asc')->get()]);
        } if($orden == "alfabaticoA-Z"){
            return view('pictures.list',["pictures" => Auth::user()->pictures()->whereBetween("created_at" , [$fecha_de , $fecha_a])->orderBy('picture_name', 'ASC')->get()]);
        } if($orden == "alfabaticoZ-A"){
            return view('pictures.list',["pictures" => Auth::user()->pictures()->whereBetween("created_at" , [$fecha_de , $fecha_a])->orderBy('picture_name', 'DESC')->get()]);
        } else{
            return view('pictures.list',["pictures" => Auth::user()->pictures()->whereBetween("created_at" , [$fecha_de , $fecha_a])->orderBy('created_at', 'desc')->get()]);
        }
    }

    public function saveAjax(Request $req){
        $response = ["status"=>0,"msg"=>""];

        $validatorRules = [
            "title" => ['required','max:80'],
            "rating" => ['numeric','max:5']
        ];
        //Si es edición, se valida que exista la foto
        if($req->has('id')){
            $validatorRules['id'] = ['exists:pictures,id'];
        }
        //Si no, que venga una foto
        else{
            $validatorRules['image'] = ['required','image','max:3072'];
        }


        $validator = Validator::make($req->all(),$validatorRules);

        //Si falla algo de la validación da error
        if($validator->fails()){

            $response["status"] = 40;
            $errors = [];
            foreach($validator->errors()->getMessages() as $error){
                foreach($error as $message)
                    $errors[] = $message;
            }

            $response["msg"] = $errors;

        }

        //Si la validación pasa
        else{
            try{
                //Si era nueva
                if(!$req->has('id')){
                    
                    //Almacenar la foto
                    $path = $req->file('image')->store(Auth::id());
                    $picture = new Picture();
                    $picture->picture_name = $req->title;
                    $picture->created_at = $req->fecha;
                    $picture->picture_url = explode("/",$path)[1];
                    $picture->rating = $req->rating;
                    $picture->user_id = Auth::id();
                    //Guardar la imagen
                    $picture->save();
                }else{
                    //Buscar la foto
                    $picture = Picture::find($req->id);
                    //Actualizarla
                    $picture->picture_name = $req->title;
                    $picture->rating = $req->rating;
                    $picture->save();
                }
                $response["status"] = 20;
                $response["msg"] = $picture->id;  
            }catch(\Exception $e){
                $response["status"] = 50;
                $response["msg"] = [$e->getMessage()]; 
            }
        }


        return response()->json($response);
    }
   
    public function getPicture($picture){
        //Comprobar que coincide el id del usuario
        //Buscar la foto
        if(Storage::exists(Auth::id()."/".$picture)){
            //Recuperarla
            $tipo = Storage::mimeType(Auth::id()."/".$picture);
            $foto = Storage::get(Auth::id()."/".$picture);
            return response($foto)->header('Content-Type', $tipo);
        }else{
            return response(404);
        }
    }
    public function removePicture(Request $req){

        //Obtener el id
        $id = $req->getContent();
        //Buscar la imagen
        $image = Picture::find($id);
        //Si la hay
        if($image){
            //Borrar el archivo
            Storage::delete(Auth::id().'/'.$image->picture_url);
            //Borrarla de base de datos
            $image->delete();
        }

        return response('Deleted');
    }

}
