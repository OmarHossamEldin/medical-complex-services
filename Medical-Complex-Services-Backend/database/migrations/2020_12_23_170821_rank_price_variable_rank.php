<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RankPriceVariableRank extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rank_price_variable_rank', function (Blueprint $table) {
            $table->foreignId("rank_price_variable_id")->constrained('rank_price_variables')->onDelete('restrict');
            $table->foreignId("rank_id")->constrained('ranks')->onDelete('restrict');
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
        Schema::dropIfExists('rank_price_variable_rank');
    }
}
