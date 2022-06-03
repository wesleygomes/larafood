<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description'
    ];

    /**
     * Get Permissions
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    /**
     * Get Plans
     */
    public function plans()
    {
        return $this->belongsToMany(Plan::class);
    }


    public function search($filter = null)
    {

        $results = $this->when($filter, function ($query, $vl) {
            $query->where('name', 'LIKE', '%' .  $vl . '%');
            $query->orWhere('description', 'LIKE', "%{$vl}%");
        })->paginate();

        return $results;
    }

    public function permissionsAvailable($filter = null)
    {

        $permissions = Permission::whereNotIn('permissions.id', function ($query) {
            $query->select('permission_profile.permission_id');
            $query->from('permission_profile');
            $query->whereRaw("permission_profile.profile_id={$this->id}");
        })
            ->when($filter, function ($query, $vl) {
                $query->where('permissions.name', 'LIKE', "%{$vl}%");
            })->paginate();

        return $permissions;
    }

    public function plansAvailable($filter = null)
    {

        $plans = Plan::whereNotIn('plans.id', function ($query) {
            $query->select('plan_profile.plan_id');
            $query->from('plan_profile');
            $query->whereRaw("plan_profile.profile_id={$this->id}");
        })
            ->when($filter, function ($query, $vl) {
                $query->where('plans.name', 'LIKE', "%{$vl}%");
            })->paginate();

        return $plans;
    }
}
