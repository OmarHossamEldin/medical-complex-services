<?php

namespace App\Http\Controllers;

use App\Models\BillingOption;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BillingOptionController extends Controller
{
    private $validationRules = [
        "name"=>"required|string|max:255|unique:billing_options"
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $billingOption = BillingOption::all();
        return response()->json([$billingOption], 202);
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

        $billingOption = BillingOption::create($validatedRequest);
        return response()->json([$billingOption], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BillingOption  $billingOption
     * @return \Illuminate\Http\Response
     */
    public function show(BillingOption $billingOption)
    {
        return response()->json([$billingOption], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BillingOption  $billingOption
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BillingOption $billingOption)
    {
        $validatedRequest = $request->validate($this->validationRules);

        $billingOption->update($validatedRequest);
        return response()->json([$billingOption], 206);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BillingOption  $billingOption
     * @return \Illuminate\Http\Response
     */
    public function destroy(BillingOption $billingOption)
    {
        $billingOption->delete();
        return response()->json(["message" => "Deleted Successfully"], 204);
    }
}
