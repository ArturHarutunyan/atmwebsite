<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSightseeingPlaceTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sightseeing_place_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sightseeing_place_id')->unsigned();
            $table->string('locale')->index();
            //$table->unique(['sightseeing_place_id','locale']);
            $table->string('name');
            $table->text('description');
            $table->string('slug')->unique();
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
        Schema::dropIfExists('sightseeing_place_translations');
    }
}
