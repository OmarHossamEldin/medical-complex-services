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

        Route::get('reports/execute/{report}', 'ReportController@execute');
    });

    //Authenticated
    Route::group(['middleware'=>['auth:api']],function(){

        Route::apiResources([
            'billing-options' => 'BillingOptionController',
            'consumers' => 'ConsumerController',
            'closed-intervals' => 'ClosedIntervalController',
            'doctors' => 'DoctorController',
            'degrees' => 'DegreeController',
            'departments' => 'DepartmentController',
            'financial-categories' => 'FinancialCategoryController',
            'follower-constraints' => 'FollowerConstraintController',
            'linked-nodes' => 'LinkedNodesController',
            'modules' => 'ModuleController',
            'pcs' => 'PcController',
            'permissions' => 'PermissionController',
            'price-types' => 'PriceTypeController',
            'ranks' => 'RankController',
            'roles' => 'RoleController',
            'rank-price-variables' => 'RankPriceVariableController',
            'stakeholders' => 'StakeholderController',
            'system-workers' => 'SystemWorkerController',
            'services' => 'ServiceController',
            'service-types' => 'ServiceTypeController',
            'transactions' => 'TransactionController',
            'variable-labels' => 'VariableLabelController',
            'reports' => 'ReportController',
        ]);
        Route::get('tree-of-services', 'ServiceController@treeOfServices');
    });
});
