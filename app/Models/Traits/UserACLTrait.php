<?php

namespace App\Models\Traits;

use App\Tenant\ManagerTenant;

trait UserACLTrait
{
    public function permissions()
    {
        $tenant = $this->tenant;
        $plan = $tenant->plan;

        $permissions = [];

        foreach ($plan->profiles as $profile) {
            foreach ($profile->permissions as $permission) {
                array_push($permissions, $permission->name);
            }
        }

        return $permissions;
    }

    // public function permissions()
    // {
    //     return $this->tenant()->first()
    //         ->plan()->first()
    //         ->profiles()->first()
    //         ->permissions->pluck('name');
    // }


    public function hasPermission(string $permissionName): bool
    {
        return in_array($permissionName, $this->permissions());
    }

    public function isAdmin()
    {
        $managerTenant = app(ManagerTenant::class);

        return $managerTenant->isAdmin();
    }
}
