<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactoController;

Route::get('/test', function () {
    return response()->json([
        'message' => 'API funcionando'
    ]);
});
Route::post('/clientes', [ContactoController::class, 'store']);