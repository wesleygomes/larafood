<?php

use App\Http\Controllers\PlanController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});



Route::get('admin/plans', [PlanController::class, 'index'])->name('plans.index');
Route::get('admin/plans/create', [PlanController::class, 'create'])->name('plans.create');
Route::post('admin/plans', [PlanController::class, 'store'])->name('plans.store');
Route::put('admin/plans/{url}', [PlanController::class, 'update'])->name('plans.update');
Route::delete('admin/plans/{url}', [PlanController::class, 'destroy'])->name('plans.destroy');
Route::get('admin/plans/{url}/edit', [PlanController::class, 'edit'])->name('plans.edit');
Route::get('admin/plans/{url}', [PlanController::class, 'show'])->name('plans.show');

