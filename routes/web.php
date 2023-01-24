<?php

use App\Http\Controllers\PasteController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PasteController::class, 'index'])->name('index');

Auth::routes();

Route::post('/', [PasteController::class, 'store'])->name('create_paste');

Route::get('/{url}', [PasteController::class, 'show']);
