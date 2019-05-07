<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFloorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'floors',
            function (Blueprint $table) {
                $table->increments('id')->unsigned();
                $table->integer('number');
                $table->string('description', 50);
                $table->integer('desks');
                $table->integer('location_id')->unsigned();

                $table->foreign('location_id')->references('id')->on('locations');
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('floors');
    }
}
