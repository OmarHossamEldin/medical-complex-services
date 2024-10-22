<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    private $validationRules = [
            "system_worker_id"=>"numeric|exists:system_workers,stakeholder_id",
            "degree_id"=>"numeric|exists:degrees,id",
            "department_id"=>"numeric|exists:departments,id",
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doctor = Doctor::with(['system_worker', 'degree', 'department'])->get();
        return response()->json([$doctor], 202);
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

        $doctor = Doctor::create($validatedRequest);
        $doctor = $doctor->with(['system_worker', 'degree', 'department'])->where('system_worker_id', $doctor->system_worker_id)->take(1)->get();
        return response()->json($doctor, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function show(Doctor $doctor)
    {
        return response()->json([$doctor], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Doctor $doctor)
    {
        $validatedRequest = $request->validate($this->validationRules);

        $doctor->update($validatedRequest);

        $doctor = $doctor->with(['system_worker', 'degree', 'department'])->where('system_worker_id', $doctor->system_worker_id)->take(1)->get();
        return response()->json($doctor, 206);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Doctor $doctor)
    {
        $doctor->delete();
        return response()->json(["message" => "Deleted Successfully"], 204);
    }
}
