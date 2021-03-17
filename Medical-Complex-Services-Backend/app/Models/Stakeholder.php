<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Stakeholder extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'wallet', 'patient_code', 'barcode', 'rank_id', 'stakeholder_id'];

    public function rank()
    {
        return $this->belongsTo('App\Models\Rank');
    }

    public function parent()
    {
        return $this->hasOne('App\Models\Stakeholder', 'stakeholder_id', 'id');
    }

    public function services()
    {
        return $this->belongsToMany('App\Models\Service', 'service_stakeholder');
    }
    /**
     * barcode generator for the stakeholders
     * @return string $this->barcode;
    */
    public function BarcodeGenerator(){
        $this->barcode = "KQ-".Str::uuid(); 
        $this->save();
        return $this->barcode;
    }
}
