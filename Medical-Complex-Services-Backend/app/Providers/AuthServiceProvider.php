<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Models\BllingOption' => 'App\Policies\BillingOptionPolicy',
        'App\Models\ClosedInterval' => 'App\Policies\ClosedIntervalPolicy',
        'App\Models\Consumer' => 'App\Policies\ConsumerPolicy',
        'App\Models\Degree' => 'App\Policies\DegreePolicy',
        'App\Models\Department' => 'App\Policies\DepartmentPolicy',
        'App\Models\Doctor' => 'App\Policies\DoctorPolicy',
        'App\Models\FinancialCategory' => 'App\Policies\FinancialCategoryPolicy',
        'App\Models\FollowerConstraint' => 'App\Policies\FollowerConstraintPolicy',
        'App\Models\LinkedNodes' => 'App\Policies\LinkedNodesPolicy',
        'App\Models\Module' => 'App\Policies\ModulePolicy',
        'App\Models\Pc' => 'App\Policies\PcPolicy',
        'App\Models\Permission' => 'App\Policies\PermissionPolicy',
        'App\Models\PriceType' => 'App\Policies\PriceTypePolicy',
        'App\Models\Rank' => 'App\Policies\RankPolicy',
        'App\Models\RankPriceVariable' => 'App\Policies\RankPriceVariablePolicy',
        'App\Models\Role' => 'App\Policies\RolePolicy',
        'App\Models\Service' => 'App\Policies\ServicePolicy',
        'App\Models\ServiceType' => 'App\Policies\ServiceTypePolicy',
        'App\Models\Stakeholder' => 'App\Policies\StakeholderPolicy',
        'App\Models\SystemWorker' => 'App\Policies\SystemWorkerPolicy',
        'App\Models\Transaction' => 'App\Policies\TransactionPolicy',
        'App\Models\VariableLabel' => 'App\Policies\VariableLabelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
