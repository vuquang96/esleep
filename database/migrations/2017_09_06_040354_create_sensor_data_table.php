<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSensorDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sensor_data', function (Blueprint $table) {
            $table->bigIncrements('id');
            //$table->string("device_id");
            $table->integer('device_id')->references("id")->on("device")->onupdate("cascade");
            $table->dateTime('data_send_time');
            $table->dateTime('time_check');
            $table->boolean('status_screen');
            $table->integer('lux');
            $table->double('baterry_pct');
            $table->double('latitude');
            $table->double('longitude');
            $table->integer('accelerator_time');
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
        Schema::drop("sensor_data");
    }
}
