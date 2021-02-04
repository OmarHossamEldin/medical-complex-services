<?php

namespace App\Http\Controllers;

use App\Models\RankPriceVariable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RankPriceVariableController extends Controller
{
    /**
     * authorization systemWorker actions to check if he have permission to do action or not
     */
    public function __construct(){
        $this->authorizeResource(RankPriceVariable::class,'RankPriceVariable');
    }
    private $validationRules = [
        "price_value"=>"required|numeric"
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rankPriceVariable = RankPriceVariable::all();
        return response()->json([$rankPriceVariable], 202);
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

        $rankPriceVariable = RankPriceVariable::create($validatedRequest);
        return response()->json([$rankPriceVariable], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RankPriceVariable  $rankPriceVariable
     * @return \Illuminate\Http\Response
     */
    public function show(RankPriceVariable $rankPriceVariable)
    {
        return response()->json([$rankPriceVariable], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RankPriceVariable  $rankPriceVariable
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RankPriceVariable $rankPriceVariable)
    {
        $validatedRequest = $request->validate($this->validationRules);

        $rankPriceVariable->update($validatedRequest);
        return response()->json([$rankPriceVariable], 206);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RankPriceVariable  $rankPriceVariable
     * @return \Illuminate\Http\Response
     */
    public function destroy(RankPriceVariable $rankPriceVariable)
    {
        $rankPriceVariable->delete();
        return response()->json(["message" => "Deleted Successfully"], 204);
    }
}
