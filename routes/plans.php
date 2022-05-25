<?php

use App\Http\Controllers\Admin\PlanController;
use Illuminate\Support\Facades\Route;


Route::any('plans/search', [PlanController::class, 'search'])->name('plans.search');
Route::resource('plans', PlanController::class);
