<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'locations',
            function (Blueprint $table) {
                $table->increments('id')->unsigned();
                $table->string('name', 64);
                $table->string('address', 255);
                $table->date('opening_date');
                $table->string('country', 2);

                $table->foreign('country')->references('code')->on('countries');
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
        Schema::dropIfExists('locations');
    }
}
