<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\LinkedNodes;
use App\Models\SystemWorker;

class LinkedNodesPolicy
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
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\SystemWorker  $systemWorker
     * @param  \App\Models\LinkedNodes  $linkedNodes
     * @return mixed
     */
    public function view(SystemWorker $systemWorker, LinkedNodes $linkedNodes)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\SystemWorker  $systemWorker
     * @return mixed
     */
    public function create(SystemWorker $systemWorker)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\SystemWorker  $systemWorker
     * @param  \App\Models\LinkedNodes  $linkedNodes
     * @return mixed
     */
    public function update(SystemWorker $systemWorker, LinkedNodes $linkedNodes)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\SystemWorker  $systemWorker
     * @param  \App\Models\LinkedNodes  $linkedNodes
     * @return mixed
     */
    public function delete(SystemWorker $systemWorker, LinkedNodes $linkedNodes)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\SystemWorker  $systemWorker
     * @param  \App\Models\LinkedNodes  $linkedNodes
     * @return mixed
     */
    public function restore(SystemWorker $systemWorker, LinkedNodes $linkedNodes)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\SystemWorker  $systemWorker
     * @param  \App\Models\LinkedNodes  $linkedNodes
     * @return mixed
     */
    public function forceDelete(SystemWorker $systemWorker, LinkedNodes $linkedNodes)
    {
        //
    }
}