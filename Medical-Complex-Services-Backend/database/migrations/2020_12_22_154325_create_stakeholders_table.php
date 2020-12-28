<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStakeholdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stakeholders', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->double("wallet")->default(0);
            $table->unsignedInteger("patient_code")->unique();
            $table->string("barcode")->unique();
            $table->foreignId("rank_id")->constrained("ranks")->onDelete('restrict');
            $table->foreignId("stakeholder_id")->nullable()->constrained("stakeholders")->onDelete('set null');
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
        Schema::dropIfExists('stakeholders');
    }
}
