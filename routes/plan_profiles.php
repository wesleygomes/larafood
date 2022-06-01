<?php

use App\Http\Controllers\Admin\ACL\PlanProfileController;
use Illuminate\Support\Facades\Route;



Route::delete('plans/{id}/profile/{idProfile}', [PlanProfileController::class, 'detachPlanProfile'])->name('plans.profile.detach');
//Route::post('plans/{id}/profile', [PermissionProfileController::class, 'attachPermissionsProfile'])->name('plans.profile.attach');
//Route::any('plans/{id}/profile/create', [PermissionProfileController::class, 'permissionsAvailable'])->name('plans.profile.available');
Route::get('plans/{id}/profile', [PlanProfileController::class, 'profiles'])->name('plans.profile');
