<?php

namespace App\Repositories\Contracts;

interface TenantRepositoryInterface
{
    public function getAllTenants();
    public function getTenantUuid(string $uuid);
}
