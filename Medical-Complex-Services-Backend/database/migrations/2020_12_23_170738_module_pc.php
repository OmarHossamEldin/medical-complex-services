<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModulePc extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('module_pc', function (Blueprint $table) {
            $table->foreignId("module_id")->constrained('modules')->onDelete('restrict');
            $table->foreignId("pc_id")->constrained('pcs')->onDelete('restrict');
            $table->timestamps();
            $table->primary(['module_id','pc_id']);
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('module_pc');
    }
}
