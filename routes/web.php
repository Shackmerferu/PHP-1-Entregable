<?php

use App\Http\Controllers\CarritoController;
use App\Http\Controllers\ProductoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::resource('productos', ProductoController::class);
Route::resource('carrito', CarritoController::class);
