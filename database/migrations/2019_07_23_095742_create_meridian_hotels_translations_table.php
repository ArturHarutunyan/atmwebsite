<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMeridianHotelsTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meridian_hotels_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('meridian_hotels_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['meridian_hotels_id','locale']);
            $table->string('name');
            $table->string('address');
            $table->string('facilities_json');
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
        Schema::dropIfExists('meridian_hotels_translations');
    }
}
