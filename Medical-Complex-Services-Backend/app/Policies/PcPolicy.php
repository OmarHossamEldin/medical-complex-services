<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\Pc;
use App\Models\SystemWorker;

class PcPolicy
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
        return $systemWorker->hasAccess('index-Pc') || $systemWorker->hasAccess('control');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\SystemWorker  $systemWorker
     * @param  \App\Models\Pc  $pc
     * @return mixed
     */
    public function view(SystemWorker $systemWorker, Pc $pc)
    {
        return $systemWorker->hasAccess('show-pc') || $systemWorker->hasAccess('control');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\SystemWorker  $systemWorker
     * @return mixed
     */
    public function create(SystemWorker $systemWorker)
    {
        return $systemWorker->hasAccess('create-pc') || $systemWorker->hasAccess('control');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\SystemWorker  $systemWorker
     * @param  \App\Models\Pc  $pc
     * @return mixed
     */
    public function update(SystemWorker $systemWorker, Pc $pc)
    {
        return $systemWorker->hasAccess('update-pc') || $systemWorker->hasAccess('control');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\SystemWorker  $systemWorker
     * @param  \App\Models\Pc  $pc
     * @return mixed
     */
    public function delete(SystemWorker $systemWorker, Pc $pc)
    {
        return $systemWorker->hasAccess('delete-pc') || $systemWorker->hasAccess('control');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\SystemWorker  $systemWorker
     * @param  \App\Models\Pc  $pc
     * @return mixed
     */
    public function restore(SystemWorker $systemWorker, Pc $pc)
    {
        return $systemWorker->hasAccess('restore-pc') || $systemWorker->hasAccess('control');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\SystemWorker  $systemWorker
     * @param  \App\Models\Pc  $pc
     * @return mixed
     */
    public function forceDelete(SystemWorker $systemWorker, Pc $pc)
    {
        return $systemWorker->hasAccess('Force-delete-pc') || $systemWorker->hasAccess('control');
    }
}
