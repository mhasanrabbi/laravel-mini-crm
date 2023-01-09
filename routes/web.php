<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProjectController;



Route::permanentRedirect('/', url('login'));

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::get('/tasks', [App\Http\Controllers\TaskController::class, 'index'])->name('tasks.index');
// Route::get('/tasks/create', [App\Http\Controllers\TaskController::class, 'create'])->name('tasks.create');
// Route::post('/tasks', [App\Http\Controllers\TaskController::class, 'store'])->name('tasks.store');

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
    Route::resource('projects', ProjectController::class);
    Route::resource('tasks', TaskController::class);


    Route::get('/get-project', [TaskController::class, 'getProject']);
    Route::get('/project-users', [TaskController::class, 'getUser']);
    Route::get('get_assign_user', [TaskController::class, 'getAssignUser']);

    Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
});