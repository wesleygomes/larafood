<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'url',
        'price',
        'description'
    ];

    //protected $dateFormat = 'd-m-Y H:i:s';

    public function details()
    {
        return $this->hasMany(DetailPlan::class);
    }

    public function profiles()
    {
        return $this->belongsToMany(Profile::class);
    }

    public function search($filter = null)
    {

        $results = $this->when($filter, function ($query, $vl) {
            $query->where('name', 'LIKE', '%' .  $vl . '%');
            $query->orWhere('description', 'LIKE', "%{$vl}%");
        })->paginate();

        return $results;
    }


    /**
     * Profiles not linked with this plan
     */
    public function profilesAvailable($filter = null)
    {

        $profiles = Profile::whereNotIn('profiles.id', function ($query) {
            $query->select('plan_profile.profile_id');
            $query->from('plan_profile');
            $query->whereRaw("plan_profile.plan_id={$this->id}");
        })
            ->when($filter, function ($query, $vl) {
                $query->where('profiles.name', 'LIKE', "%{$vl}%");
            })->paginate();

        return $profiles;
    }
    
}
