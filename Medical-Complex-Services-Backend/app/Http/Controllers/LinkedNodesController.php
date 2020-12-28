<?php

namespace App\Http\Controllers;

use App\Models\LinkedNodes;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LinkedNodesController extends Controller
{
    private $validationRules = [
            "name"=>"required|string|max:255|",
            "price"=>"required|numeric",
            "transaction_id"=>"required|numeric|exists:transactions,id",
    ];
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $linkedNodes = LinkedNodes::all();
        return response()->json([$linkedNodes], 202);
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




        $linkedNodes = LinkedNodes::create($validatedRequest);
        return response()->json([$linkedNodes], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LinkedNodes  $linkedNodes
     * @return \Illuminate\Http\Response
     */
    public function show(LinkedNodes $linkedNode)
    {
        return response()->json([$linkedNode], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LinkedNodes  $linkedNodes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LinkedNodes $linkedNode)
    {
        $validatedRequest = $request->validate($this->validationRules);

        $linkedNode->update($validatedRequest);
        return response()->json([$linkedNode], 206);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LinkedNodes  $linkedNodes
     * @return \Illuminate\Http\Response
     */
    public function destroy(LinkedNodes $linkedNode)
    {
        $linkedNode->delete();
        return response()->json(["message" => "Deleted Successfully"], 204);
    }
}
