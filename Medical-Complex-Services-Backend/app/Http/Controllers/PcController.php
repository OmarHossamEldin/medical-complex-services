<?php

namespace App\Http\Controllers;

use App\Models\Pc;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Rules\MacAddress;

class PcController extends Controller
{
    /**
     * authorization systemWorker actions to check if he have permission to do action or not
     */
    // public function __construct(){
    //     $this->authorizeResource(Pc::class,'Pc');
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        {
            $pc = Pc::all();
            return response()->json([$pc], 202);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedRequest = $request->validate([
            "name"=>"nullable|string|max:255",
            "ip"=>"required|ipv4|unique:pcs",
            "mac_address"=>[new MacAddress, 'unique:pcs', 'required']

        ]);

        $pc = Pc::create($validatedRequest);
        return response()->json([$pc], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pc  $pc
     * @return \Illuminate\Http\Response
     */
    public function show(Pc $pc)
    {
        return response()->json([$pc], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pc  $pc
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pc $pc)
    {
        $validatedRequest = $request->validate([
            "name"=>"nullable|string|max:255",
            "ip"=>"required|ipv4|unique:pcs",
            "mac_address"=>[new MacAddress, 'unique:pcs', 'required']
        ]);

        $pc->update($validatedRequest);
        return response()->json([$pc], 206);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pc  $pc
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pc $pc)
    {
        $pc->delete();
        return response()->json(["message" => "Deleted Successfully"], 204);
    }
}
