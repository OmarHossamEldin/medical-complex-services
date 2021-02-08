<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => ['cors', 'json.response']], function () {

    //UnAuthenticated
    Route::group(['prefix'=>'/'],function(){
        Route::post('login', 'AuthController@login')->name('systemWorker.login');
    });

    //Authenticated
    Route::group(['middleware'=>['auth:api']],function(){
        
        Route::get('logout', 'AuthController@logout')->name('systemWorker.logout');

        // start CRUD 
        Route::get('billing-options', 'BillingOptionController@index')->name('billing-options.index')->middleware('can:viewAny,App\Models\BillingOption');
        Route::post('billing-options', 'BillingOptionController@store')->name('billing-options.store')->middleware('can:create,App\Models\BillingOption');
        Route::get('billing-options/{billing_option}', 'BillingOptionController@show')->name('billing-options.show')->middleware('can:view,App\Models\BillingOption');
        Route::put('billing-options/{billing_option}', 'BillingOptionController@update')->name('billing-options.update')->middleware('can:update,App\Models\BillingOption');
        Route::delete('billing-options/{billing_option}', 'BillingOptionController@destroy')->name('billing-options.destroy')->middleware('can:delete,App\Models\BillingOption');

        Route::get('closed-intervals', 'ClosedIntervalController@index')->name('closed-intervals.index')->middleware('can:viewAny,App\Models\ClosedInterval');
        Route::post('closed-intervals', 'ClosedIntervalController@store')->name('closed-intervals.store')->middleware('can:create,App\Models\ClosedInterval');
        Route::get('closed-intervals/{closed_interval}', 'ClosedIntervalController@show')->name('closed-intervals.show')->middleware('can:view,App\Models\ClosedInterval');
        Route::put('closed-intervals/{closed_interval}', 'ClosedIntervalController@update')->name('closed-intervals.update')->middleware('can:update,App\Models\ClosedInterval');
        Route::delete('closed-intervals/{closed_interval}', 'ClosedIntervalController@destroy')->name('closed-intervals.destroy')->middleware('can:delete,App\Models\ClosedInterval');

        Route::get('consumers', 'ConsumerController@index')->name('consumers.index')->middleware('can:viewAny,App\Models\Consumer');
        Route::post('consumers', 'ConsumerController@store')->name('consumers.store')->middleware('can:create,App\Models\Consumer');
        Route::get('consumers/{consumer}', 'ConsumerController@show')->name('consumers.show')->middleware('can:view,App\Models\Consumer');
        Route::put('consumers/{consumer}', 'ConsumerController@update')->name('consumers.update')->middleware('can:update,App\Models\Consumer');
        Route::delete('consumers/{consumer}', 'ConsumerController@destroy')->name('consumers.destroy')->middleware('can:delete,App\Models\Consumer');

        Route::get('degrees', 'DegreeController@index')->name('degrees.index')->middleware('can:viewAny,App\Models\Degree');
        Route::post('degrees', 'DegreeController@store')->name('degrees.store')->middleware('can:create,App\Models\Degree');
        Route::get('degrees/{degree}', 'DegreeController@show')->name('degrees.show')->middleware('can:view,App\Models\Degree');
        Route::put('degrees/{degree}', 'DegreeController@update')->name('degrees.update')->middleware('can:update,App\Models\Degree');
        Route::delete('degrees/{degree}', 'DegreeController@destroy')->name('degrees.destroy')->middleware('can:delete,App\Models\Degree');

        Route::get('departments', 'DepartmentController@index')->name('departments.index')->middleware('can:viewAny,App\Models\Department');
        Route::post('departments', 'DepartmentController@store')->name('departments.store')->middleware('can:create,App\Models\Department');
        Route::get('departments/{department}', 'DepartmentController@show')->name('departments.show')->middleware('can:view,App\Models\Department');
        Route::put('departments/{department}', 'DepartmentController@update')->name('departments.update')->middleware('can:update,App\Models\Department');
        Route::delete('departments/{department}', 'DepartmentController@destroy')->name('departments.destroy')->middleware('can:delete,App\Models\Department');

        Route::get('doctors', 'DoctorController@index')->name('doctors.index')->middleware('can:viewAny,App\Models\Doctor');
        Route::post('doctors', 'DoctorController@store')->name('doctors.store')->middleware('can:create,App\Models\Doctor');
        Route::get('doctors/{doctor}', 'DoctorController@show')->name('doctors.show')->middleware('can:view,App\Models\Doctor');
        Route::put('doctors/{doctor}', 'DoctorController@update')->name('doctors.update')->middleware('can:update,App\Models\Doctor');
        Route::delete('doctors/{doctor}', 'DoctorController@destroy')->name('doctors.destroy')->middleware('can:delete,App\Models\Doctor');

        Route::get('financial-categories', 'FinancialCategoryController@index')->name('financial-categories.index')->middleware('can:viewAny,App\Models\FinancialCategory');
        Route::post('financial-categories', 'FinancialCategoryController@store')->name('financial-categories.store')->middleware('can:create,App\Models\FinancialCategory');
        Route::get('financial-categories/{financial_category}', 'FinancialCategoryController@show')->name('financial-categories.show')->middleware('can:view,App\Models\FinancialCategory');
        Route::put('financial-categories/{financial_category}', 'FinancialCategoryController@update')->name('financial-categories.update')->middleware('can:update,App\Models\FinancialCategory');
        Route::delete('financial-categories/{financial_category}', 'FinancialCategoryController@destroy')->name('financial-categories.destroy')->middleware('can:delete,App\Models\FinancialCategory');

        Route::get('follower-constraints', 'FollowerConstraintController@index')->name('follower-constraints.index')->middleware('can:viewAny,App\Models\FollowerConstraint');
        Route::post('follower-constraints', 'FollowerConstraintController@store')->name('follower-constraints.store')->middleware('can:create,App\Models\FollowerConstraint');
        Route::get('follower-constraints/{follower_constraint}', 'FollowerConstraintController@show')->name('follower-constraints.show')->middleware('can:view,App\Models\FollowerConstraint');
        Route::put('follower-constraints/{follower_constraint}', 'FollowerConstraintController@update')->name('follower-constraints.update')->middleware('can:update,App\Models\FollowerConstraint');
        Route::delete('follower-constraints/{follower_constraint}', 'FollowerConstraintController@destroy')->name('follower-constraints.destroy')->middleware('can:delete,App\Models\FollowerConstraint');

        Route::get('linked-nodes', 'LinkedNodesController@index')->name('linked-nodes.index')->middleware('can:viewAny,App\Models\LinkedNodes');
        Route::post('linked-nodes', 'LinkedNodesController@store')->name('linked-nodes.store')->middleware('can:create,App\Models\LinkedNodes');
        Route::get('linked-nodes/{linked_node}', 'LinkedNodesController@show')->name('linked-nodes.show')->middleware('can:view,App\Models\LinkedNodes');
        Route::put('linked-nodes/{linked_node}', 'LinkedNodesController@update')->name('linked-nodes.update')->middleware('can:update,App\Models\LinkedNodes');
        Route::delete('linked-nodes/{linked_node}', 'LinkedNodesController@destroy')->name('linked-nodes.destroy')->middleware('can:delete,App\Models\LinkedNodes');

        Route::get('modules', 'ModuleController@index')->name('modules.index')->middleware('can:viewAny,App\Models\Module');
        Route::post('modules', 'ModuleController@store')->name('modules.store')->middleware('can:create,App\Models\Module');
        Route::get('modules/{module}', 'ModuleController@show')->name('modules.show')->middleware('can:view,App\Models\Module');
        Route::put('modules/{module}', 'ModuleController@update')->name('modules.update')->middleware('can:update,App\Models\Module');
        Route::delete('modules/{module}', 'ModuleController@destroy')->name('modules.destroy')->middleware('can:delete,App\Models\Module');

        Route::get('pcs', 'PcController@index')->name('pcs.index')->middleware('can:viewAny,App\Models\Pc');
        Route::post('pcs', 'PcController@store')->name('pcs.store')->middleware('can:create,App\Models\Pc');
        Route::get('pcs/{pc}', 'PcController@show')->name('pcs.show')->middleware('can:view,App\Models\Pc');
        Route::put('pcs/{pc}', 'PcController@update')->name('pcs.update')->middleware('can:update,App\Models\Pc');
        Route::delete('pcs/{pc}', 'PcController@destroy')->name('pcs.destroy')->middleware('can:delete,App\Models\Pc');

        Route::get('permissions', 'PermissionController@index')->name('permissions.index')->middleware('can:viewAny,App\Models\Permission');
        Route::post('permissions', 'PermissionController@store')->name('permissions.store')->middleware('can:create,App\Models\Permission');
        Route::get('permissions/{permission}', 'PermissionController@show')->name('permissions.show')->middleware('can:view,App\Models\Permission');
        Route::put('permissions/{permission}', 'PermissionController@update')->name('permissions.update')->middleware('can:update,App\Models\Permission');
        Route::delete('permissions/{permission}', 'PermissionController@destroy')->name('permissions.destroy')->middleware('can:delete,App\Models\Permission');

        Route::get('price-types', 'PriceTypeController@index')->name('price-types.index')->middleware('can:viewAny,App\Models\PriceType');
        Route::post('price-types', 'PriceTypeController@store')->name('price-types.store')->middleware('can:create,App\Models\PriceType');
        Route::get('price-types/{price_type}', 'PriceTypeController@show')->name('price-types.show')->middleware('can:view,App\Models\PriceType');
        Route::put('price-types/{price_type}', 'PriceTypeController@update')->name('price-types.update')->middleware('can:update,App\Models\PriceType');
        Route::delete('price-types/{price_type}', 'PriceTypeController@destroy')->name('price-types.destroy')->middleware('can:delete,App\Models\PriceType');

        Route::get('rank-price-variables', 'RankPriceVariableController@index')->name('rank-price-variables.index')->middleware('can:viewAny,App\Models\RankPriceVariable');
        Route::post('rank-price-variables', 'RankPriceVariableController@store')->name('rank-price-variables.store')->middleware('can:create,App\Models\RankPriceVariable');
        Route::get('rank-price-variables/{rank_price_variable}', 'RankPriceVariableController@show')->name('rank-price-variables.show')->middleware('can:view,App\Models\RankPriceVariable');
        Route::put('rank-price-variables/{rank_price_variable}', 'RankPriceVariableController@update')->name('rank-price-variables.update')->middleware('can:update,App\Models\RankPriceVariable');
        Route::delete('rank-price-variables/{rank_price_variable}', 'RankPriceVariableController@destroy')->name('rank-price-variables.destroy')->middleware('can:delete,App\Models\RankPriceVariable');

        Route::get('ranks', 'RankController@index')->name('ranks.index')->middleware('can:viewAny,App\Models\Rank');
        Route::post('ranks', 'RankController@store')->name('ranks.store')->middleware('can:create,App\Models\Rank');
        Route::get('ranks/{rank}', 'RankController@show')->name('ranks.show')->middleware('can:view,App\Models\Rank');
        Route::put('ranks/{rank}', 'RankController@update')->name('ranks.update')->middleware('can:update,App\Models\Rank');
        Route::delete('ranks/{rank}', 'RankController@destroy')->name('ranks.destroy')->middleware('can:delete,App\Models\Rank');

        Route::get('reports', 'ReportController@index')->name('reports.index')->middleware('can:viewAny,App\Models\Report');
        Route::post('reports', 'ReportController@store')->name('reports.store')->middleware('can:create,App\Models\Report');
        Route::get('reports/{report}', 'ReportController@show')->name('reports.show')->middleware('can:view,App\Models\Report');
        Route::put('reports/{report}', 'ReportController@update')->name('reports.update')->middleware('can:update,App\Models\Report');
        Route::delete('reports/{report}', 'ReportController@destroy')->name('reports.destroy')->middleware('can:delete,App\Models\Report');

        Route::get('roles', 'RoleController@index')->name('roles.index')->middleware('can:viewAny,App\Models\Role');
        Route::post('roles', 'RoleController@store')->name('roles.store')->middleware('can:create,App\Models\Role');
        Route::get('roles/{role}', 'RoleController@show')->name('roles.show')->middleware('can:view,App\Models\Role');
        Route::put('roles/{role}', 'RoleController@update')->name('roles.update')->middleware('can:update,App\Models\Role');
        Route::delete('roles/{role}', 'RoleController@destroy')->name('roles.destroy')->middleware('can:delete,App\Models\Role');

        Route::get('service-types', 'ServiceTypeController@index')->name('service-types.index')->middleware('can:viewAny,App\Models\ServiceType');
        Route::post('service-types', 'ServiceTypeController@store')->name('service-types.store')->middleware('can:create,App\Models\ServiceType');
        Route::get('service-types/{service_type}', 'ServiceTypeController@show')->name('service-types.show')->middleware('can:view,App\Models\ServiceType');
        Route::put('service-types/{service_type}', 'ServiceTypeController@update')->name('service-types.update')->middleware('can:update,App\Models\ServiceType');
        Route::delete('service-types/{service_type}', 'ServiceTypeController@destroy')->name('service-types.destroy')->middleware('can:delete,App\Models\ServiceType');

        Route::get('services', 'ServiceController@index')->name('services.index')->middleware('can:viewAny,App\Models\Service');
        Route::post('services', 'ServiceController@store')->name('services.store')->middleware('can:create,App\Models\Service');
        Route::get('services/{service}', 'ServiceController@show')->name('services.show')->middleware('can:view,App\Models\Service');
        Route::put('services/{service}', 'ServiceController@update')->name('services.update')->middleware('can:update,App\Models\Service');
        Route::delete('services/{service}', 'ServiceController@destroy')->name('services.destroy')->middleware('can:delete,App\Models\Service');

        Route::get('stakeholders', 'StakeholderController@index')->name('stakeholders.index')->middleware('can:viewAny,App\Models\Stakeholder');
        Route::post('stakeholders', 'StakeholderController@store')->name('stakeholders.store')->middleware('can:create,App\Models\Stakeholder');
        Route::get('stakeholders/{stakeholder}', 'StakeholderController@show')->name('stakeholders.show')->middleware('can:view,App\Models\Stakeholder');
        Route::put('stakeholders/{stakeholder}', 'StakeholderController@update')->name('stakeholders.update')->middleware('can:update,App\Models\Stakeholder');
        Route::delete('stakeholders/{stakeholder}', 'StakeholderController@destroy')->name('stakeholders.destroy')->middleware('can:delete,App\Models\Stakeholder');

        Route::get('system-workers', 'SystemWorkerController@index')->name('system-workers.index')->middleware('can:viewAny,App\Models\SystemWorker');
        Route::post('system-workers', 'SystemWorkerController@store')->name('system-workers.store')->middleware('can:create,App\Models\SystemWorker');
        Route::get('system-workers/{system_worker}', 'SystemWorkerController@show')->name('system-workers.show')->middleware('can:view,App\Models\SystemWorker');
        Route::put('system-workers/{system_worker}', 'SystemWorkerController@update')->name('system-workers.update')->middleware('can:update,App\Models\SystemWorker');
        Route::delete('system-workers/{system_worker}', 'SystemWorkerController@destroy')->name('system-workers.destroy')->middleware('can:delete,App\Models\SystemWorker');

        Route::get('transactions', 'TransactionController@index')->name('transactions.index')->middleware('can:viewAny,App\Models\Transaction');
        Route::post('transactions', 'TransactionController@store')->name('transactions.store')->middleware('can:create,App\Models\Transaction');
        Route::get('transactions/{transaction}', 'TransactionController@show')->name('transactions.show')->middleware('can:view,App\Models\Transaction');
        Route::put('transactions/{transaction}', 'TransactionController@update')->name('transactions.update')->middleware('can:update,App\Models\Transaction');
        Route::delete('transactions/{transaction}', 'TransactionController@destroy')->name('transactions.destroy')->middleware('can:delete,App\Models\Transaction');

        Route::get('variable-labels', 'ServiceController@index')->name('variable-labels.index')->middleware('can:viewAny,App\Models\VariableLabel');
        Route::post('variable-labels', 'ServiceController@store')->name('variable-labels.store')->middleware('can:create,App\Models\VariableLabel');
        Route::get('variable-labels/{variable_label}', 'ServiceController@show')->name('variable-labels.show')->middleware('can:view,App\Models\VariableLabel');
        Route::put('variable-labels/{variable_label}', 'ServiceController@update')->name('variable-labels.update')->middleware('can:update,App\Models\VariableLabel');
        Route::delete('variable-labels/{variable_label}', 'ServiceController@destroy')->name('variable-labels.destroy')->middleware('can:delete,App\Models\VariableLabel');
        // End CRUD

        Route::get('tree-of-services', 'ServiceController@treeOfServices')->name('treeOfServices');

        Route::get('reports/execute/{report}', 'ReportController@execute')->name('Reports.execute');

    });
});
