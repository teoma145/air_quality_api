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
Route::get('air_quality', [AirQualityController::class, 'index']);
Route::get('air_quality/comune/{comune}', [AirQualityController::class, 'filterByComune']);
Route::get('air_quality/classe_qualita/{classe_qualità}', [AirQualityController::class, 'filterByClasseQualita']);
Route::get('air_quality/coordinates', [AirQualityController::class, 'filterByCoordinates']);
Route::get('air_quality/comune/{comune}/classe_qualità/{classe_qualita}', [AirQualityController::class, 'filterByComuneAndClasseQualita']);
Route::post('air_quality/filter', [AirQualityController::class, 'PostByComuneAndClasseQualita']);
Route::delete('air_quality/{id}', [AirQualityController::class, 'deleteById']);