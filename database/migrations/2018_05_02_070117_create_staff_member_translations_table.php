<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaffMemberTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff_member_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('staff_member_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['staff_member_id','locale']);
            $table->string('name');
            $table->string('surname');
            $table->string('position');
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
        Schema::dropIfExists('staff_member_translations');
    }
}
