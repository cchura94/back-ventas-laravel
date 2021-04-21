<?php

use App\Http\Controllers\ApiCategoriaController;
use App\Http\Controllers\ApiClienteController;
use App\Http\Controllers\ApiPedidoController;
use App\Http\Controllers\ApiProductoController;
use App\Http\Controllers\ApiProveedorController;
use App\Http\Controllers\ApiRoleController;
use App\Http\Controllers\ApiUserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource("/categoria", ApiCategoriaController::class);
Route::apiResource("/pedido", ApiPedidoController::class);
Route::apiResource("/cliente", ApiClienteController::class);
Route::apiResource("/producto", ApiProductoController::class);
Route::apiResource("/proveedor", ApiProveedorController::class);
Route::apiResource("/role", ApiRoleController::class);
Route::apiResource("/usuario", ApiUserController::class);
