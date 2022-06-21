<?php

namespace App\Models;

use App\Tenant\ManagerTenant;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 'email', 'password', 'acitve', 'tenant_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Scope a query to only users by tenant
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeTenantUser(Builder $query)
    {
        return $query
            //->where('active', 'Y')
            ->where('tenant_id', auth()->user()->tenant_id);

        // $isAdmin = app(ManagerTenant::class)->isAdmin();

        // return $query->where(function($query) use($isAdmin) {
        //     if ($isAdmin === true) {
        //         $query->orWhere('tenant_id', auth()->user()->tenant_id);
        //     }
        //     $query->orWhere('active', 'Y');
        //     $query->orWhere('tenant_id', auth()->user()->tenant_id);
        // });
    }

    /**
     * Tenant
     */
    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }


    public function search($filter = null)
    {
        $results = $this->when($filter, function ($query, $vl) {
            $query->orWhere('name', 'LIKE', '%' .  $vl . '%');
            $query->orWhere('email', 'LIKE', "%{$vl}%");
        })
            ->latest()
            ->tenantUser()
            ->paginate();

        return $results;
    }
}
