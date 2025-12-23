<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EnigmaController;
use App\Http\Controllers\BOEcontroller;
use App\Http\Controllers\MinecraftController;
use App\Http\Controllers\MW3Controller;
use App\Http\Controllers\ControllerAlertas;
use App\Http\Controllers\StoriesController;
use App\Http\Controllers\GaleriaController;
use App\Http\Controllers\TerminalController;
use App\Http\Controllers\ProtocoloController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\PagosController;
use App\Http\Controllers\SpotifyController;
use App\Http\Controllers\Biblioteca;
use App\Http\Controllers\WebrtcStreamingController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\MinijuegoController;
use App\Http\Controllers\StoryController;


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

Auth::routes();

Route::get('/', [HomeController::class, 'show'])->name('home');

Route::get('/proyectos', [ProyectoController::class, 'show'])->name('proyectos');
Route::get("/eliminar-proyecto", [HomeControllerProyectoController::class, 'show']);
Route::post("/eliminar-proyecto", [HomeControllerProyectoController::class, 'destroy'])->name('eliminar-proyecto');

Route::get('/formacion', [UserController::class, 'show'])->name('formacion');
Route::get('/enigma', [EnigmaController::class, 'index'])->name('enigma');
Route::get('/manager', [EnigmaController::class, 'manager'])->name('manager');
Route::post("/manager-generate", [EnigmaController::class, 'manager_create'])->name('manager-generate');
Route::get('/manager-generate', [EnigmaController::class, 'manager'])->name('manager');
Route::post("/codificar", [EnigmaController::class, 'code'])->name('codificar');
Route::post("/decodificar", [EnigmaController::class, 'decode'])->name('decodificar');


Route::get('/boe', [BOEcontroller::class, 'index'])->name('boe');
Route::get("/crear-boe", [BOEcontroller::class, 'create'])->middleware('auth')->middleware('admin');
Route::post("/crear-boe", [BOEcontroller::class, 'store'])->name('crear-boe');
Route::get("/editar-boe/{id}", [BOEcontroller::class, 'edit'])->middleware('auth')->middleware('admin');
Route::post("/editar-boe", [BOEcontroller::class, 'update'])->name('editar-boe');
Route::get("/eliminar-boe", [BOEcontroller::class, 'index']);
Route::post("/eliminar-boe", [BOEcontroller::class, 'destroy'])->name('eliminar-boe');

Route::get('/minecraft', [MinecraftController::class, 'index'])->name('minecraft');
// Route::get('/add-minecraft', 'MinecraftController@create');
// Route::post("/add-minecraft", "MinecraftController@store")->name('add-minecraft');

Route::get('/mw3', [MW3Controller::class, 'index'])->name('mw3');
Route::get('/crear-mw3', [MW3Controller::class, 'create']);
Route::post("/crear-mw3", [MW3Controller::class, 'store'])->name('crear-mw3');

Route::get('/calendario', [UserController::class, 'calendar'])->name('calendar');
Route::get("/crear-evento", [UserController::class, 'addEvent'])->middleware('auth')->middleware('admin');
Route::post("/crear-evento", [UserController::class, 'createEvent'])->name('crear-evento');
Route::post("/eliminar-evento", [UserController::class, 'deleteEvent'])->name('eliminar-evento');


Route::get('/alerta', [ControllerAlertas::class, 'index'])->middleware('auth')->middleware('admin')->name('alerta');
Route::post("/activacion-alerta", [ControllerAlertas::class, 'edit'])->name('activacion-alerta');
Route::post("/crear-alerta", [ControllerAlertas::class, 'store'])->name('crear-alerta');

Route::get('/netflix', [StoriesController::class, 'index'])->middleware('auth')->middleware('admin');
Route::get('/certificado-covid', [UserController::class, 'certificado'])->middleware('auth')->middleware('admin');

Route::get("/galeria-privada", [GaleriaController::class, 'index'])->middleware('auth')->middleware('admin');
Route::get("/galeria-privada/{id}", [GaleriaController::class, 'index'])->middleware('auth')->middleware('admin');
Route::post("/eliminar-privada", [GaleriaController::class, 'destroy'])->name('eliminar-privada');

Route::get('/trollers-gpt', [TerminalController::class, 'index'])->name('trollers-gpt');
// Route::get('/api/key', function () {
//   $keys = explode(',', env('XAI_API_KEYS1'));
//   $weightedKeys = array_merge([$keys[0]], array_slice($keys, 1), array_slice($keys, 1));
//   $randomKey = $weightedKeys[array_rand($weightedKeys)];
//   return response()->json(['key' => $randomKey]);
// });

