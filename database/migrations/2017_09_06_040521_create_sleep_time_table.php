<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSleepTimeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("sleep_time", function(Blueprint $table){
            $table->bigIncrements('id');
            //$table->string("device_id");
            $table->integer('device_id')->references("id")->on("device")->onupdate("cascade");
            $table->dateTime('data_send_time');
            $table->dateTime('time_register_reply');
            $table->time('bed_time');
            $table->time('time_delay');
            $table->time('wake_up_time');
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
        Schema::drop("sleep_time");
    }
}
