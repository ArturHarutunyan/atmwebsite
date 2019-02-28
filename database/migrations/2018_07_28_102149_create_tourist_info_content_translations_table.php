<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTouristInfoContentTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tourist_info_content_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tourist_info_content_id')->unsigned();
            $table->string('locale')->index();
            //$table->unique(['tourist_info_content_id','locale']);
            $table->text('visa_content');
            $table->text('climate_content');
            $table->text('currency_content');
            $table->text('safety_content');
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
        Schema::dropIfExists('tourist_info_content_translations');
    }
}
