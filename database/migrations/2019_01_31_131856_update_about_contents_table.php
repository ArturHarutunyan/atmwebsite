<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateAboutContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('about_contents', function (Blueprint $table) {
            $table->text('why_me_first_image')->change();
            $table->text('why_me_second_image')->change();
            $table->text('why_me_third_image')->change();
            $table->text('why_me_fourth_image')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
