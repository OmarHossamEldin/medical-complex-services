<?php

namespace App\Http\Controllers;

use App\Models\ClosedInterval;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClosedIntervalController extends Controller
{
    /**
     * authorization systemWorker actions to check if he have permission to do action or not
     */
    // public function __construct(){
    //     $this->authorizeResource(ClosedInterval::class,'ClosedInterval');
    // }
    private $validationRules = [
            "day" => "required",
            "from" => "required|date_format:H:i:s",
            "to" => "required|date_format:H:i:s",
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $closedInterval = ClosedInterval::all();
        return response()->json([$closedInterval], 202);
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

        $closedInterval = ClosedInterval::create($validatedRequest);
        return response()->json([$closedInterval], 201);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ClosedInterval  $closedInterval
     * @return \Illuminate\Http\Response
     */
    public function show(ClosedInterval $closedInterval)
    {
        return response()->json([$closedInterval], 200);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ClosedInterval  $closedInterval
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClosedInterval $closedInterval)
    {
        $validatedRequest = $request->validate($this->validationRules);

        $closedInterval->update($validatedRequest);
        return response()->json([$closedInterval], 206);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ClosedInterval  $closedInterval
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClosedInterval $closedInterval)
    {
        $closedInterval->delete();
        return response()->json(["message" => "Deleted Successfully"], 204);
    }
}
