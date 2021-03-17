<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Helpers\Network;
use App\Models\Pc;

class RegisterPcs
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $pc = Network::getMacAddress($request->ip());
        if(Pc::where(['name'=>'unregistered-pc', 'ip'=>$pc['ip'], 'mac_address'=>$pc['mac_address']])->first()!=null){
            //pc is found but not registered
            $pc=Pc::where(['name'=>'unregistered-pc', 'ip'=>$pc['ip'], 'mac_address'=>$pc['mac_address']])->first();
            $pc->name = $request->pcName;
            $pc->save();
            return $next($request);
        }
        if (Pc::where(['ip'=>$pc['ip'], 'mac_address'=>$pc['mac_address']])->first())
            //pc is found and registered
            return $next($request);
        else
            Pc::create($pc);
            return response()->json(['message'=>'تم تسجيل الايبيه والماك ادريس برجاء كتابة اسم جهاز الكمبيوتر'], 200);
    }
}
