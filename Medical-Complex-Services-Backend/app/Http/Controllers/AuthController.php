<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * validation rules for the controller
     */
    private $validationRules = [
        "username"=>"required|string",
        "password"=>"required"
    ];
    /**
     * this function will handel login request for system worker.
     * @param \Illuminate\Http\Request  $request 
     * @return string $api_token
     */
    public function login(Request $request)
    {
        $validatedRequest = $request->validate($this->validationRules);
        if(Auth::attempt($validatedRequest))
        {
            return response()->json([
                'message' => 'لقد تم تسجيل الدخول بنجاح',
                'user' => auth()->user(),
                'api_token' => auth()->user()->ApiTokenGenerater(),
            ], 206);
        }
        else
        {
            return response()->json(['type'=>'error','message' => 'برجاء اتاكد من اسم المستخدم وكلمة المرور'], 400);
        }
    }
    /**
     * this function will handel logout request.
     * @return json response
     */
    public function logout()
    {
        auth()->user()->logout = null;
        return response()->json(['message' => 'لقد تم تسجيل الخروج بنجاح'], 200);
    }
}
