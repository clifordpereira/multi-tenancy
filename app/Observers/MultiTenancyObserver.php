<?php

namespace App\Observers;

use Illuminate\Database\Eloquent\Model;

/**
 * to be used in models that need multi-tenancy
 * use the below line on top of the model class defenition
 * #[ObservedBy([MultiTenancyObserver::class])]
 */
class MultiTenancyObserver
{
    public function creating(Model $model): void
    {
        if (auth()->hasUser()) {
            $model->tenant_id = auth()->user()->tenant_id;
            // or with a `tenant` relationship defined:
            // $model->tenant()->associate(auth()->user()->tenant);
        }
    }
}
