<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\PriceType;
use App\Models\SystemWorker;

class PriceTypePolicy
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
        return $systemWorker->hasAccess('index-priceType');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\SystemWorker  $systemWorker
     * @param  \App\Models\PriceType  $priceType
     * @return mixed
     */
    public function view(SystemWorker $systemWorker, PriceType $priceType)
    {
        return $systemWorker->hasAccess('show-priceType');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\SystemWorker  $systemWorker
     * @return mixed
     */
    public function create(SystemWorker $systemWorker)
    {
        return $systemWorker->hasAccess('create-priceType');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\SystemWorker  $systemWorker
     * @param  \App\Models\PriceType  $priceType
     * @return mixed
     */
    public function update(SystemWorker $systemWorker, PriceType $priceType)
    {
        return $systemWorker->hasAccess('update-priceType');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\SystemWorker  $systemWorker
     * @param  \App\Models\PriceType  $priceType
     * @return mixed
     */
    public function delete(SystemWorker $systemWorker, PriceType $priceType)
    {
        return $systemWorker->hasAccess('delete-priceType');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\SystemWorker  $systemWorker
     * @param  \App\Models\PriceType  $priceType
     * @return mixed
     */
    public function restore(SystemWorker $systemWorker, PriceType $priceType)
    {
        return $systemWorker->hasAccess('restore-priceType');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\SystemWorker  $systemWorker
     * @param  \App\Models\PriceType  $priceType
     * @return mixed
     */
    public function forceDelete(SystemWorker $systemWorker, PriceType $priceType)
    {
        return $systemWorker->hasAccess('Force-delete-priceType');
    }
}
