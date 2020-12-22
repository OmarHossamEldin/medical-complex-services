<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->foreignId("system_worker_id")->primary()->constrained("system_workers", "stakeholder_id")->onDelete('cascade');
            $table->foreignId("degree_id")->constrained("degrees")->onDelete('restrict');
            $table->foreignId("department_id")->constrained("departments")->onDelete('restrict');
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
        Schema::dropIfExists('doctors');
    }
}
