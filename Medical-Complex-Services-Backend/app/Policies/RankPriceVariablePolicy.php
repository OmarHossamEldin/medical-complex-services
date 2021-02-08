<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\SystemWorker;

class RankPriceVariablePolicy
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
        return $systemWorker->hasAccess('index-rankPriceVariable') || $systemWorker->hasAccess('control');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\SystemWorker  $systemWorker
     * @param  \App\Models\RankPriceVariable  $rankPriceVariable
     * @return mixed
     */
    public function view(SystemWorker $systemWorker)
    {
        return $systemWorker->hasAccess('show-rankPriceVariable') || $systemWorker->hasAccess('control');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\SystemWorker  $systemWorker
     * @return mixed
     */
    public function create(SystemWorker $systemWorker)
    {
        return $systemWorker->hasAccess('create-rankPriceVariable') || $systemWorker->hasAccess('control');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\SystemWorker  $systemWorker
     * @param  \App\Models\RankPriceVariable  $rankPriceVariable
     * @return mixed
     */
    public function update(SystemWorker $systemWorker)
    {
        return $systemWorker->hasAccess('update-rankPriceVariable') || $systemWorker->hasAccess('control');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\SystemWorker  $systemWorker
     * @param  \App\Models\RankPriceVariable  $rankPriceVariable
     * @return mixed
     */
    public function delete(SystemWorker $systemWorker)
    {
        return $systemWorker->hasAccess('delete-rankPriceVariable') || $systemWorker->hasAccess('control');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\SystemWorker  $systemWorker
     * @param  \App\Models\RankPriceVariable  $rankPriceVariable
     * @return mixed
     */
    public function restore(SystemWorker $systemWorker)
    {
        return $systemWorker->hasAccess('restore-rankPriceVariable') || $systemWorker->hasAccess('control');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\SystemWorker  $systemWorker
     * @param  \App\Models\RankPriceVariable  $rankPriceVariable
     * @return mixed
     */
    public function forceDelete(SystemWorker $systemWorker)
    {
        return $systemWorker->hasAccess('Force-delete-rankPriceVariable') || $systemWorker->hasAccess('control');
    }
}
