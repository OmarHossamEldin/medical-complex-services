<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ConsumerTransaction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consumer_transaction', function (Blueprint $table) {
            $table->foreignId("consumer_id")->constrained('consumers', 'stakeholder_id')->onDelete('restrict');
            $table->foreignId("transaction_id")->constrained('transactions')->onDelete('restrict');
            $table->timestamps();
            $table->primary(['consumer_id','transaction_id']);
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('consumer_transaction');
    }
}
