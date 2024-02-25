<?php

use App\Http\Controllers\AjaxController;
use App\Http\Controllers\CampoStaffController;
use App\Http\Controllers\ComercialFruitController;
use App\Http\Controllers\FichaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MensajeController;
use App\Http\Controllers\MensajeHistController;
use App\Http\Controllers\ProcesoController;
use App\Http\Controllers\Productor\UserController as ProductorUserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SoporteController;
use App\Http\Controllers\TelefonoController;
use App\Http\Controllers\TicketController;
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

Route::get('/dashboard/variedad/{variedad}',[HomeController::class,'dashboard_variedad'])->name('dashboard.variedad');

Route::get('/dashboard/productor/{user}',[HomeController::class,'dashboard_productor'])->name('dashboard.productor');

Route::get('productores', [HomeController::class,'index'])->middleware('auth')->name('productors.index');

Route::get('recepcion', [HomeController::class,'production'])->middleware('auth')->name('production.index');

Route::get('recepcion/anterior', [HomeController::class,'productionanterior'])->middleware('auth')->name('production.index.anterior');

Route::get('recepciones', [HomeController::class,'productionpropia'])->middleware('auth')->name('productionpropia.index');

Route::get('recepciones/cc', [HomeController::class,'productionccindex'])->middleware('auth')->name('productioncc.index');

Route::get('recepciones/cc/anterior', [HomeController::class,'productionccindexanterior'])->middleware('auth')->name('productioncc.index.anterior');

Route::get('recepcion/{recepcion}/cc', [HomeController::class,'productioncc'])->middleware('auth')->name('agregar.cc');

Route::get('recepcion/{recepcion}/ss', [HomeController::class,'productionss'])->middleware('auth')->name('agregar.ss');

Route::get('production/refresh', [HomeController::class,'production_refresh'])->middleware('auth')->name('production.refresh');

Route::get('production/refresh/anterior', [HomeController::class,'production_refresh_anterior'])->middleware('auth')->name('production.refresh.anterior');

Route::get('productores/refresh', [HomeController::class,'productor_refresh'])->middleware('auth')->name('productor.refresh');

Route::get('download/recepcion/{recepcion}.pdf', [HomeController::class,'downloadpdf'])->name('informe.download');

Route::get('informe/{recepcion}', [HomeController::class,'viewpdf'])->name('informe.view');

Route::post('pass/{user}', [UserController::class,'password_rec'])->middleware('auth')->name('recuperar.contrasena');

Route::get('createlogo/{user}', [UserController::class,'logo_create'])->middleware('auth')->name('create.logo');

Route::post('updatelogo/{user}', [UserController::class,'logo_update'])->middleware('auth')->name('update.logo');

Route::post('deletelogo/{user}', [UserController::class,'logo_delete'])->middleware('auth')->name('delete.logo');

Route::resource('telefono', TelefonoController::class)->names('telefonos');

Route::resource('role', RoleController::class)->names('admin.roles');

Route::resource('users', UserController::class)->only(['index','edit','update','destroy'])->names('users');

Route::resource('prod/users', ProductorUserController::class)->only(['update'])->names('productor.users');

Route::get('envio-masivo', [HomeController::class,'envio_masivo'])->middleware('auth')->name('envio.masivo');

Route::get('procesos', [HomeController::class,'procesos'])->middleware('auth')->name('procesos.index');

Route::get('procesos/anterior', [HomeController::class,'procesos_anterior'])->middleware('auth')->name('procesos.index.anterior');

Route::get('procesos/productor/{user}', [ProcesoController::class,'index'])->middleware('auth')->name('procesos.productor.index');

Route::get('procesos/productor/{especie}', [ProcesoController::class,'productorespecie'])->middleware('auth')->name('procesos.productor.especie');

Route::get('procesos/productor/variedad/{variedad}', [ProcesoController::class,'productorvariedad'])->middleware('auth')->name('procesos.productor.variedad');

Route::get('procesos/{especie}', [ProcesoController::class,'especie'])->middleware('auth')->name('procesos.admin.especie');

Route::get('procesos/{especie}/anterior', [ProcesoController::class,'especie_anterior'])->middleware('auth')->name('procesos.admin.especie.anterior');

Route::get('procesos/variedad/{variedad}', [ProcesoController::class,'variedad'])->middleware('auth')->name('procesos.admin.variedad');

Route::get('procesos/variedad/{variedad}/anterior', [ProcesoController::class,'variedad_anterior'])->middleware('auth')->name('procesos.admin.variedad.anterior');

