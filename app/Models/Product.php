<?php

namespace App\Models;

use App\Tenant\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Product extends Model
{
    use HasFactory, TenantTrait;

    protected $fillable = ['title', 'flag', 'price', 'description', 'image'];

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


    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * Categories not linked with this product
     */
    public function categoriesAvailable($filter = null)
    {

        $categories = Category::whereNotIn('categories.id', function ($query) {
            $query->select('category_product.category_id');
            $query->from('category_product');
            $query->whereRaw("category_product.product_id={$this->id}");
        })
            ->when($filter, function ($query, $vl) {
                $query->where('categories.name', 'LIKE', "%{$vl}%");
            })->paginate();

        return $categories;
    }


    public function search($filter = null)
    {

        $results = $this->when($filter, function ($query, $vl) {
            $query->where('title', 'LIKE', '%' .  $vl . '%');
            $query->orWhere('description', 'LIKE', "%{$vl}%");
        })->latest()->paginate();

        return $results;
    }
}
