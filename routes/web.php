<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PictureController;
use App\Http\Controllers\resetContrasena;
use App\Mail\nuevaContrasenaMailable;
use Illuminate\Support\Facades\Mail;
use App\Models\user;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::view('/login','users.login')->name('login');
Route::view('/register','users.register')->name('register');
Route::get('/logout',[UserController::class,'logout'])->name('logout');
Route::post('/do-login',[UserController::class,'login'])->name('do-login');
Route::post('/do-register',[UserController::class,'register'])->name('do-register');

Route::middleware('auth')->get('/',[PictureController::class,'home'])->name('home');
Route::put('/pictures',[PictureController::class,'buscador'])->name('buscador');
Route::put('/pictures-Date',[PictureController::class,'rangoFecha'])->name('pictureDate');
Route::middleware('auth')->post('/save-picture',[PictureController::class,'saveAjax'])->name('save-picture');
Route::middleware('auth')->get('/picture/{picture}',[PictureController::class,'getPicture'])->name('get-picture');
Route::middleware('auth')->delete('/remove-picture',[PictureController::class,'removePicture'])->name('remove-picture');


Route::get('/editar-Contrasena',[UserController::class,'editPassword'])->name('editarContrasena');
Route::put('/update',[UserController::class,'update'])->name('update');
Route::put('/aleatorio',[UserController::class,'aleatorio'])->name('aleatorio');
Route::view('/password-enviado','password.mensaje')->name('mensajePassword');
Route::view('/error','password.error')->name('error');
Route::get('/verificar-Email', function(){
    return view('password.vista');
})->name("verificarEmail");
Route::put('/verificarCorreo', [resetContrasena::class, 'verificar'])->name("verificarCorreo");
Route::get('/passwordNuevoCodigo/{c}', [codigoController::class, 'codigo'])->name("passwordNuevoCodigo");


//buscador
// Route::get('/buscador', 'Models.user')->name("buscador");