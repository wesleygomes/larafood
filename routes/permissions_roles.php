<?php

use App\Http\Controllers\Admin\ACL\PermissionRoleController;
use Illuminate\Support\Facades\Route;



Route::delete('roles/{id}/permissions/{idPermission}', [PermissionRoleController::class, 'detachPermissionRole'])->name('roles.permission.detach');
Route::post('roles/{id}/permissions', [PermissionRoleController::class, 'attachPermissionsRole'])->name('roles.permissions.attach');
Route::any('roles/{id}/permissions/create', [PermissionRoleController::class, 'permissionsAvailable'])->name('roles.permissions.available');
Route::get('roles/{id}/permissions', [PermissionRoleController::class, 'permissions'])->name('roles.permissions');
Route::any('roles/{id}/permissions/create', [PermissionRoleController::class, 'permissionsAvailable'])->name('roles.permissions.available');
Route::get('permissions/{id}/roles', [PermissionRoleController::class, 'roles'])->name('permissions.roles');
