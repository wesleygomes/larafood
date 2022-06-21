<?php

namespace App\Models;

use App\Tenant\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use TenantTrait;

    protected $fillable = ['name', 'url', 'description'];

    /**
     * Scope a query to only categories active
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive(Builder $query)
    {
        return $query->where('active', 'Y');
    }


    public function search($filter = null)
    {

        $results = $this->when($filter, function ($query, $vl) {
            $query->where('name', 'LIKE', '%' .  $vl . '%');
            $query->orWhere('description', 'LIKE', "%{$vl}%");
        })->latest()->paginate();

        return $results;
    }
}
