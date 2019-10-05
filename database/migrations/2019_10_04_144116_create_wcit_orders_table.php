<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWcitOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wcit_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('wcit_excursion_id');
            $table->integer('wcit_day_id');
            $table->integer('excursion_type_id');
            $table->integer('wcit_customer_id');
            $table->integer('tour_language_id');
            $table->enum('status',[0,1,2])->default(0);
            $table->integer('guide_id')->nullable();
            $table->integer('driver_id')->nullable();
            $table->integer('price');
            $table->integer('people_count');
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
        Schema::dropIfExists('wcit_orders');
    }
}
