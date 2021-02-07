<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class OracleMoratab extends Model
{
    protected $connection = 'oracle';
    protected $table = 'v_patient_moratab';
    
    /**
     * to Get Moratab medicine_count use this in your controller
     *  OracleMoratab::where('patient_num',$x)->count('medicine_code');
     *  $x is the patient_code you have to pass it from  your logic or systemworker 
     */
}
