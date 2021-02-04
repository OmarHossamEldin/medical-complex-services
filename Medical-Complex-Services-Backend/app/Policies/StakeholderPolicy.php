<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\Stakeholder;
use App\Models\SystemWorker;

class StakeholderPolicy
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
        return $systemWorker->hasAccess('index-stakeholder') || $systemWorker->hasAccess('control');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\SystemWorker  $systemWorker
     * @param  \App\Models\Stakeholder  $stakeholder
     * @return mixed
     */
    public function view(SystemWorker $systemWorker, Stakeholder $stakeholder)
    {
        return $systemWorker->hasAccess('show-stakeholder') || $systemWorker->hasAccess('control');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\SystemWorker  $systemWorker
     * @return mixed
     */
    public function create(SystemWorker $systemWorker)
    {
        return $systemWorker->hasAccess('create-stakeholder') || $systemWorker->hasAccess('control');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\SystemWorker  $systemWorker
     * @param  \App\Models\Stakeholder  $stakeholder
     * @return mixed
     */
    public function update(SystemWorker $systemWorker, Stakeholder $stakeholder)
    {
        return $systemWorker->hasAccess('update-stakeholder') || $systemWorker->hasAccess('control');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\SystemWorker  $systemWorker
     * @param  \App\Models\Stakeholder  $stakeholder
     * @return mixed
     */
    public function delete(SystemWorker $systemWorker, Stakeholder $stakeholder)
    {
        return $systemWorker->hasAccess('delete-stakeholder') || $systemWorker->hasAccess('control');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\SystemWorker  $systemWorker
     * @param  \App\Models\Stakeholder  $stakeholder
     * @return mixed
     */
    public function restore(SystemWorker $systemWorker, Stakeholder $stakeholder)
    {
        return $systemWorker->hasAccess('restore-stakeholder') || $systemWorker->hasAccess('control');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\SystemWorker  $systemWorker
     * @param  \App\Models\Stakeholder  $stakeholder
     * @return mixed
     */
    public function forceDelete(SystemWorker $systemWorker, Stakeholder $stakeholder)
    {
        return $systemWorker->hasAccess('Force-delete-stakeholder') || $systemWorker->hasAccess('control');
    }
}
