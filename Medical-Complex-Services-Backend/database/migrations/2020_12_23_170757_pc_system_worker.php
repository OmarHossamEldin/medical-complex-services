<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PcSystemWorker extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pc_system_worker', function (Blueprint $table) {
            $table->foreignId("pc_id")->constrained('pcs')->onDelete('restrict');
            $table->foreignId("system_worker_id")->constrained('system_workers', 'stakeholder_id')->onDelete('restrict');
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
        Schema::dropIfExists('pc_system_worker');
    }
}
