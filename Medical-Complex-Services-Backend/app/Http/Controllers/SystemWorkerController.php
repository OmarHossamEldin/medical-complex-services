<?php

namespace App\Http\Controllers;

use App\Models\SystemWorker;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SystemWorkerController extends Controller
{
    public function __construct(){
        $this->authorizeResource(SystemWorker::class,'SystemWorker');
    }
    private $validationRules = [
            "stakeholder_id"=>"exists:stakeholders,id",
            "username"=>"required|string|max:255|unique:system_workers",
            "role_id"=>"exists:roles,id",
            "password"=>"max:255",
            "api_token"=>"nullable|string|max:255",
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $systemworker = SystemWorker::with(['role', 'stakeholder'])->get();
        return response()->json([$systemworker], 202);
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

        $systemWorker = SystemWorker::create($validatedRequest);
        $systemWorker = $systemWorker->with(['role:id,name', 'stakeholder:id,name'])->where('stakeholder_id', $systemWorker->stakeholder_id)->take(1)->get();
        return response()->json($systemWorker, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SystemWorker  $systemWorker
     * @return \Illuminate\Http\Response
     */
    public function show(SystemWorker $systemWorker)
    {
        return response()->json([$systemWorker], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SystemWorker  $systemWorker
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SystemWorker $systemWorker)
    {
        $this->validationRules['username'] = "required|string|max:255|unique:system_workers,username,{$systemWorker->stakeholder_id},stakeholder_id";

        $validatedRequest = $request->validate($this->validationRules);

        $systemWorker->update($validatedRequest);
        $systemWorker = $systemWorker->with(['role:id,name', 'stakeholder:id,name'])->where('stakeholder_id', $systemWorker->stakeholder_id)->take(1)->get();
        return response()->json($systemWorker, 206);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SystemWorker  $systemWorker
     * @return \Illuminate\Http\Response
     */
    public function destroy(SystemWorker $systemWorker)
    {
        $systemWorker->delete();
        return response()->json(["message" => "Deleted Successfully"], 204);
    }
}
