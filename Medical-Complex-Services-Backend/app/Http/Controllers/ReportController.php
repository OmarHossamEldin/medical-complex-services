<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    private $validationRules = [
        "name"=>"required|string",
        "sql_query"=>"required|string",
        "status"=>"boolean",
        "show_user"=>"boolean",
        "description"=>"nullable"
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $report = Report::all();
        return response()->json([$report], 202);
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
        $report = Report::create($validatedRequest);
        return response()->json([$report], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function show(Report $report)
    {
        return response()->json([$report], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Report $report)
    {
        $validatedRequest = $request->validate($this->validationRules);

        $report->update($validatedRequest);

        return response()->json([$report], 206);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function destroy(Report $report)
    {
        $report->delete();
        return response()->json(["message" => "Deleted Successfully"], 204);
    }

    /**
     * Execute the sql query and return array of jsons
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function execute(Request $request, Report $report)
    {
        $paramsArray = [];
        foreach ($request->request as $key => $value) {
            $paramsArray[$key] = $value;
        }
        $result = DB::select($report->sql_query, $paramsArray);
        return response()->json($result, 202);
    }
}
