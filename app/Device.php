<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    protected $table = "device";
    protected $fillable = ["id", "device_id", 'device_type'];
    protected $hidden = [];

    public function sleep_time(){
    	return $this->hasmany("App\Sleep_time", "device_id");
    }

    public function sensor_data(){
    	return $this->hasmany("App\Sensor_data", "device_id");
    }
}
