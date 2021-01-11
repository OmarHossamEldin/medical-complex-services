<?php

namespace App\Http\Controllers;

use App\Models\FinancialCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FinancialCategoryController extends Controller
{
    /**
     * authorization systemWorker actions to check if he have permission to do action or not 
     */
    public function __construct(){
        $this->authorizeResource(FinancialCategory::class,'FinancialCategory');
    }
    private $validationRules = [
            "name"=>"required|string|max:255|unique:financial_categories",
            "operator"=>"required|string|max:3",
            "value"=>"required|numeric",
            "max_limit"=>"nullable|numeric"
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $financialCategory = FinancialCategory::all();
        return response()->json([$financialCategory], 202);
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


        $financialCategory = FinancialCategory::create($validatedRequest);
        return response()->json([$financialCategory], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(FinancialCategory $financialCategory)
    {
        return response()->json([$financialCategory], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FinancialCategory $financialCategory)
    {
        $validatedRequest = $request->validate($this->validationRules);

        $financialCategory->update($validatedRequest);
        return response()->json([$financialCategory], 206);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(FinancialCategory $financialCategory)
    {
        $financialCategory->delete();
        return response()->json(["message" => "Deleted Successfully"], 204);
    }
}
