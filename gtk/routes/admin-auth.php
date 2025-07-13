<?php

use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\Auth\RegisteredUserController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ServicesController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\customController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\QweController;
use App\Http\Controllers\Admin\QwesController;
use App\Http\Controllers\Admin\SayController;
use App\Http\Controllers\Admin\TeamController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest:admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

  
});

Route::middleware('auth:admin')->prefix('admin')->name('admin.')->group(function () {
   
Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['verified'])->name('dashboard');
Route::resource('services', ServicesController::class);
Route::resource('about', AboutController::class);
Route::resource('qwes', QweController::class);
Route::resource('news' , NewsController::class);
Route::resource('custom',customController::class);

Route::resource('team',TeamController::class);
Route::resource('say',SayController::class);
Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});

