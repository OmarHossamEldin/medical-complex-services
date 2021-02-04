<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\BillingOption;
use App\Models\SystemWorker;

class BillingOptionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\SystemWorker  $systemWorker
     * @return mixed
     */
    public function viewAny(SystemWorker $systemWorker)
    {
        return $systemWorker->hasAccess('index-billingOption') || $systemWorker->hasAccess('control');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\SystemWorker  $systemWorker
     * @param  \App\Models\BillingOption  $billingOption
     * @return mixed
     */
    public function view(SystemWorker $systemWorker, BillingOption $billingOption)
    {
        return $systemWorker->hasAccess('show-billingOption') || $systemWorker->hasAccess('control');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\SystemWorker  $systemWorker
     * @return mixed
     */
    public function create(SystemWorker $systemWorker)
    {
        return $systemWorker->hasAccess('create-billingOption') || $systemWorker->hasAccess('control');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\SystemWorker  $systemWorker
     * @param  \App\Models\BillingOption  $billingOption
     * @return mixed
     */
    public function update(SystemWorker $systemWorker, BillingOption $billingOption)
    {
        return $systemWorker->hasAccess('update-billingOption') || $systemWorker->hasAccess('control');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\SystemWorker  $systemWorker
     * @param  \App\Models\BillingOption  $billingOption
     * @return mixed
     */
    public function delete(SystemWorker $systemWorker, BillingOption $billingOption)
    {
        return $systemWorker->hasAccess('delete-billingOption') || $systemWorker->hasAccess('control');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\SystemWorker  $systemWorker
     * @param  \App\Models\BillingOption  $billingOption
     * @return mixed
     */
    public function restore(SystemWorker $systemWorker, BillingOption $billingOption)
    {
        return $systemWorker->hasAccess('restore-billingOption') || $systemWorker->hasAccess('control');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\SystemWorker  $systemWorker
     * @param  \App\Models\BillingOption  $billingOption
     * @return mixed
     */
    public function forceDelete(SystemWorker $systemWorker, BillingOption $billingOption)
    {
        return $systemWorker->hasAccess('Force-delete-billingOption') || $systemWorker->hasAccess('control');
    }
}
