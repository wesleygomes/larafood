<?php

use App\Http\Controllers\Admin\ACL\PermissionProfileController;
use Illuminate\Support\Facades\Route;



Route::any('profiles/{id}/permissions/create', [PermissionProfileController::class, 'permissionsAvailable'])->name('profiles.permissions.available');
Route::get('permissions/{id}/profiles', [PermissionProfileController::class, 'profiles'])->name('permissions.profiles');
