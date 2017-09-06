<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sensor_data extends Model
{
    protected $table = "sensor_data";
    protected $fillable = ["id", "device_id", 'data_send_time', 'time_check', 'status_screen', 'lux', 'latitude', 'longitude', 'accelerator_time'];
    protected $hidden = [];

    public function accelerator_data(){
    	return $this->hasMany("App\Accelerator_data", "sensor_data_id");
    }

    public function device(){
    	return $this->hasOne("App\Device", "device_id");
    }
}
