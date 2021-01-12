<?php

namespace App\Http\Controllers;

use App\Models\VariableLabel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VariableLabelController extends Controller
{
    /**
     * authorization systemWorker actions to check if he have permission to do action or not 
     */
    public function __construct(){
        $this->authorizeResource(VariableLabel::class,'VariableLabel');
    }
    private $validationRules = [
        "key"=>"required|string|max:255|",
        "label"=>"required|string|max:255|",
        "data_type"=>"required|string|max:255|",
        "time_type"=>"required|string|max:255",
        "service_id"=>"numeric|exists:services,id",
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $variableLabel = VariableLabel::with(['service'])->get();
        return response()->json([$variableLabel], 202);
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

        $variableLabel = VariableLabel::create($validatedRequest);
        return response()->json([$variableLabel], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VariableLabel  $variableLabel
     * @return \Illuminate\Http\Response
     */
    public function show(VariableLabel $variableLabel)
    {
        return response()->json([$variableLabel], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VariableLabel  $variableLabel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VariableLabel $variableLabel)
    {
        $validatedRequest = $request->validate($this->validationRules);

        $variableLabel->update($validatedRequest);
        return response()->json([$variableLabel], 206);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VariableLabel  $variableLabel
     * @return \Illuminate\Http\Response
     */
    public function destroy(VariableLabel $variableLabel)
    {
        $variableLabel->delete();
        return response()->json(["message" => "Deleted Successfully"], 204);
    }
}
