<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\Service;
use App\Models\SystemWorker;

class ServicePolicy
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
        return $systemWorker->hasAccess('index-service');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\SystemWorker  $systemWorker
     * @param  \App\Models\Service  $service
     * @return mixed
     */
    public function view(SystemWorker $systemWorker, Service $service)
    {
        return $systemWorker->hasAccess('show-service');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\SystemWorker  $systemWorker
     * @return mixed
     */
    public function create(SystemWorker $systemWorker)
    {
        return $systemWorker->hasAccess('create-service');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\SystemWorker  $systemWorker
     * @param  \App\Models\Service  $service
     * @return mixed
     */
    public function update(SystemWorker $systemWorker, Service $service)
    {
        return $systemWorker->hasAccess('update-service');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\SystemWorker  $systemWorker
     * @param  \App\Models\Service  $service
     * @return mixed
     */
    public function delete(SystemWorker $systemWorker, Service $service)
    {
        return $systemWorker->hasAccess('delete-service');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\SystemWorker  $systemWorker
     * @param  \App\Models\Service  $service
     * @return mixed
     */
    public function restore(SystemWorker $systemWorker, Service $service)
    {
        return $systemWorker->hasAccess('restore-service');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\SystemWorker  $systemWorker
     * @param  \App\Models\Service  $service
     * @return mixed
     */
    public function forceDelete(SystemWorker $systemWorker, Service $service)
    {
        return $systemWorker->hasAccess('Force-delete-service');
    }
}
