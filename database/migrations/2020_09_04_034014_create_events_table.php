<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();

            $table->integer('user_id');
            $table->integer('category_id');
            $table->string('name');
            $table->string('slug');
            $table->bigInteger('price');
            $table->longText('description');
            $table->dateTime('date_time');
            $table->string('event_type'); //PREMIUM and FREE
            $table->string('location');
            $table->string('location_details'); //location google map

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
        Schema::dropIfExists('events');
    }
}
