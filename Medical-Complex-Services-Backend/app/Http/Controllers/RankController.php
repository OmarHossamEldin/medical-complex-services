<?php

namespace App\Http\Controllers;

use App\Models\Rank;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RankController extends Controller
{
    /**
     * authorization systemWorker actions to check if he have permission to do action or not
     */
    public function __construct(){
        $this->authorizeResource(Rank::class,'Rank');
    }
    private $validationRules = [
        "name"=>"required|string|max:255|unique:ranks",
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ranks = Rank::all();
        return response()->json([$ranks], 202);
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

        $rank = Rank::create($validatedRequest);
        return response()->json([$rank], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rank  $rank
     * @return \Illuminate\Http\Response
     */
    public function show(Rank $rank)
    {
        return response()->json([$rank], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rank  $rank
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rank $rank)
    {
        $validatedRequest = $request->validate($this->validationRules);

        $rank->update($validatedRequest);
        return response()->json([$rank], 206);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rank  $rank
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rank $rank)
    {
        $rank->delete();
        return response()->json(["message" => "Deleted Successfully"], 204);
    }
}
