<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMealsAndCateringTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meals_and_catering_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('meals_and_catering_id')->unsigned();
            $table->string('locale')->index();
            //$table->unique(['meals_and_catering_id','locale']);
            $table->string('name')->nullable();
            $table->string('address')->nullable();
            $table->text('description')->nullable();
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
        Schema::dropIfExists('meals_and_catering_translations');
    }
}
