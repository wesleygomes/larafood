<?php

namespace App\Services;


use Illuminate\Support\Str;
use App\Models\Plan;

class TenantService
{
    public function make(Plan $plan, array $data)
    {
        $this->plan = $plan;
        $this->data = $data;

        $tenant = $this->storeTenant();

        $user = $this->storeUser($tenant);

        return $user;
    }

    public function storeTenant()
    {
        $data = $this->data;

        return $this->plan->tenants()->create([
            'cnpj' => $data['cnpj'],
            'name' => $data['empresa'],
            'email' => $data['email'],
            'url' => Str::slug($data['empresa']),
            'subscription' => now(),
            'expires_at' => now()->addDays(7),
        ]);
    }

    public function storeUser($tenant)
    {
        $user = $tenant->users()->create([
            'name' => $this->data['name'],
            'email' => $this->data['email'],
            'password' => bcrypt($this->data['password']),
        ]);

        return $user;
    }
}
