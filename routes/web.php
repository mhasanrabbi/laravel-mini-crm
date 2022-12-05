<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Route::permanentRedirect('/', url('login'));

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::view('about', 'about')->name('about');

    Route::middleware('role:admin')->group(function () {
        Route::resource('users', UserController::class)->except('show');
        # User Trash
        Route::get('users/trash', [UserController::class, 'trash'])->name('users.trash');
        Route::post('users/trash/{id}/restore', [UserController::class, 'trashRestore'])->name('users.trash.restore');
        Route::delete('users/trash/{id}/delete', [UserController::class, 'trashDestroy'])->name('users.trash.destroy');
    });

    Route::resource('clients', ClientController::class);

    Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
});