<?php

namespace App\Http\Controllers;

use App\Models\Stakeholder;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StakeholderController extends Controller
{
    /**
     * authorization systemWorker actions to check if he have permission to do action or not
     */
    public function __construct(){
        $this->authorizeResource(Stakeholder::class,'Stakeholder');
    }
    private $validationRules = [
        "name"=>"required|string|max:255|",
        "wallet"=>"numeric",
        "patient_code"=>"numeric|unique:stakeholders",
        "barcode"=>"required|string|max:255|unique:stakeholders",
        "rank_id"=>"numeric|exists:ranks,id",
        "stakeholder_id"=>"nullable|numeric|exists:stakeholders,id"
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stakeholder = Stakeholder::with(['rank:id,name', 'parent:id,name'])->get();
        return response()->json([$stakeholder], 202);
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

        $stakeholder = Stakeholder::create($validatedRequest);
        $stakeholder = $stakeholder->with(['rank:id,name', 'parent:id,name'])->where('id', $stakeholder->id)->take(1)->get();
        return response()->json($stakeholder, 201);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Stakeholder  $stakeholder
     * @return \Illuminate\Http\Response
     */
    public function show(Stakeholder $stakeholder)
    {
        return response()->json([$stakeholder], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Stakeholder  $stakeholder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stakeholder $stakeholder)
    {
        $this->validationRules['barcode'] = "required|string|max:255|unique:stakeholders,barcode,{$stakeholder->id}";
        $this->validationRules['patient_code'] = "numeric|unique:stakeholders,patient_code,{$stakeholder->id}";
        $validatedRequest = $request->validate($this->validationRules);

        $stakeholder->update($validatedRequest);
        $stakeholder = $stakeholder->with(['rank:id,name', 'parent:id,name'])->where('id', $stakeholder->id)->take(1)->get();
        return response()->json($stakeholder, 206);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Stakeholder  $stakeholder
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stakeholder $stakeholder)
    {
        $stakeholder->delete();
        return response()->json(["message" => "Deleted Successfully"], 204);
    }
}
