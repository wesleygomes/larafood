<?php

use App\Http\Controllers\Admin\ACL\PlanProfileController;
use Illuminate\Support\Facades\Route;



Route::delete('plans/{id}/profile/{idProfile}', [PlanProfileController::class, 'detachPlanProfile'])->name('plans.profile.detach');
Route::post('plans/{id}/profile', [PlanProfileController::class, 'attachPlansProfile'])->name('plans.profile.attach');
Route::any('plans/{id}/profile/create', [PlanProfileController::class, 'plansAvailable'])->name('plans.profile.available');
Route::get('plans/{id}/profiles', [PlanProfileController::class, 'profiles'])->name('plans.profiles');
Route::get('profiles/{id}/plans', [PlanProfileController::class, 'plans'])->name('profiles.plans');
