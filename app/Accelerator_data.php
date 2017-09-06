<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Accelerator_data extends Model
{
    protected $table = "accelerator_data";
    protected $fillable = ["id", "sensor_data_id", 'x', 'y', 'z'];
    protected $hidden = [];

    public function sensor_data(){
    	return $this->hasOne("App\Sensor_data", "id");
    }
}
