<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TipoContatoController;

Route::resource('tipo-contato', TipoContatoController::class);