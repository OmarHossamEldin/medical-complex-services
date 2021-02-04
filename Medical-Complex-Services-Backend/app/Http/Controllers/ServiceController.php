<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * authorization systemWorker actions to check if he have permission to do action or not
     */
    public function __construct(){
        $this->authorizeResource(Service::class,'Service');
    }
    private $validationRules = [
        "name"=>"required|string|max:255|",
        "fixed_price"=>"numeric",
        "timed"=>"boolean",
        "requires_doctor"=>"boolean",
        "main_consumer_number"=>"numeric",
        "associate_consumer_number"=>"numeric",
        "variable_price_equation"=>"nullable|string|max:255|",
        "price_type_id"=>"numeric|exists:price_types,id",
        "service_type_id"=>"numeric|exists:service_types,id",
        "department_id"=>"numeric|exists:departments,id",
        "service_id"=>"nullable|numeric|exists:services,id",
        "pc_dependent"=>"boolean",
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $service = Service::with(['price_type', 'service_type', 'department'])->get();
        return response()->json([$service], 202);
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

        $service = Service::create($validatedRequest);
        $service = $service->with(['price_type', 'service_type', 'department'])->where('id', $service->id)->take(1)->get();
        return response()->json($service, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        return response()->json([$service], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        $validatedRequest = $request->validate($this->validationRules);

        $service->update($validatedRequest);
        $service = $service->with(['price_type', 'service_type', 'department'])->where('id', $service->id)->take(1)->get();
        return response()->json($service, 206);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        $service->delete();
        return response()->json(["message" => "Deleted Successfully"], 204);
    }
}
