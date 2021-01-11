<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\VariableLabel;
use App\Models\SystemWorker;

class VariableLabelPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\SystemWorker  $systemWorker
     * @return mixed
     */
    public function viewAny(SystemWorker $systemW        return $systemWorker->hasAccess('index-variableLabel');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\SystemWorker  $systemWorker
     * @param  \App\Models\VariableLabel  $variableLabel
     * @return mixed
     */
    public function view(SystemWorker $systemWorker, VariableLabel $variableLabel)
    {
        return $systemWorker->hasAccess('show-variableLabel');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\SystemWorker  $systemWorker
     * @return mixed
     */
    public function create(SystemWorker $systemWorker)
    {
        return $systemWorker->hasAccess('create-variableLabel');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\SystemWorker  $systemWorker
     * @param  \App\Models\VariableLabel  $variableLabel
     * @return mixed
     */
    public function update(SystemWorker $systemWorker, VariableLabel $variableLabel)
    {
        return $systemWorker->hasAccess('update-variableLabel');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\SystemWorker  $systemWorker
     * @param  \App\Models\VariableLabel  $variableLabel
     * @return mixed
     */
    public function delete(SystemWorker $systemWorker, VariableLabel $variableLabel)
    {
        return $systemWorker->hasAccess('delete-variableLabel');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\SystemWorker  $systemWorker
     * @param  \App\Models\VariableLabel  $variableLabel
     * @return mixed
     */
    public function restore(SystemWorker $systemWorker, VariableLabel $variableLabel)
    {
        return $systemWorker->hasAccess('restore-variableLabel');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\SystemWorker  $systemWorker
     * @param  \App\Models\VariableLabel  $variableLabel
     * @return mixed
     */
    public function forceDelete(SystemWorker $systemWorker, VariableLabel $variableLabel)
    {
        return $systemWorker->hasAccess('Force-delete-variableLabel');
    }
}
