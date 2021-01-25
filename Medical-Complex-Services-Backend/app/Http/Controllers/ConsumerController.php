<?php

namespace App\Http\Controllers;

use App\Models\Consumer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ConsumerController extends Controller
{
    /**
     * authorization systemWorker actions to check if he have permission to do action or not
     */
    // public function __construct(){
    //     $this->authorizeResource(Consumer::class,'Consumer');
    // }
    private $validationRules = [
        "stakeholder_id"=>"exists:stakeholders,id",
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $consumer = Consumer::with(['stakeholder'])->get();
        return response()->json([$consumer], 202);
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




        $consumer = Consumer::create($validatedRequest);
        return response()->json([$consumer], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Consumer  $consumer
     * @return \Illuminate\Http\Response
     */
    public function show(Consumer $consumer)
    {
        return response()->json([$consumer], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Consumer  $consumer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Consumer $consumer)
    {
        $validatedRequest = $request->validate($this->validationRules);

        $consumer->update($validatedRequest);
        return response()->json([$consumer], 206);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Consumer  $consumer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Consumer $consumer)
    {
        $consumer->delete();
        return response()->json(["message" => "Deleted Successfully"], 204);
    }
}
