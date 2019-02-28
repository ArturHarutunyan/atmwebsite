<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateToursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tours', function (Blueprint $table) {
            $table->increments('id');
            //$table->string('name');
            $table->string('tour_image');
            $table->integer('start_price');
            $table->integer('currency_id');
            $table->integer('days_count');
            $table->integer('nights_count');
            $table->integer('season_id');
            $table->integer('period_id');
            $table->integer('hotel_id');
            $table->integer('group_size_id');
            $table->boolean('guaranteed');
            $table->softDeletes();
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
        Schema::dropIfExists('tours');
    }
}

