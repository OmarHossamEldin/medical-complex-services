<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DoctorTransaction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctor_transaction', function (Blueprint $table) {
            $table->foreignId("doctor_id")->constrained('doctors', 'system_worker_id')->onDelete('restrict');
            $table->foreignId("transaction_id")->constrained('transactions')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doctor_transaction');
    }
}
