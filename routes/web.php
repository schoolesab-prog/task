<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', [TaskController::class, 'dashboard'])->name('dashboard');
Route::resource('tasks', TaskController::class);
