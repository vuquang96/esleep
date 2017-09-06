<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAcceleratorDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("accelerator_data", function(Blueprint $table){
            $table->bigIncrements('id');
            $table->bigInteger('sensor_data_id')->references("id")->on("sensor_data")->onupdate("cascade");
            $table->double('x');
            $table->double('y');
            $table->double('z');
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
        Schema::drop("accelerator_data");
    }
}
