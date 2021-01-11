<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\Module;
use App\Models\SystemWorker;

class ModulePolicy
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
        return $systemWorker->hasAccess('index-Module');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\SystemWorker  $systemWorker
     * @param  \App\Models\Module  $module
     * @return mixed
     */
    public function view(SystemWorker $systemWorker, Module $module)
    {
        return $systemWorker->hasAccess('show-Module');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\SystemWorker  $systemWorker
     * @return mixed
     */
    public function create(SystemWorker $systemWorker)
    {
        return $systemWorker->hasAccess('create-Module');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\SystemWorker  $systemWorker
     * @param  \App\Models\Module  $module
     * @return mixed
     */
    public function update(SystemWorker $systemWorker, Module $module)
    {
        return $systemWorker->hasAccess('update-Module');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\SystemWorker  $systemWorker
     * @param  \App\Models\Module  $module
     * @return mixed
     */
    public function delete(SystemWorker $systemWorker, Module $module)
    {
        return $systemWorker->hasAccess('delete-Module');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\SystemWorker  $systemWorker
     * @param  \App\Models\Module  $module
     * @return mixed
     */
    public function restore(SystemWorker $systemWorker, Module $module)
    {
        return $systemWorker->hasAccess('restore-Module');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\SystemWorker  $systemWorker
     * @param  \App\Models\Module  $module
     * @return mixed
     */
    public function forceDelete(SystemWorker $systemWorker, Module $module)
    {
        return $systemWorker->hasAccess('Force-delete-Module');
    }
}
