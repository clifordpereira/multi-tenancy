<?php

namespace App;

use App\Models\Tenant;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * to be used by models that needs multi-tenancy
 */
trait MultiTenancy
{
    protected static function booted(): void
    {
        static::addGlobalScope('tenant', function (Builder $query) {
            if (auth()->hasUser()) {
                $query->where('tenant_id', auth()->user()->tenant_id);
                // or with a `tenant` relationship defined:
                // $query->whereBelongsTo(auth()->user()->tenant);
            }
        });
    }

    public function tenant() : BelongsTo {
        return $this->belongsTo(Tenant::class);
    }
}
