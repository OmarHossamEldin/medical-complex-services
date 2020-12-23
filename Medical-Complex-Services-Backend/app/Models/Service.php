<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
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
         return $this->belongsTo('App\Models\Departments');
     }

    public function transactions()
    {
        return $this->hasMany('App\Models\Transaction');
    }

    public function variable_labes()
    {
        return $this->hasMany('App\Models\VariableLabel');
    }


}
