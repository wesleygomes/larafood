<?php

use App\Http\Controllers\Admin\ACL\PermissionController;
use App\Http\Controllers\Admin\ACL\PermissionProfileController;
use App\Http\Controllers\Admin\ACL\ProfileController;
use App\Http\Controllers\Admin\DetailPlanController;
use App\Http\Controllers\Admin\PlanController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

/**
 * Route Plan
 */
Route::prefix('admin')->group(base_path('routes/plans.php'));

/**
 * Route Details Plan
 */
Route::prefix('admin')->group(base_path('routes/details_plans.php'));

/**
 * Route Permission x Profile
 */
Route::prefix('admin')->group(base_path('routes/permissions_profiles.php'));



Route::prefix('admin')->group(function () {


    /**
     * Route Permissions
     */

    Route::any('permissions/search', [PermissionController::class, 'search'])->name('permissions.search');
    Route::resource('permissions', PermissionController::class);


    /**
     * Route Profiles
     */

    Route::any('profiles/search', [ProfileController::class, 'search'])->name('profiles.search');
    Route::resource('profiles', ProfileController::class);

    /**
     * Route Home
     */
    Route::get('/', [PlanController::class, 'index'])->name('admin.index');
});
