<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAboutArmeniaContentTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('about_armenia_content_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('about_armenia_content_id')->unsigned();
            $table->string('locale')->index();
            /*$table->unique(['about_armenia_content_id','locale']);*/
            $table->text('history_content')->nullable();
            $table->text('culture_content_one')->nullable();
            $table->text('culture_content_two')->nullable();
            $table->text('religion_content')->nullable();
            $table->text('climate_content')->nullable();
            $table->text('winter_content')->nullable();
            $table->text('spring_content')->nullable();
            $table->text('summer_content')->nullable();
            $table->text('autumn_content')->nullable();
            $table->text('first_reason_content')->nullable();
            $table->text('second_reason_content')->nullable();
            $table->text('third_reason_content')->nullable();
            $table->text('fourth_reason_content')->nullable();
            $table->text('fifth_reason_content')->nullable();
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
        Schema::dropIfExists('about_armenia_content_translations');
    }
}
