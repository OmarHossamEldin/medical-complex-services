<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * authorization systemWorker actions to check if he have permission to do action or not
     */
    // public function __construct(){
    //     $this->authorizeResource(Transaction::class,'Transaction');
    // }
    private $validationRules = [
        "printing_count"=>"required|numeric",
        "system_worker_id"=>"numeric|exists:system_workers,stakeholder_id",
        "pc_id"=>"numeric|exists:pcs,id",
        "financial_category_id"=>"numeric|exists:financial_categories,id",
        "service_id"=>"numeric|exists:services,id",
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaction = Transaction::with(['system_worker', 'pc', 'financial_category', 'service'])->get();
        return response()->json([$transaction], 202);
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

        $transaction = Transaction::create($validatedRequest);
        return response()->json([$transaction], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        return response()->json([$transaction], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        $validatedRequest = $request->validate($this->validationRules);

        $transaction->update($validatedRequest);
        return response()->json([$transaction], 206);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return response()->json(["message" => "Deleted Successfully"], 204);
    }
}
