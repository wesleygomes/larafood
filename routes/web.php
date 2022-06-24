<?php

use App\Http\Controllers\Admin\ACL\{
    PermissionController,
    ProfileController,
};
use App\Http\Controllers\Admin\{
    CategoryController,
    UserController,
    PlanController,
    ProductController,
};
use App\Http\Controllers\Site\SiteController;
use Illuminate\Support\Facades\Route;

/**
 * Route Plan
 */
Route::prefix('admin')->middleware('auth')->group(base_path('routes/plans.php'));

/**
 * Route Details Plan
 */
Route::prefix('admin')->group(base_path('routes/details_plans.php'));

/**
 * Route Permission x Profile
 */
Route::prefix('admin')->group(base_path('routes/permissions_profiles.php'));

/**
 * Route Plan x Profile
 */
Route::prefix('admin')->group(base_path('routes/plan_profiles.php'));

/**
 * Route Profile x Permission
 */
Route::prefix('admin')->group(base_path('routes/profiles_permissions.php'));



Route::prefix('admin')->middleware('auth')->group(function () {


    /**
     * Route Products
     *
     */

    Route::any('products/search', [ProductController::class, 'search'])->name('products.search');
    Route::resource('products', ProductController::class);


    /**
     * Route Categories
     *
     */

    Route::any('categories/search', [CategoryController::class, 'search'])->name('categories.search');
    Route::resource('categories', CategoryController::class);

    /**
     * Route Users
     */

    Route::any('users/search', [UserController::class, 'search'])->name('users.search');
    Route::resource('users', UserController::class);


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

Route::get('/plan/{url}', [SiteController::class, 'plan'])->name('plan.subscription');
Route::get('/', [SiteController::class, 'index'])->name('site.index');

require __DIR__ . '/auth.php';
