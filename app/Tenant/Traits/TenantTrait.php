<?php

namespace App\Tenant\Traits;

use App\Tenant\Observers\TenantObserver;
use App\Tenant\Scopes\TenantScope;

trait TenantTrait
{
    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        parent::boot();

        static::observe(TenantObserver::class);

        static::addGlobalScope(new TenantScope);
    }
}