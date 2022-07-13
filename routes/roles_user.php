<?php

use App\Http\Controllers\Admin\ACL\RoleUserController;
use Illuminate\Support\Facades\Route;



Route::delete('users/{id}/role/{idRole}/detach', [RoleUserController::class, 'detachRoleUser'])->name('users.role.detach');
Route::post('users/{id}/roles', [RoleUserController::class, 'attachRolesUser'])->name('users.roles.attach');
Route::any('users/{id}/roles/create', [RoleUserController::class, 'rolesAvailable'])->name('users.roles.available');
Route::get('users/{id}/roles', [RoleUserController::class, 'roles'])->name('users.roles');
Route::get('roles/{id}/users', [ACL\RoleUserController::class, 'users'])->name('roles.users');
