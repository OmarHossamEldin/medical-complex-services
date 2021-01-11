<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\Permission;
use App\Models\SystemWorker;

class PermissionPolicy
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
        return $systemWorker->hasAccess('index-permission');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\SystemWorker  $systemWorker
     * @param  \App\Models\Permission  $permission
     * @return mixed
     */
    public function view(SystemWorker $systemWorker, Permission $permission)
    {
        return $systemWorker->hasAccess('show-permission');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\SystemWorker  $systemWorker
     * @return mixed
     */
    public function create(SystemWorker $systemWorker)
    {
        return $systemWorker->hasAccess('create-permission');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\SystemWorker  $systemWorker
     * @param  \App\Models\Permission  $permission
     * @return mixed
     */
    public function update(SystemWorker $systemWorker, Permission $permission)
    {
        return $systemWorker->hasAccess('update-permission');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\SystemWorker  $systemWorker
     * @param  \App\Models\Permission  $permission
     * @return mixed
     */
    public function delete(SystemWorker $systemWorker, Permission $permission)
    {
        return $systemWorker->hasAccess('delete-permission');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\SystemWorker  $systemWorker
     * @param  \App\Models\Permission  $permission
     * @return mixed
     */
    public function restore(SystemWorker $systemWorker, Permission $permission)
    {
        return $systemWorker->hasAccess('restore-permission');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\SystemWorker  $systemWorker
     * @param  \App\Models\Permission  $permission
     * @return mixed
     */
    public function forceDelete(SystemWorker $systemWorker, Permission $permission)
    {
        return $systemWorker->hasAccess('Force-delete-permission');
    }
}
