<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\WidinstaController;

Route::get('/test', function () {
    return response()->json([
        'message' => 'API funcionando'
    ]);
});
Route::post('/portafolio', [ContactoController::class, 'store']);
Route::get('/widinsta', [WidinstaController::class, 'index']);