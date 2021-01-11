<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\Department;
use App\Models\SystemWorker;

class DepartmentPolicy
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
        return $systemWorker->hasAccess('index-department');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\SystemWorker  $systemWorker
     * @param  \App\Models\Department  $department
     * @return mixed
     */
    public function view(SystemWorker $systemWorker, Department $department)
    {
        return $systemWorker->hasAccess('show-department');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\SystemWorker  $systemWorker
     * @return mixed
     */
    public function create(SystemWorker $systemWorker)
    {
        return $systemWorker->hasAccess('create-department');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\SystemWorker  $systemWorker
     * @param  \App\Models\Department  $department
     * @return mixed
     */
    public function update(SystemWorker $systemWorker, Department $department)
    {
        return $systemWorker->hasAccess('update-department');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\SystemWorker  $systemWorker
     * @param  \App\Models\Department  $department
     * @return mixed
     */
    public function delete(SystemWorker $systemWorker, Department $department)
    {
        return $systemWorker->hasAccess('delete-department');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\SystemWorker  $systemWorker
     * @param  \App\Models\Department  $department
     * @return mixed
     */
    public function restore(SystemWorker $systemWorker, Department $department)
    {
        return $systemWorker->hasAccess('restore-department');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\SystemWorker  $systemWorker
     * @param  \App\Models\Department  $department
     * @return mixed
     */
    public function forceDelete(SystemWorker $systemWorker, Department $department)
    {
        return $systemWorker->hasAccess('Force-delete-department');
    }
}