Route::get('/protocolos', [ProtocoloController::class, 'index'])->name('protocolos')->middleware('auth');
Route::get("/crear-protocolo", [ProtocoloController::class, 'create'])->middleware('auth')->middleware('admin');
Route::post("/crear-protocolo", [ProtocoloController::class, 'store'])->name('crear-protocolo');
Route::get("/editar-protocolo/{id}", [ProtocoloController::class, 'edit'])->middleware('auth')->middleware('admin');
Route::post("/editar-protocolo", [ProtocoloController::class, 'update'])->name('editar-protocolo');
Route::get("/eliminar-protocolo", [ProtocoloController::class, 'index']);
Route::post("/eliminar-protocolo", [ProtocoloController::class, 'destroy'])->name('eliminar-protocolo');

Route::get('/cuenta', [UserController::class, 'index'])->middleware('auth');
Route::get('/notificaciones', [NotificationsController::class, 'index'])->middleware('auth')->name("notificaciones");
Route::get('/ver-notificacion-{id}', [NotificationsController::class, 'show'])->middleware('auth');
Route::get('/nueva-notificacion', [NotificationsController::class, 'create'])->middleware('auth');
Route::post('/nueva-notificacion', [NotificationsController::class, 'save'])->middleware('auth')->name("nueva-notificacion");
Route::get('/responder-notificacion-{id}', [NotificationsController::class, 'responder'])->middleware('auth');
Route::post('/responder-notificacion', [NotificationsController::class, 'save'])->middleware('auth')->name("responder-notificacion");

Route::get('/descripcion', [UserController::class, 'edit'])->middleware('auth');
Route::post("/descripcion", [UserController::class, 'update'])->name('descripcion');

Route::get('/password', [UserController::class, 'passEdit'])->middleware('auth');
Route::post("/password", [UserController::class, 'passUpdate'])->name('password');

Route::get('/proyecto', [ProyectoController::class, 'create'])->middleware('auth')->middleware('admin');
Route::post("/proyecto", [ProyectoController::class, 'store'])->name('proyecto');

Route::get('/imagen', [ImagenController::class, 'create'])->middleware('auth')->middleware('admin');
Route::post("/imagen", [ImagenController::class, 'store'])->name('imagen');

Route::get('/editar', [ImagenController::class, 'edit'])->middleware('auth');
Route::post("/editar", [ImagenController::class, 'update'])->name('editar');

Route::get('/eliminar', [HomeController::class, 'destroy'])->middleware('auth')->middleware('admin');
Route::post("/eliminar", [ImagenController::class, 'destroy'])->name('eliminar');

Route::get('/pagos', [PagosController::class, 'index'])->middleware('auth')->name('pagos');
Route::post("/proceso", [PagosController::class, 'update'])->name('pagar');
Route::get('/proceso', [HomeController::class, 'show']);
Route::post("/renovar", [PagosController::class, 'renovar'])->name('renovar');
Route::get('/renovar', [HomeController::class, 'show']);

Route::get('/spotify', [SpotifyController::class, 'index']);
Route::get('/spotify-biblioteca', [Biblioteca::class, 'index']);
Route::get('/timeline', [HomeController::class, 'timeline']);

Route::get('/hits-trollers', [SpotifyController::class, 'getHitsTrollers']);

Route::get('/minijuego', [MinijuegoController::class, 'index']);

// Stories routes
Route::get('/stories/create', [StoryController::class, 'create'])->name('stories.create');
Route::post('/stories', [StoryController::class, 'store'])->name('stories.store');
Route::get('/stories/{id}', [StoryController::class, 'show'])->name('stories.show');
Route::delete('/stories/{id}', [StoryController::class, 'destroy'])->name('stories.destroy');
Route::delete('/stories-delete-all', [StoryController::class, 'deleteAll'])->middleware('auth')->middleware('admin')->name('stories.deleteAll');
Route::post('/stories/{id}/view', [StoryController::class, 'markAsViewed'])->name('stories.markAsViewed');
Route::get('/stories/{id}/comments', [StoryController::class, 'getComments'])->name('stories.getComments');
Route::post('/stories/{id}/comments', [StoryController::class, 'addComment'])->name('stories.addComment');

Route::get('/test', [TestController::class, 'index']);
Route::get('/congreso-warera', [TestController::class, 'congreso'])->name('congreso');

Route::get('/callback', [SpotifyController::class, 'create']);
Route::get('/callback_2', [Biblioteca::class, 'create']);

Route::get('lang/{lang}', function ($lang) {
  Session::put('lang', $lang);
  return Redirect::back();
})->middleware('web')->name('change_lang');
