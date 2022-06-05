<?php

use App\Http\Controllers\Admin\ACL\PlanProfileController;
use Illuminate\Support\Facades\Route;


Route::delete('plans/{id}/profile/{idProfile}', [PlanProfileController::class, 'detachPlanProfile'])->name('plans.profiles.detach');
Route::post('plans/{id}/profile', [PlanProfileController::class, 'attachProfilesPlan'])->name('plans.profiles.attach');
Route::any('plans/{id}/profiles/create', [PlanProfileController::class, 'profilesAvailable'])->name('plans.profiles.available');
Route::get('plans/{id}/profiles', [PlanProfileController::class, 'profiles'])->name('plans.profiles');
Route::get('profiles/{id}/plans', [PlanProfileController::class, 'plans'])->name('profiles.plans');
