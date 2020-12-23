<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModuleSystemWorker extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('module_system_worker', function (Blueprint $table) {
            $table->foreignId("module_id")->constrained('modules')->onDelete('restrict');
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
        Schema::dropIfExists('module_system_worker');
    }
}
