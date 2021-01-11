<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    /**
     * authorization systemWorker actions to check if he have permission to do action or not 
     */
    public function __construct(){
        $this->authorizeResource(Module::class,'Module');
    }
    private $validationRules = [
        "name"=>"required|string|max:255|unique:modules"
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $module = Module::all();
        return response()->json([$module], 202);
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

        $module = Module::create($validatedRequest);
        return response()->json([$module], 201);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function show(Module $module)
    {
        return response()->json([$module], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Module $module)
    {
        $validatedRequest = $request->validate($this->validationRules);

        $module->update($validatedRequest);
        return response()->json([$module], 206);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function destroy(Module $module)
    {
        $module->delete();
        return response()->json(["message" => "Deleted Successfully"], 204);
    }
}
