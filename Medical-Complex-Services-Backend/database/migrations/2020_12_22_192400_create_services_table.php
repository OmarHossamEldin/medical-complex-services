<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->double('fixed_price')->nullable();
            $table->boolean('timed')->default(false);
            $table->boolean('requires_doctor');
            $table->integer('main_consumer_number');
            $table->integer('associate_consumer_number');
            $table->string('variable_price_equation')->nullable();
            $table->foreignId('price_type_id')->constrained('price_types')->onDelete('restrict');
            $table->foreignId('service_type_id')->constrained('service_types')->onDelete('restrict');
            $table->foreignId('department_id')->nullable()->constrained('departments')->onDelete('restrict');
            $table->foreignId('service_id')->nullable()->constrained('services')->onDelete('cascade');
            $table->boolean('pc_dependent')->default(false);
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
        Schema::dropIfExists('services');
    }
}
