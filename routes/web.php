<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', [TaskController::class, 'index'])->name('task.index');

Route::get('/task/create', [TaskController::class, 'create'])->name('task.create');

Route::post('/task/store',[TaskController::class, 'store'])->name('task.store');

Route::get('/statistics', [TaskController::class, 'statistics'])->name('task.statistics');
