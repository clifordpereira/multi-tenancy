<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tenant extends Model
{
    use HasFactory;

    protected $fillable = [
        'marketer_id',
        'name',
        'district',
        'place',
        'address',
        'phone',
        'pincode',
        'latitude',
        'longitude',
        'visibility',
        'subscription_status'
    ];

    public function marketer()
    {
        return $this->belongsTo(User::class, 'marketer_id');
    }

    public function tenantAdmins() : HasMany {
        return $this->hasMany(User::class, 'tenant_id');
    }
}
