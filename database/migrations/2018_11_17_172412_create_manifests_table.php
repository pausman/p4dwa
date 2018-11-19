<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManifestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manifests', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('visitor_id')->unsigned();
            $table->foreign('visitor_id')->references('id')->on('visitors');
            $table->integer('from_boat_id')->unsigned();
            $table->foreign('from_boat_id')->references('id')->on('schedules');
            $table->integer('to_boat_id')->unsigned();
            $table->foreign('to_boat_id')->references('id')->on('schedules');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('manifest');
    }
}
