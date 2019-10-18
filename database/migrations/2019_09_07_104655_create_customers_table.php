<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->text('legal_name');
            $table->string('phone');
            $table->string('email');
            $table->string('tin');
            $table->text('notes')->nullable();
            $table->string('name')->nullable();
            $table->string('legal_address')->nullable();
            $table->string('business_address')->nullable();
            $table->string('directors_name')->nullable();
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
        Schema::dropIfExists('customers');
    }
}
