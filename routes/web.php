<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ComidaController;
use App\Http\Controllers\TipoComidaController;


Route::get('/', function () {
    return redirect()->route('comidas.index');
});

Route::resource('comidas', ComidaController::class);

Route::resource('tipo_comidas', TipoComidaController::class);