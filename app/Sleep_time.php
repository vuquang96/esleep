<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sleep_time extends Model
{
    protected $table = "sleep_time";
    protected $fillable = ["id", "device_id", 'data_send_time', 'time_register_reply', 'bed_time', 'time_delay', 'wake_up_time'];
    protected $hidden = [];

    public function device(){
    	return $this->hasOne("App\Device", "device_id");
    }
}
