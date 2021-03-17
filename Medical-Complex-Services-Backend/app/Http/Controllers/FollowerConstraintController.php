<?php

namespace App\Http\Controllers;

use App\Models\FollowerConstraint;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FollowerConstraintController extends Controller
{
    private $validationRules = [
        "name"=>"required|string|max:255|unique:follower_constraints",
        "active"=>"required|boolean"
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $degree = FollowerConstraint::all();
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

        $degree = FollowerConstraint::create($validatedRequest);
        return response()->json([$degree], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FollowerConstraint  $followerConstraint
     * @return \Illuminate\Http\Response
     */
    public function show(FollowerConstraint $followerConstraint)
    {
        return response()->json([$followerConstraint], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FollowerConstraint  $followerConstraint
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FollowerConstraint $followerConstraint)
    {
        $validatedRequest = $request->validate($this->validationRules);

        $followerConstraint->update($validatedRequest);
        return response()->json([$followerConstraint], 206);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FollowerConstraint  $followerConstraint
     * @return \Illuminate\Http\Response
     */
    public function destroy(FollowerConstraint $followerConstraint)
    {
        $followerConstraint->delete();
        return response()->json(["message" => "Deleted Successfully"], 204);
    }
}
