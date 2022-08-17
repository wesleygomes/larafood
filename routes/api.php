<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\TenantController;
use Illuminate\Support\Facades\Route;


Route::prefix('v1')->group(function () {


    Route::get('tenants', [TenantController::class, 'index']);
    Route::get('tenants/{uuid}', [TenantController::class, 'show']);

    Route::get('categories', [CategoryController::class, 'categoriesByTenant']);
});
