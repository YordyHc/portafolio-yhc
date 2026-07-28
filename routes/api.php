<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactoController;

Route::get('/test', function () {
    return response()->json([
        'message' => 'API funcionando'
    ]);
});
Route::post('/clientes', [ContactoController::class, 'store']);

Route::get('/debug-mail', function () {
    return response()->json([
        'mailer' => config('mail.default'),
        'host' => config('mail.mailers.smtp.host'),
        'port' => config('mail.mailers.smtp.port'),
        'encryption' => config('mail.mailers.smtp.encryption'),
        'username' => config('mail.mailers.smtp.username'),
    ]);
});