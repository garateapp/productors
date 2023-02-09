<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\TelefonoController;
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
    

    Route::get('/dashboard', function () {
        $users=User::all();
        return view('dashboard',compact('users'));})->name('dashboard');
});

Route::get('productores', [HomeController::class,'index'])->middleware('auth')->name('productors.index');

Route::get('production', [HomeController::class,'production'])->middleware('auth')->name('production.index');

Route::get('production/refresh', [HomeController::class,'production_refresh'])->middleware('auth')->name('production.refresh');

Route::get('productores/refresh', [HomeController::class,'productor_refresh'])->middleware('auth')->name('productor.refresh');


Route::resource('telefono', TelefonoController::class)->names('telefonos');