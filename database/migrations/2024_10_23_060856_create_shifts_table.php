<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShiftsTable extends Migration
{
    public function up()
    {
        Schema::create('shifts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('schedule_id');
            $table->date('date');
            $table->string('type');
            $table->timestamps();

            $table->foreign('schedule_id')->references('id')->on('schedules')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('shifts');
    }
}