<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\JefeController;

Route::prefix('jefe')->group(function () {
    Route::get('/', [JefeController::class, 'index']);
    Route::post('/', [JefeController::class, 'store']);
    Route::get('/{id}', [JefeController::class, 'show']);
    Route::put('/{id}', [JefeController::class, 'update']);
    Route::delete('/{id}', [JefeController::class, 'destroy']);
});

//LOGIN
use App\Http\Controllers\Api\AuthController;

Route::post('/login', [AuthController::class, 'login']);
// Rutas Prospecto
use App\Http\Controllers\Api\ProspectoController;

Route::apiResource('prospectos', ProspectoController::class);

use App\Http\Controllers\Api\ProductosController;    
Route::apiResource('productos', ProductosController::class);


use App\Http\Controllers\Api\UserProspectoController;

// Obtener un UserProspecto por prospecto_id
Route::get('user-prospecto/prospecto/{prospectoId}', [UserProspectoController::class, 'showByProspecto']);

// Actualizar un UserProspecto por prospecto_id
Route::put('user-prospecto/prospecto/{prospectoId}', [UserProspectoController::class, 'updateByProspecto']);


// Actualizar un UserProspecto directamente por su ID
Route::put('user-prospecto/{id}', [UserProspectoController::class, 'update']);


Route::get('/test-prospecto', function () {
    return \App\Models\Prospecto::with('tipoDocumento')->first();
});
//  gabriela mensaje de pagar 150 mensual se va a descuadrar 

use App\Http\Controllers\Api\ConclusionController;

Route::get('/conclusiones', [ConclusionController::class, 'index']);


use App\Http\Controllers\Api\VendedorController;

Route::get('/vendedores', [VendedorController::class, 'index']);
