<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::redirect('/user', '/');
Route::post('/forms/contact.php', [ContactController::class, 'store'])
    ->middleware('throttle:5,1')
    ->name('contact.store');

require __DIR__.'/admin-auth.php';
