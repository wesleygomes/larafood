<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description'
    ];

    public function search($filter = null)
    {

        $results = $this->when($filter, function ($query, $vl) {
            $query->where('name', 'LIKE', '%' .  $vl . '%');
            $query->orWhere('description', 'LIKE', "%{$vl}%");
        })->paginate();

        return $results;
    }

    /**
     * Get Profile
     */
    public function profiles()
    {
        return $this->belongsToMany(Profile::class);
    }
}
