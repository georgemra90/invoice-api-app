<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\TipoIdentificacionController;
use App\Http\Controllers\TipoUsuarioController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('tipo-identificacion')->group(function () {
    Route::get('/listar', [TipoIdentificacionController::class, 'listar']);
    Route::get('/consultar/{id}', [TipoIdentificacionController::class, 'consultar']);
    Route::post('/guardar', [TipoIdentificacionController::class, 'guardar']);
    Route::put('/actualizar', [TipoIdentificacionController::class, 'actualizar']);
    Route::delete('/eliminar/{id}', [TipoIdentificacionController::class, 'eliminar']);
});

Route::prefix('marca')->group(function () {
    Route::get('/listar', [MarcaController::class, 'listar']);
    Route::get('/consultar/{id}', [MarcaController::class, 'consultar']);
    Route::post('/guardar', [MarcaController::class, 'guardar']);
    Route::put('/actualizar', [MarcaController::class, 'actualizar']);
    Route::delete('/eliminar/{id}', [MarcaController::class, 'eliminar']);
});

Route::prefix('tipo-usuario')->group(function () {
    Route::get('/listar', [TipoUsuarioController::class, 'listar']);
    Route::get('/consultar/{id}', [TipoUsuarioController::class, 'consultar']);
    Route::post('/guardar', [TipoUsuarioController::class, 'guardar']);
    Route::put('/actualizar', [TipoUsuarioController::class, 'actualizar']);
    Route::delete('/eliminar/{id}', [TipoUsuarioController::class, 'eliminar']);
});

Route::prefix('cliente')->group(function () {
    Route::get('/listar', [ClienteController::class, 'listar']);
    Route::get('/consultar/{id}', [ClienteController::class, 'consultar']);
    Route::post('/guardar', [ClienteController::class, 'guardar']);
    Route::put('/actualizar', [ClienteController::class, 'actualizar']);
    Route::delete('/eliminar/{id}', [ClienteController::class, 'eliminar']);
});

Route::prefix('proveedor')->group(function () {
    Route::get('/listar', [ProveedorController::class, 'listar']);
    Route::get('/consultar/{id}', [ProveedorController::class, 'consultar']);
    Route::post('/guardar', [ProveedorController::class, 'guardar']);
    Route::put('/actualizar', [ProveedorController::class, 'actualizar']);
    Route::delete('/eliminar/{id}', [ProveedorController::class, 'eliminar']);
});

Route::prefix('producto')->group(function () {
    Route::get('/listar', [ProductoController::class, 'listar']);
    Route::get('/consultar/{id}', [ProductoController::class, 'consultar']);
    Route::post('/guardar', [ProductoController::class, 'guardar']);
    Route::put('/actualizar', [ProductoController::class, 'actualizar']);
    Route::delete('/eliminar/{id}', [ProductoController::class, 'eliminar']);
});