Route::get('proceso/refresh', [HomeController::class,'sync_proces'])->middleware('auth')->name('proceso.refresh');

Route::get('proceso/refresh/anterior', [HomeController::class,'sync_proces_anterior'])->middleware('auth')->name('proceso.refresh.anterior');

Route::get('consolidado/refresh', [HomeController::class,'sync_consolidado'])->middleware('auth')->name('consolidado.refresh');

Route::get('subir-proceso', [HomeController::class,'subir_procesos'])->middleware('auth')->name('subir.procesos');

Route::get('subir-proceso/anterior', [HomeController::class,'subir_procesos_anterior'])->middleware('auth')->name('subir.procesos.anterior');

Route::get('subir-recepciones', [HomeController::class,'subir_recepciones'])->middleware('auth')->name('subir.recepciones');

Route::post('archivo/procesos', [HomeController::class,'proceso_upload'])->name('proceso.upload');

Route::post('archivo/procesos/anterior', [HomeController::class,'proceso_upload_anterior'])->name('proceso.upload.anterior');

Route::post('archivo/recepcions', [HomeController::class,'recepcion_upload'])->name('recepcion.upload');

Route::get('download/{proceso}.pdf', [HomeController::class,'download_proceso'])->name('download.proceso');

Route::delete('delete/proceso/{proceso}',[HomeController::class,'proceso_destroy'])->name('delete.proceso');

Route::resource('mensaje', MensajeController::class)->middleware('auth')->names('mensajes');

Route::post('procesos/all', [AjaxController::class,'all'])->name('procesos.all');

Route::get('calibre/{recepcion}.html', [HomeController::class,'distribucion_calibre'])->name('distribucion.calibre');

Route::get('color/{recepcion}.html', [HomeController::class,'distribucion_color'])->name('distribucion.color');

//firmeza grande
Route::get('firmeza/grande/{recepcion}.html', [HomeController::class,'firmeza_grande'])->name('firmeza.grande');
//firmezza mediana
Route::get('firmeza/mediana/{recepcion}.html', [HomeController::class,'firmeza_mediano'])->name('firmeza.mediana');
//firmeza chica
Route::get('firmeza/chica/{recepcion}.html', [HomeController::class,'firmeza_chico'])->name('firmeza.chica');

Route::get('firmeza/{recepcion}.html', [HomeController::class,'promedio_firmeza'])->name('promedio.firmeza');

Route::get('calibrix/{recepcion}.html', [HomeController::class,'calibre_brix'])->name('calibre.brix');

Route::get('brix/{recepcion}.html', [HomeController::class,'promedio_brix'])->name('promedio.brix');

Route::get('porcentaje/firmeza/{recepcion}.html', [HomeController::class,'porcentaje_firmeza'])->name('porcentaje.firmeza');

Route::get('color/fondo/{recepcion}.html', [HomeController::class,'distribucion_color_fondo'])->name('distribucion.color.fondo');

Route::get('obervacion/externa/{recepcion}', [HomeController::class,'observacion_externa'])->name('observacion.externa');

Route::put('update/{calidad}',[HomeController::class,'detalle_update'])->name('detalle.update');

Route::get('documentacion', [HomeController::class,'documentacion'])->name('documentacion');

Route::get('estadisticas', [HomeController::class,'estadisticas'])->name('estadisticas');

Route::get('soporte/tecnico', [HomeController::class,'contacto'])->name('contacto');

Route::get('estadistica/{estadistica_type}', [HomeController::class,'estadistica_type'])->name('estadistica.type');

Route::get('user/create', [HomeController::class,'user_create'])->name('user.create');

Route::get('agronomos', [HomeController::class,'listado_agronomos'])->name('agronomos.index');

Route::get('agronomo/{user}', [HomeController::class,'agronomo_show'])->name('agronomo.show');

Route::get('formulario/productor/{user}', [HomeController::class,'productor_show'])->name('productor.show');

Route::post('user/admin/store', [HomeController::class,'user_store'])->name('user.store');

Route::resource('campostaff', CampoStaffController::class)->names('campostaffs');

Route::resource('soporte', SoporteController::class)->names('soportes');

Route::resource('ticket', TicketController::class)->names('tickets');

Route::resource('mensaje_hist', MensajeHistController::class)->names('mensaje_hists');

Route::resource('comercial_fruit', ComercialFruitController::class)->names('comercialfruits');

Route::resource('ficha', FichaController::class)->names('fichas');

Route::get('download/mensaje/{mensaje_hist}.pdf', [MensajeHistController::class,'download'])->name('download.mensaje_hist');