<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSystemWorkersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('system_workers', function (Blueprint $table) {
            $table->foreignId("stakeholder_id")->primary()->constrained("stakeholders")->onDelete('cascade');
            $table->string("username")->unique();
            $table->string("password");
            $table->string("api_token")->nullable();
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
        Schema::dropIfExists('system_workers');
    }
}
