<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OraclePatient extends Model
{
    protected $connection = 'oracle';
    protected $table = 'v_person_patient';

    public function fullName(){
        return "{$this->person_name} {$this->father_name} {$this->grandfather_name} {$this->family_name}";
    }

    public function patientCode(){
        return $this->patient_num;
    }
    
    public function nationalId(){
        return $this->national_code;
    }
}
