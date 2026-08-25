<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleAuthController;


/*Route::get('/oauth/gmail', [
    GoogleAuthController::class,
    'redirect'
]);*/


Route::get('/oauth/gmail/callback', [
    GoogleAuthController::class,
    'callback'
]);


Route::get('/', function () {
    return view('welcome');
});
