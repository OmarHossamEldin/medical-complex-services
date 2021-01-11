<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\Rank;
use App\Models\SystemWorker;

class RankPolicy
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
        return $systemWorker->hasAccess('index-rank');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\SystemWorker  $systemWorker
     * @param  \App\Models\Rank  $rank
     * @return mixed
     */
    public function view(SystemWorker $systemWorker, Rank $rank)
    {
        return $systemWorker->hasAccess('show-rank');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\SystemWorker  $systemWorker
     * @return mixed
     */
    public function create(SystemWorker $systemWorker)
    {
        return $systemWorker->hasAccess('create-rank'); 
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\SystemWorker  $systemWorker
     * @param  \App\Models\Rank  $rank
     * @return mixed
     */
    public function update(SystemWorker $systemWorker, Rank $rank)
    {
        return $systemWorker->hasAccess('update-rank'); 
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\SystemWorker  $systemWorker
     * @param  \App\Models\Rank  $rank
     * @return mixed
     */
    public function delete(SystemWorker $systemWorker, Rank $rank)
    {
        return $systemWorker->hasAccess('delete-rank');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\SystemWorker  $systemWorker
     * @param  \App\Models\Rank  $rank
     * @return mixed
     */
    public function restore(SystemWorker $systemWorker, Rank $rank)
    {
        return $systemWorker->hasAccess('restore-rank');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\SystemWorker  $systemWorker
     * @param  \App\Models\Rank  $rank
     * @return mixed
     */
    public function forceDelete(SystemWorker $systemWorker, Rank $rank)
    {
        return $systemWorker->hasAccess('Force-delete-rank');
    }
}
