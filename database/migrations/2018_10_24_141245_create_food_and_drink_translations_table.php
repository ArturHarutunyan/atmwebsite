<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFoodAndDrinkTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('food_and_drink_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('food_and_drink_id')->unsigned();
            $table->string('locale')->index();
            //$table->unique(['food_and_drink_id','locale']);
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
        Schema::dropIfExists('food_and_drink_translations');
    }
}
