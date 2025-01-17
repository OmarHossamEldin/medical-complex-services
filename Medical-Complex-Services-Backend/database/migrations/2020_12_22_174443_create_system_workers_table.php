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
            $table->string("password")->default(bcrypt("123456"));
            $table->foreignId("role_id")->nullable()->constrained('roles')->onDelete('restrict');
            $table->string("api_token")->nullable();
            $table->timestamps();
            $table->softDeletes();
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
