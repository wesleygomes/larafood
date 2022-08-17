<?php

namespace App\Services;


use Illuminate\Support\Str;
use App\Models\Plan;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\TenantRepository;

class CategoryService
{
    private $repository, $tenantRepository;

    public function __construct(CategoryRepositoryInterface $repository, TenantRepository $tenantRepository)
    {
        $this->repository = $repository;
        $this->tenantRepository = $tenantRepository;
    }


    public function getCategoriesByTenant(string $uuid)
    {
        $tenant = $this->tenantRepository->getTenantUuid($uuid);

        return $this->repository->getCategoriesByTenantId($tenant->id);
    }
}
