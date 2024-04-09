<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\AppController::class, 'index'])->name('app.index');
Route::delete('{uuid}', [\App\Http\Controllers\AppController::class, 'destroy'])->name('app.destroy');
