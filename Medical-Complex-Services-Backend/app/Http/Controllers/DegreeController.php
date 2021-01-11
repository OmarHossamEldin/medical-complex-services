<?php

namespace App\Http\Controllers;

use App\Models\Degree;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DegreeController extends Controller
{
    /**
     * authorization systemWorker actions to check if he have permission to do action or not 
     */
    public function __construct(){
        $this->authorizeResource(Degree::class,'Degree');
    }
    private $validationRules = [
        "name"=>"required|string|max:255|unique:degrees"
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $degree = Degree::all();
        return response()->json([$degree], 202);
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

        $degree = Degree::create($validatedRequest);
        return response()->json([$degree], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Degree  $degree
     * @return \Illuminate\Http\Response
     */
    public function show(Degree $degree)
    {
        return response()->json([$degree], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Degree  $degree
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Degree $degree)
    {
        $validatedRequest = $request->validate($this->validationRules);

        $degree->update($validatedRequest);
        return response()->json([$degree], 206);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Degree  $degree
     * @return \Illuminate\Http\Response
     */
    public function destroy(Degree $degree)
    {
        $degree->delete();
        return response()->json(["message" => "Deleted Successfully"], 204);
    }
}
