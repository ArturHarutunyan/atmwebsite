<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTourDayTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tour_day_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tour_day_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['tour_day_id','locale']);
            $table->text('text_content');
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
        Schema::dropIfExists('tour_day_translations');
    }
}
