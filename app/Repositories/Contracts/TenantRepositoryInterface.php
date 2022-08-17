<?php

namespace App\Repositories\Contracts;

interface TenantRepositoryInterface
{
    public function getAllTenants(int $per_page, $name);
    public function getTenantUuid(string $uuid);
}
