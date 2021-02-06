<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class SystemWorker extends Authenticatable
{
    use HasFactory, SoftDeletes;

    public $fillable = ['stakeholder_id', 'username', 'password','role_id', 'api_token'];

    protected $primaryKey = 'stakeholder_id';

    protected $hidden = ['stakeholder_id','role_id','password','api_token'];

    /**
     * appending all attributes from other models, 
     * which will call function with every instance will be created,
     * with systemworker model 
     * @var array $appends
     */
    protected $appends = ['stakeholder','role'];   

    public function stakeholder()
    {
        return $this->hasOne('App\Models\Stakeholder', 'id');
    }
    public function role()
    {
        return $this->belongsTo('App\Models\Role');
    }
    public function transactions()
    {
        return $this->hasMany('App\Models\Transaction');
    }

    public function modules()
    {
        return $this->belongsToMany('App\Models\Module');
    }

    public function pcs()
    {
        return $this->belongsToMany('App\Models\Pc', 'pc_system_worker');
    }

    /**
     * this function will generate random 60 unique character to used it as api_token 
     * @return string $this->api_token
     */
    public function ApiTokenGenerater()
    {
        $this->api_token = Str::random(60);
        $this->save();
        return $this->api_token;
    }
    /**
     * this function will return boolean [true|false] if the systemWorker has/n't the passed permission"]
     * @param string $permission
     * @return boolean 
    */
    public function hasAccess(string $permission)
    {
        if($this->role!=null){
            foreach($this->role->permissions as $action){
                if($action->name == $permission){
                    return true;
                }   
            }
            return false;
        }
        else{
            return false;
        }
    }

    public function getStakeholderAttribute(){
        return $this->stakeholder()->first();
    }

    public function getRoleAttribute(){
        return $this->role()->first();   
    }
}
