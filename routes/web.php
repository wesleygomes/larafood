<?php

use App\Http\Controllers\Admin\PlanController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});



Route::prefix('admin')->group(function () {

    Route::any('plans/search', [PlanController::class, 'search'])->name('plans.search');
    Route::resource('plans', PlanController::class);

    Route::get('/', [PlanController::class, 'index'])->name('admin.index');
});

