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
            return response()->json(['user'=>auth()->user(),'api_token' =>auth()->user()->ApiTokenGenerater()], 201);
        }
        else
        {
            return response()->json(['type'=>'error','message' => 'Your Credentials Are Wrong'], 400);
        }
    }
}
