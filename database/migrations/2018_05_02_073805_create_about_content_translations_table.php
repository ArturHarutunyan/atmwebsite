<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAboutContentTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('about_content_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('about_content_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['about_content_id','locale']);
            $table->text('company_content');
            $table->text('our_projects_content');
            $table->text('dmc_content');
            $table->text('excursion_content');
            $table->text('logistics_content');
            $table->text('special_events_content');
            $table->text('for_partners_content');
            $table->text('login_password_content');
            $table->text('your_account_content');
            $table->text('special_content');
            $table->string('why_me_first_title');
            $table->text('why_me_first_content');
            $table->string('why_me_second_title');
            $table->text('why_me_second_content');
            $table->string('why_me_third_title');
            $table->text('why_me_third_content');
            $table->string('why_me_fourth_title');
            $table->text('why_me_fourth_content');
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
        Schema::dropIfExists('about_content_translations');
    }
}
