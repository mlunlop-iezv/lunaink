<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TattooController;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\StyleController;

/*
|--------------------------------------------------------------------------
| Web Routes - LunaInk
|--------------------------------------------------------------------------
*/

// 1. PÁGINA DE INICIO
Route::get('/', function () {
    return view('main.home');
})->name('main.home');

// 2. RUTAS DE TATTOOS
Route::resource('tattoos', App\Http\Controllers\TattooController::class);

// 3, RUTAS DE ARTIST
Route::resource('artists', App\Http\Controllers\ArtistController::class);

// 4. RUTAS DE ESTILOS 
Route::resource('styles', App\Http\Controllers\StyleController::class);