<?php


namespace App\Repositories;

use App\Models\Category;
use App\Repositories\Contracts\CategoryRepositoryInterface;

class CategoryRepository implements CategoryRepositoryInterface
{
    protected $entity;

    public function __construct(Category $category)
    {
        $this->entity = $category;
    }

    public function getCategoriesByTenantUuid($uuid)
    {
        return $this->entity
            ->join('tenants', 'tenants.id', '=', 'categories.tenant_id')
            ->where('tenants.uuid', $uuid)
            ->select('categories.*')
            ->get();
    }

    public function getCategoriesByTenantId(int $idTenant)
    {
        return $this->entity->where('tenant_id', $idTenant)->get();
    }

    public function getCategoriesByUuid(string $uuid)
    {
        return $this->entity->where('uuid', $uuid)->first();
    }
}
