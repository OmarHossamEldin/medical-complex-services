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
            "password"=>"required|string|max:255",
            "barcode"=>"required|string|max:255",
            "api_token"=>"nullable|string|max:255",
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $systemworker = SystemWorker::all();
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



        $systemworker = SystemWorker::create($validatedRequest);
        return response()->json([$systemworker], 201);
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
        $validatedRequest = $request->validate($this->validationRules);

        $systemWorker->update($validatedRequest);
        return response()->json([$systemWorker], 206);
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
