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



Route::prefix('admin')->group(function () {


    /**
     * Route Permission x Profile
     */

    Route::post('profiles/{id}/permissions/attach', [PermissionProfileController::class, 'attach'])->name('profiles.permissions.attach');
    Route::delete('profiles/{id}/permissions/{idPermission}', [PermissionProfileController::class, 'detach'])->name('profiles.permissions.detach');
    Route::any('profiles/{id}/permissions/create', [PermissionProfileController::class, 'permissionsAvailable'])->name('profiles.permissions.available');
    Route::get('profiles/{id}/permissions', [PermissionProfileController::class, 'permissions'])->name('profiles.permissions'); //


    /**
     * Route Premissions
     */

    Route::any('permissions/search', [PermissionController::class, 'search'])->name('permissions.search');
    Route::resource('permissions', PermissionController::class);


    /**
     * Route Profiles
     */

    Route::any('profiles/search', [ProfileController::class, 'search'])->name('profiles.search');
    Route::resource('profiles', ProfileController::class);



    /**
     * Route Detais Plan
     */

    Route::delete('plans/{url}/details/{idDetail}', [DetailPlanController::class, 'destroy'])->name('details.plan.destroy');
    Route::get('plans/{url}/details/create', [DetailPlanController::class, 'create'])->name('details.plan.create');
    Route::get('plans/{url}/details/{idDetail}', [DetailPlanController::class, 'show'])->name('details.plan.show');
    Route::put('plans/{url}/details/{idDetail}', [DetailPlanController::class, 'update'])->name('details.plan.update');
    Route::get('plans/{url}/details/{idDetail}/edit', [DetailPlanController::class, 'edit'])->name('details.plan.edit');
    Route::post('plans/{url}/details/create', [DetailPlanController::class, 'store'])->name('details.plan.store');
    Route::get('plans/{url}/details', [DetailPlanController::class, 'index'])->name('details.plan.index');

    /*
    * Route Plan
    */
    Route::any('plans/search', [PlanController::class, 'search'])->name('plans.search');
    Route::resource('plans', PlanController::class);

    /**
     * Route Home
     */
    Route::get('/', [PlanController::class, 'index'])->name('admin.index');
});
