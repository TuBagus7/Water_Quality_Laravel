<?php

use App\Http\Controllers\Api\SensorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::get('/testing', function () {
    return response()->json(["data" => "testing"]);
});

Route::get('/sensors', [SensorController::class, 'index']);
Route::post('/sensors', [SensorController::class, 'store']);
