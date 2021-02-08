<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\SystemWorker;

class ConsumerPolicy
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
        return $systemWorker->hasAccess('index-consumer') || $systemWorker->hasAccess('control');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\SystemWorker  $systemWorker
     * @param  \App\Models\Consumer  $consumer
     * @return mixed
     */
    public function view(SystemWorker $systemWorker)
    {
        return $systemWorker->hasAccess('index-consumer') || $systemWorker->hasAccess('control');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\SystemWorker  $systemWorker
     * @return mixed
     */
    public function create(SystemWorker $systemWorker)
    {
        return $systemWorker->hasAccess('show-consumer') || $systemWorker->hasAccess('control');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\SystemWorker  $systemWorker
     * @param  \App\Models\Consumer  $consumer
     * @return mixed
     */
    public function update(SystemWorker $systemWorker)
    {
        return $systemWorker->hasAccess('update-consumer');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\SystemWorker  $systemWorker
     * @param  \App\Models\Consumer  $consumer
     * @return mixed
     */
    public function delete(SystemWorker $systemWorker)
    {
        return $systemWorker->hasAccess('delete-consumer') || $systemWorker->hasAccess('control');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\SystemWorker  $systemWorker
     * @param  \App\Models\Consumer  $consumer
     * @return mixed
     */
    public function restore(SystemWorker $systemWorker)
    {
        return $systemWorker->hasAccess('restore-consumer') || $systemWorker->hasAccess('control');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\SystemWorker  $systemWorker
     * @param  \App\Models\Consumer  $consumer
     * @return mixed
     */
    public function forceDelete(SystemWorker $systemWorker)
    {
        return $systemWorker->hasAccess('Force-delete-consumer') || $systemWorker->hasAccess('control');
    }
}
