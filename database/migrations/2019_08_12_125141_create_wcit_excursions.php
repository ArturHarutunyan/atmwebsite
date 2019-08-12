<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWcitExcursions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wcit_excursions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('group_price_amd');
            $table->integer('group_price_usd');
            $table->integer('group_price_eur');
            $table->integer('private_price_amd');
            $table->integer('private_price_usd');
            $table->integer('private_price_eur');

            $table->string('name');
            $table->string('main_photo_src');
            $table->string('short_description');

            $table->text('description');


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

        Schema::dropIfExists('wcit_excursions');
    }
}
