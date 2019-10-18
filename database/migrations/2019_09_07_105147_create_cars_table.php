<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('price_id');
            $table->string('model_id');
            $table->string('color');
            $table->integer('year');
            $table->integer('seat_count');
            $table->integer('baggage_quantity');
            $table->boolean('is_leather')->nullable();
            $table->boolean('is_foldable')->nullable();
            $table->integer('fuel_type_id');
            $table->float('volume');
            $table->boolean('has_air_conditioning')->nullable();
            $table->boolean('has_monitor')->nullable();
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
        Schema::dropIfExists('cars');
    }
}
