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
        'App\Models\Report' => 'App\Policies\ReportPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::resource('billing-options', BillingOptionPolicy::class);

        Gate::resource('consumers', ConsumerPolicy::class);

        Gate::resource('closed-intervals', ClosedIntervalPolicy::class);

        Gate::resource('doctors', DoctorPolicy::class);

        Gate::resource('degrees', DegreePolicy::class);

        Gate::resource('departments', DepartmentPolicy::class);

        Gate::resource('financial-categories', FinancialCategoryPolicy::class);
        
        Gate::resource('follower-constraints', FollowerConstraintPolicy::class);

        Gate::resource('linked-nodes', LinkedNodesPolicy::class);
        
        Gate::resource('modules', ModulePolicy::class);

        Gate::resource('pcs', PcPolicy::class);
        
        Gate::resource('permissions', PermissionPolicy::class);

        Gate::resource('price-types', PriceTypePolicy::class);

        Gate::resource('ranks', RankPolicy::class);
        
        Gate::resource('roles', RolePolicy::class);

        Gate::resource('rank-price-variables', RankPriceVariablePolicy::class);

        Gate::resource('stakeholders', StakeholderPolicy::class);

        Gate::resource('system-workers', SystemWorkerPolicy::class);
        
        Gate::resource('services', ServicePolicy::class);

        Gate::resource('service-types', ServicePolicy::class);

        Gate::resource('transactions', ServicePolicy::class);

        Gate::resource('variable-labels', ServicePolicy::class);

        Gate::resource('reports',ReportPolicy::class);
        
    }
}
