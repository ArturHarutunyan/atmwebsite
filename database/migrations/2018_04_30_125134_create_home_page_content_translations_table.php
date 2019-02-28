<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHomePageContentTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home_page_content_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('home_page_content_id')->unsigned();
            $table->string('locale')->index();
            //$table->unique(['home_page_content_id','locale']);
            $table->text('who_we_are_content');
            $table->text('the_best_tours_content');
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
        Schema::dropIfExists('home_page_content_translations');
    }
}
