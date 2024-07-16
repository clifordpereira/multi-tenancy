<?php

namespace App;

use App\Models\Tenant;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/** 
 * to be used by User model
 */
trait MultiTenancyUser
{
    public function tenant() : BelongsTo {
        return $this->belongsTo(Tenant::class);
    }
}
