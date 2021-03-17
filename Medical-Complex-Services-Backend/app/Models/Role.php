<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Role extends Model
{
    use HasFactory, SoftDeletes;
    public $fillable = ['name'];

    protected $appends = ['permissions']; 
    
    public function permissions()
    {
        return $this->belongsToMany('App\Models\Permission');
    }

    public function services()
    {
        return $this->belongsToMany('App\Models\Service', 'role_service');
    }

    public function getPermissionsAttribute(){
        return $this->permissions()->get();
    }
}
