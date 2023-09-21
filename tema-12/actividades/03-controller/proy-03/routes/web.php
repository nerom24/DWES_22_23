<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CuentaController;
use App\Http\Controllers\BancoController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', HomeController::class);

// Asignar ruta controlador CuentaResource
Route::get('/cuentas', [CuentaController::class, 'index']);
Route::get('/cuentas/create', [CuentaController::class, 'create']);
Route::get('/cuentas/show/{id}', [CuentaController::class, 'show']);
Route::get('/cuentas/edit/{id}', [CuentaController::class, 'edit']);
Route::get('/cuentas/destroy/{id}', [CuentaController::class, 'destroy']);

// Agrupar rutas controlador BancoController
Route::controller(BancoController::class)->group(function(){
    Route::get('/bancos', 'index');
    Route::get('/bancos/create', 'create');
    Route::get('/bancos/show/{id}', 'show');
    Route::get('/bancos/edit/{id}', 'edit');
    Route::delete('/bancos/destroy/{id}', 'destroy');
});

// Asiganar ruta mediante controlador ClienteController creado con --resource
Route::resource('clientes', ClienteController::class);
