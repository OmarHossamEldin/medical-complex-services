<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\FollowerConstraint;
use App\Models\SystemWorker;

class FollowerConstraintPolicy
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
        return $systemWorker->hasAccess('index-FollowerConstraint');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\SystemWorker  $systemWorker
     * @param  \App\Models\FollowerConstraint  $followerConstraint
     * @return mixed
     */
    public function view(SystemWorker $systemWorker, FollowerConstraint $followerConstraint)
    {
        return $systemWorker->hasAccess('show-FollowerConstraint');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\SystemWorker  $systemWorker
     * @return mixed
     */
    public function create(SystemWorker $systemWorker)
    {
        return $systemWorker->hasAccess('create-FollowerConstraint');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\SystemWorker  $systemWorker
     * @param  \App\Models\FollowerConstraint  $followerConstraint
     * @return mixed
     */
    public function update(SystemWorker $systemWorker, FollowerConstraint $followerConstraint)
    {
        return $systemWorker->hasAccess('update-FollowerConstraint');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\SystemWorker  $systemWorker
     * @param  \App\Models\FollowerConstraint  $followerConstraint
     * @return mixed
     */
    public function delete(SystemWorker $systemWorker, FollowerConstraint $followerConstraint)
    {
        return $systemWorker->hasAccess('delete-FollowerConstraint');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\SystemWorker  $systemWorker
     * @param  \App\Models\FollowerConstraint  $followerConstraint
     * @return mixed
     */
    public function restore(SystemWorker $systemWorker, FollowerConstraint $followerConstraint)
    {
        return $systemWorker->hasAccess('restore-FollowerConstraint');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\SystemWorker  $systemWorker
     * @param  \App\Models\FollowerConstraint  $followerConstraint
     * @return mixed
     */
    public function forceDelete(SystemWorker $systemWorker, FollowerConstraint $followerConstraint)
    {
        return $systemWorker->hasAccess('Force-delete-FollowerConstraint');
    }
}
