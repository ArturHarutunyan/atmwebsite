<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesContentTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services_content_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('services_content_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['services_content_id','locale']);
            $table->text('tour_packages_content');
            $table->text('hotel_reservation_content');
            $table->text('choose_hotel_content');
            $table->text('select_dates_content');
            $table->text('welcome_to_armenia_content');
            $table->text('transport_content');
            $table->text('excursions_content');
            $table->text('mice_content_one');
            $table->text('mice_content_two');
            $table->text('translation_content');
            $table->text('equipment_content');
            $table->text('for_fit_content');
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
        Schema::dropIfExists('services_content_translations');
    }
}
