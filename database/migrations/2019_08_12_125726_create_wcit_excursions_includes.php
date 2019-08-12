<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWcitExcursionsIncludes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wcit_excursions_includes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('wcit_excursions_id')->unsigned();
           
            $table->string('name');
            $table->string('icon_src');
            
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
        Schema::dropIfExists('wcit_excursions_includes');
    }
}
