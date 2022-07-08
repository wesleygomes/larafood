<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class PermissionRoleController extends Controller
{

    protected $role, $permission;

    public function __construct(Role $role, Permission $permission)
    {
        $this->role = $role;
        $this->permission = $permission;

        $this->middleware(['can:roles']);
    }

    public function permissions($idRole)
    {
        $role = $this->role->find($idRole);

        if (!$role) {
            return redirect()->back();
        }

        $permissions = $role->permissions()->paginate();

        return view('admin.pages.roles.permissions.permissions', compact('role', 'permissions'));
    }

    public function roles($idPermission)
    {
        if (!$permission = $this->permission->find($idPermission)) {
            return redirect()->back();
        }

        $roles = $permission->Roles()->paginate();

        return view('admin.pages.permissions.roles.roles', compact('permission', 'roles'));
    }

    public function permissionsAvailable(Request $request, $idRole)
    {
        if (!$role = $this->role->find($idRole)) {
            return redirect()->back();
        }

        $filters = $request->except('_token');

        $permissions = $role->permissionsAvailable($request->filter);

        return view('admin.pages.roles.permissions.available', compact('role', 'permissions'));
    }

    public function attachPermissionsRole(Request $request, $idRole)
    {
        if (!$role = $this->role->find($idRole)) {
            return redirect()->back();
        }

        //verifica se esta vazio
        if (!isset($request->permissions)) {
            return redirect()
                ->back()
                ->with('info', 'Precisa escolher pelo menos uma permissão');
        }

        try {
            $role->permissions()->attach($request->permissions);
            alert()->success('Sucesso', 'Vínculo adicionado com sucesso!')->toToast();
            return redirect()->route('roles.permissions', $role->id);
        } catch (\Throwable $th) {
            alert()->error('Erro', 'Algo deu errado, tente novamente');
            return redirect()->back();
        }
    }

    public function detachPermissionRole($idRole, $idPermission)
    {
        $role = $this->role->find($idRole);
        $permission = $this->permission->find($idPermission);

        if (!$role || !$permission) {
            return redirect()->back();
        }

        try {
            $role->permissions()->detach($permission);
            alert()->success('Sucesso', 'Vínculo removido com sucesso!')->toToast();
            return redirect()->route('roles.permissions', $role->id);
        } catch (\Throwable $th) {
            alert()->error('Erro', 'Algo deu errado, tente novamente');
            return redirect()->back();
        }
    }
}
