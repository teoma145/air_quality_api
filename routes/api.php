<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AirQualityController;

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
Route::get('airquality', [AirQualityController::class, 'index']);
Route::get('airquality/comune/{comune}', [AirQualityController::class, 'filterByComune']);
Route::get('airquality/{id}', [AirQualityController::class, 'show']);
Route::get('airquality/classequalita/{classe_qualità}', [AirQualityController::class, 'filterByClasseQualita']);
Route::post('airquality/coordinates', [AirQualityController::class, 'filterByCoordinates']);
Route::get('airquality/{comune}/classe_qualità/{classe_qualita}', [AirQualityController::class, 'filterByComuneAndClasseQualita']);
Route::post('airquality', [AirQualityController::class, 'PostByComuneAndClasseQualita']);
Route::delete('airquality/{id}', [AirQualityController::class, 'deleteById']);
Route::put('airquality/{id}', [AirQualityController::class, 'update']);
Route::patch('airquality/{id}', [AirQualityController::class, 'patch']);
Route::post('airquality/search', [AirQualityController::class, 'search']);
