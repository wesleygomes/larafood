<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class RoleUserController extends Controller
{

    protected $role, $users;

    public function __construct(Role $role, User $users)
    {
        $this->role = $role;
        $this->user = $users;

        $this->middleware(['can:users']);
    }

    public function users($idRole)
    {
        $role = $this->role->find($idRole);

        if (!$role) {
            return redirect()->back();
        }

        $users = $role->users()->paginate();

        return view('admin.pages.roles.users.users', compact('role', 'users'));
    }

    public function roles($idUser)
    {
        $user = $this->user->find($idUser);

        if (!$user) {
            return redirect()->back();
        }

        $roles = $user->roles()->paginate();

        return view('admin.pages.users.roles.roles', compact('user', 'roles'));
    }

    public function rolesAvailable(Request $request, $idUser)
    {
        if (!$user = $this->user->find($idUser)) {
            return redirect()->back();
        }

        $filters = $request->except('_token');

        $roles = $user->rolesAvailable($request->filter);

        return view('admin.pages.users.roles.available', compact('roles', 'user', 'filters'));
    }

    public function attachRolesUser(Request $request, $idUser)
    {
        if (!$user = $this->user->find($idUser)) {
            return redirect()->back();
        }

        //verifica se esta vazio
        if (!isset($request->roles)) {
            return redirect()
                ->back()
                ->with('info', 'Precisa escolher pelo menos uma permissão');
        }

        try {
            $user->roles()->attach($request->roles);
            alert()->success('Sucesso', 'Vínculo adicionado com sucesso!')->toToast();
            return redirect()->route('users.roles', $user->id);
        } catch (\Throwable $th) {
            alert()->error('Erro', 'Algo deu errado, tente novamente');
            return redirect()->back();
        }
    }

    public function detachRoleUser($idUser, $idRole)
    {
        $user = $this->user->find($idUser);
        $role = $this->role->find($idRole);

        if (!$user || !$role) {
            return redirect()->back();
        }

        try {
            $user->roles()->detach($role);
            alert()->success('Sucesso', 'Vínculo removido com sucesso!')->toToast();
            return redirect()->route('users.roles', $user->id);
        } catch (\Throwable $th) {
            alert()->error('Erro', 'Algo deu errado, tente novamente');
            return redirect()->back();
        }
    }
}
