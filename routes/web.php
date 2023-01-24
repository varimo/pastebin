<?php

use App\Http\Controllers\PasteController;
use App\Http\Controllers\ProfilController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PasteController::class, 'index'])->name('index');

Route::get('/profil', [ProfilController::class, 'index'])->name('profil');

Auth::routes();

Route::post('/', [PasteController::class, 'store'])->name('create_paste');

Route::get('/{url}', [PasteController::class, 'show']);
