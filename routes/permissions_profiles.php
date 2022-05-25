<?php

use App\Http\Controllers\Admin\ACL\PermissionProfileController;
use Illuminate\Support\Facades\Route;



Route::delete('profiles/{id}/permissions/{idPermission}', [PermissionProfileController::class, 'detachPermissionProfile'])->name('profiles.permission.detach');
Route::post('profiles/{id}/permissions', [PermissionProfileController::class, 'attachPermissionsProfile'])->name('profiles.permissions.attach');
Route::any('profiles/{id}/permissions/create', [PermissionProfileController::class, 'permissionsAvailable'])->name('profiles.permissions.available');
Route::get('profiles/{id}/permissions', [PermissionProfileController::class, 'permissions'])->name('profiles.permissions');
