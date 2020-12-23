<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FollowerConstraintService extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('follower_constraint_service', function (Blueprint $table) {
            $table->foreignId("follower_constraint_id")->constrained('follower_constraints')->onDelete('restrict');
            $table->foreignId("service_id")->constrained('services')->onDelete('restrict');
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
        Schema::dropIfExists('follower_constraint_service');
    }
}
