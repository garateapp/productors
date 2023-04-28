<?php

use App\Http\Controllers\AjaxController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MensajeController;
use App\Http\Controllers\ProcesoController;
use App\Http\Controllers\Productor\UserController as ProductorUserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TelefonoController;
use App\Http\Controllers\UserController;
use App\Models\Recepcion;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('auth.login');});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    

Route::get('/dashboard',[HomeController::class,'dashboard'])->name('dashboard');
});

Route::get('/dashboard/especie/{especie}',[HomeController::class,'dashboard_especie'])->name('dashboard.especie');


Route::get('productores', [HomeController::class,'index'])->middleware('auth')->name('productors.index');

Route::get('recepcion', [HomeController::class,'production'])->middleware('auth')->name('production.index');

Route::get('recepciones', [HomeController::class,'productionpropia'])->middleware('auth')->name('productionpropia.index');

Route::get('recepciones/cc', [HomeController::class,'productionccindex'])->middleware('auth')->name('productioncc.index');

Route::get('recepcion/{recepcion}/cc', [HomeController::class,'productioncc'])->middleware('auth')->name('agregar.cc');

Route::get('recepcion/{recepcion}/ss', [HomeController::class,'productionss'])->middleware('auth')->name('agregar.ss');

Route::get('production/refresh', [HomeController::class,'production_refresh'])->middleware('auth')->name('production.refresh');

Route::get('productores/refresh', [HomeController::class,'productor_refresh'])->middleware('auth')->name('productor.refresh');

Route::get('download/recepcion/{recepcion}.pdf', [HomeController::class,'downloadpdf'])->name('informe.download');

Route::get('informe/{recepcion}', [HomeController::class,'viewpdf'])->name('informe.view');

Route::post('pass/{user}', [UserController::class,'password_rec'])->middleware('auth')->name('recuperar.contrasena');

Route::resource('telefono', TelefonoController::class)->names('telefonos');

Route::resource('role', RoleController::class)->names('admin.roles');

Route::resource('users', UserController::class)->only(['index','edit','update','destroy'])->names('users');

Route::resource('prod/users', ProductorUserController::class)->only(['update'])->names('productor.users');

Route::get('envio-masivo', [HomeController::class,'envio_masivo'])->middleware('auth')->name('envio.masivo');

Route::get('procesos', [HomeController::class,'procesos'])->middleware('auth')->name('procesos.index');

Route::get('procesos/productor', [ProcesoController::class,'index'])->middleware('auth')->name('procesos.productor.index');

Route::get('procesos/productor/{especie}', [ProcesoController::class,'productorespecie'])->middleware('auth')->name('procesos.productor.especie');

Route::get('procesos/{especie}', [ProcesoController::class,'especie'])->middleware('auth')->name('procesos.admin.especie');

Route::get('proceso/refresh', [HomeController::class,'sync_proces'])->middleware('auth')->name('proceso.refresh');

Route::get('subir-proceso', [HomeController::class,'subir_procesos'])->middleware('auth')->name('subir.procesos');

Route::post('archivo/procesos', [HomeController::class,'proceso_upload'])->name('proceso.upload');

Route::get('download/{proceso}.pdf', [HomeController::class,'download_proceso'])->name('download.proceso');

Route::delete('delete/proceso/{proceso}',[HomeController::class,'proceso_destroy'])->name('delete.proceso');

Route::resource('mensaje', MensajeController::class)->middleware('auth')->names('mensajes');

Route::post('procesos/all', [AjaxController::class,'all'])->name('procesos.all');

