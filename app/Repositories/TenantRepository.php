<?php


namespace App\Repositories;

use App\Models\Tenant;
use App\Repositories\Contracts\TenantRepositoryInterface;

class TenantRepository implements TenantRepositoryInterface
{
    protected $entity;

    public function __construct(Tenant $tenant)
    {
        $this->entity = $tenant;
    }

    public function getAllTenants(int $per_page, $name)
    {
        if (!empty($name)) {
            return $this->entity
                ->where('name', $name)
                ->paginate($per_page);
        }
        return $this->entity->paginate($per_page);
    }

    public function getTenantUuid(string $uuid)
    {
        return $this->entity->where('uuid', $uuid)->first();
    }
}
