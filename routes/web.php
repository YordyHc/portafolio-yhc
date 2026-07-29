<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleAuthController;

/* ACTIVAR DE NUEVO PARA OTORGAR PRMISOS PORSIACASO
Route::get('/oauth/gmail', [
    GoogleAuthController::class,
    'redirect'
]);
*/

Route::get('/oauth/gmail/callback', [
    GoogleAuthController::class,
    'callback'
]);


Route::get('/', function () {
    return view('welcome');
});
