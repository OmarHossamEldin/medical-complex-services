<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use HasFactory, SoftDeletes;
    public $fillable = ['name', 'fixed_price', 'timed', 'requires_doctor', 'main_consumer_number',
     'associate_consumer_number', 'variable_price_equation', 'price_type_id', 'service_type_id',
     'department_id', 'service_id', 'pc_dependent'];

     public function price_type()
     {
         return $this->belongsTo('App\Models\PriceType');
     }

     public function service_type()
     {
         return $this->belongsTo('App\Models\ServiceType');
     }

     public function department()
     {
         return $this->belongsTo('App\Models\Department');
     }

    public function transactions()
    {
        return $this->hasMany('App\Models\Transaction');
    }

    public function variable_labes()
    {
        return $this->hasMany('App\Models\VariableLabel');
    }

    public function billing_options()
    {
        return $this->belongsToMany('App\Models\BillingOption');
    }

    public function closed_intervals()
    {
        return $this->belongsToMany('App\Models\ClosedInterval');
    }

    public function financial_categories()
    {
        return $this->belongsToMany('App\Models\FinancialCategory');
    }

    public function follower_constraints()
    {
        return $this->belongsToMany('App\Models\FollowerConstraint');
    }

    public function pcs()
    {
        return $this->belongsToMany('App\Models\Pc');
    }

    public function ranks()
    {
        return $this->belongsToMany('App\Models\Rank');
    }

    public function roles()
    {
        return $this->belongsToMany('App\Models\Role');
    }

    public function stakeholders()
    {
        return $this->belongsToMany('App\Models\Stakeholder', 'service_stakeholder');
    }

    public function parent()
    {
        return $this->belongsTo('App\Models\Service', 'service_id');
    }

    public function children() {
        return $this->hasMany('App\Models\Service', 'service_id');
    }

    public static function allLevelChildren($services) {
        foreach ($services as $service) {
            if (!$service->children->isEmpty()) {
                $service->children = self::allLevelChildren($service->children);
             }
         }

         return $services;
     }
}
