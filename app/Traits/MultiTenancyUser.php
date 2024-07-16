<?php

namespace App\Traits;

use App\Models\Tenant;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait MultiTenancyUser
{
    public function tenant() : BelongsTo {
        return $this->belongsTo(Tenant::class);
    }
}
