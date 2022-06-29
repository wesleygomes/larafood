<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Profile;
use Illuminate\Http\Request;

class PermissionProfileController extends Controller
{

    protected $profile, $permission;

    public function __construct(Profile $profile, Permission $permission)
    {
        $this->profile = $profile;
        $this->permission = $permission;
    }

    public function permissions($idProfile)
    {
        $profile = $this->profile->find($idProfile);

        if (!$profile) {
            return redirect()->back();
        }

        $permissions = $profile->permissions()->paginate();

        return view('admin.pages.profiles.permissions.permissions', compact('profile', 'permissions'));
    }

    public function profiles($idPermission)
    {
        if (!$permission = $this->permission->find($idPermission)) {
            return redirect()->back();
        }

        $profiles = $permission->profiles()->paginate();

        return view('admin.pages.permissions.profiles.profiles', compact('permission', 'profiles'));
    }

    public function permissionsAvailable(Request $request, $idPerfil)
    {
        if (!$profile = $this->profile->find($idPerfil)) {
            return redirect()->back();
        }

        $filters = $request->except('_token');

        $permissions = $profile->permissionsAvailable($request->filter);

        return view('admin.pages.profiles.permissions.available', compact('profile', 'permissions'));
    }

    public function attachPermissionsProfile(Request $request, $idPerfil)
    {
        if (!$profile = $this->profile->find($idPerfil)) {
            return redirect()->back();
        }

        //verifica se esta vazio
        if (!isset($request->permissions)) {
            return redirect()
                ->back()
                ->with('info', 'Precisa escolher pelo menos uma permissão');
        }

        try {
            $profile->permissions()->attach($request->permissions);
            alert()->success('Sucesso', 'Vínculo adicionado com sucesso!')->toToast();
            return redirect()->route('profiles.permissions', $profile->id);
        } catch (\Throwable $th) {
            alert()->error('Erro', 'Algo deu errado, tente novamente');
            return redirect()->back();
        }
    }

    public function detachPermissionProfile($idProfile, $idPermission)
    {
        $profile = $this->profile->find($idProfile);
        $permission = $this->permission->find($idPermission);

        if (!$profile || !$permission) {
            return redirect()->back();
        }

        try {
            $profile->permissions()->detach($permission);
            alert()->success('Sucesso', 'Vínculo removido com sucesso!')->toToast();
            return redirect()->route('profiles.permissions', $profile->id);
        } catch (\Throwable $th) {
            alert()->error('Erro', 'Algo deu errado, tente novamente');
            return redirect()->back();
        }
    }
}
