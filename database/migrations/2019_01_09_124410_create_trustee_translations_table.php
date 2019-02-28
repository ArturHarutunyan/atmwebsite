<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrusteeTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trustee_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('trustee_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['trustee_id','locale']);
            $table->string('title');
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
        Schema::dropIfExists('trustee_translations');
    }
}
