<?php

use App\Http\Controllers\Admin\DetailPlanController;
use Illuminate\Support\Facades\Route;



Route::delete('plans/{url}/details/{idDetail}', [DetailPlanController::class, 'destroy'])->name('details.plan.destroy');
Route::get('plans/{url}/details/create', [DetailPlanController::class, 'create'])->name('details.plan.create');
Route::get('plans/{url}/details/{idDetail}', [DetailPlanController::class, 'show'])->name('details.plan.show');
Route::put('plans/{url}/details/{idDetail}', [DetailPlanController::class, 'update'])->name('details.plan.update');
Route::get('plans/{url}/details/{idDetail}/edit', [DetailPlanController::class, 'edit'])->name('details.plan.edit');
Route::post('plans/{url}/details/create', [DetailPlanController::class, 'store'])->name('details.plan.store');
Route::get('plans/{url}/details', [DetailPlanController::class, 'index'])->name('details.plan.index');
