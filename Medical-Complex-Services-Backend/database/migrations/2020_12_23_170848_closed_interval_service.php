<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ClosedIntervalService extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('closed_interval_service', function (Blueprint $table) {
            $table->foreignId("closed_interval_id")->constrained('closed_intervals')->onDelete('restrict');
            $table->foreignId("service_id")->constrained('services')->onDelete('restrict');
            $table->timestamps();
            $table->primary(['closed_interval_id','service_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('closed_interval_service');
    }
}
