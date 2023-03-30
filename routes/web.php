<?php

use App\Http\Controllers\HomeController;
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

Route::get('productores', [HomeController::class,'index'])->middleware('auth')->name('productors.index');

Route::get('recepcion', [HomeController::class,'production'])->middleware('auth')->name('production.index');

Route::get('recepciones', [HomeController::class,'productionpropia'])->middleware('auth')->name('productionpropia.index');

Route::get('recepciones/cc', [HomeController::class,'productioncc'])->middleware('auth')->name('productioncc.index');

Route::get('production/refresh', [HomeController::class,'production_refresh'])->middleware('auth')->name('production.refresh');

Route::get('productores/refresh', [HomeController::class,'productor_refresh'])->middleware('auth')->name('productor.refresh');

Route::get('informe/{recepcion}', [HomeController::class,'downloadpdf'])->middleware('auth')->name('informe.download');

Route::resource('telefono', TelefonoController::class)->names('telefonos');

Route::resource('role', RoleController::class)->names('admin.roles');

Route::resource('users', UserController::class)->only(['index','edit','update','destroy'])->names('users');

Route::resource('prod/users', ProductorUserController::class)->only(['update'])->names('productor.users');

Route::get('procesos', [HomeController::class,'procesos'])->middleware('auth')->name('procesos.index');