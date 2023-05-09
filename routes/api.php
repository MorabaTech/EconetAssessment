<?php

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

Route::post('/shop', [\App\Http\Controllers\ApiController::class, 'store']);
Route::get('/shop/{area_id}', [\App\Http\Controllers\ApiController::class, 'getShopsByArea']);
Route::post('/area', [\App\Http\Controllers\ApiController::class, 'createArea']);
Route::get('/area', [\App\Http\Controllers\ApiController::class, 'getArea']);
