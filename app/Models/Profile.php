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

    public function search($filter = null)
    {

        $results = $this->where('name', 'LIKE', "%{$filter}%")
            ->orWhere('description', 'LIKE', "%{$filter}%")
            ->paginate();

        return $results;
    }

    public function permissionsAvailable($filter = null)
    {

        $permissions = Permission::whereNotIn('permissions.id', function ($query) {
            $query->select('permission_profile.permission_id');
            $query->from('permission_profile');
            $query->whereRaw("permission_profile.profile_id={$this->id}");
        })
            ->when($filter, function ($query) use ($filter) {
                $query->where('permissions.name', 'LIKE', "%{$filter}%");
            })
            ->paginate();

        return $permissions;
    }

    /**
     * Get Permissions
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
}
