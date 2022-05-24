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

    public function permissions($idPerfil)
    {
        $profile = $this->profile->find($idPerfil);

        if (!$profile) {
            return redirect()->back();
        }

        $permissions = $profile->permissions()->paginate();

        return view('admin.pages.profiles.permissions.permissions', compact('profile', 'permissions'));
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
}
