<?php

namespace App\Http\Controllers;

use App\Models\PriceType;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PriceTypeController extends Controller
{
    /**
     * authorization systemWorker actions to check if he have permission to do action or not
     */
    public function __construct(){
        $this->authorizeResource(PriceType::class,'PriceType');
    }
    private $validationRules = [
        "name"=>"required|string|max:255|unique:price_types"
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $priceType = PriceType::all();
        return response()->json([$priceType], 202);
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

        $priceType = PriceType::create($validatedRequest);
        return response()->json([$priceType], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PriceType  $priceType
     * @return \Illuminate\Http\Response
     */
    public function show(PriceType $priceType)
    {
        return response()->json([$priceType], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PriceType  $priceType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PriceType $priceType)
    {
        $validatedRequest = $request->validate($this->validationRules);

        $priceType->update($validatedRequest);
        return response()->json([$priceType], 206);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PriceType  $priceType
     * @return \Illuminate\Http\Response
     */
    public function destroy(PriceType $priceType)
    {
        $priceType->delete();
        return response()->json(["message" => "Deleted Successfully"], 204);
    }
}
