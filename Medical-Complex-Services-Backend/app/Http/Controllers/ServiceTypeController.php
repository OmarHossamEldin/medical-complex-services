<?php

namespace App\Http\Controllers;

use App\Models\ServiceType;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ServiceTypeController extends Controller
{
    private $validationRules = [
        "name"=>"required|string|max:255"
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $serviceType = ServiceType::all();
        return response()->json([$serviceType], 202);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedRequest = $request->validate($this->validationRules);

        $serviceType = ServiceType::create($validatedRequest);
        return response()->json([$serviceType], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ServiceType  $serviceType
     * @return \Illuminate\Http\Response
     */
    public function show(ServiceType $serviceType)
    {
        return response()->json([$serviceType], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ServiceType  $serviceType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ServiceType $serviceType)
    {
        $validatedRequest = $request->validate($this->validationRules);

        $serviceType->update($validatedRequest);
        return response()->json([$serviceType], 206);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ServiceType  $serviceType
     * @return \Illuminate\Http\Response
     */
    public function destroy(ServiceType $serviceType)
    {
        $serviceType->delete();
        return response()->json(["message" => "Deleted Successfully"], 204);
    }
}
