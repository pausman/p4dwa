<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScheduleVisitorTable extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Schema::create('schedule_visitor', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('visitor_id')->unsigned();
            $table->foreign('visitor_id')->references('id')->on('visitors');
            $table->integer('schedule_id')->unsigned();
            $table->foreign('schedule_id')->references('id')->on('schedules');
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedule_visitor');
    }
}
