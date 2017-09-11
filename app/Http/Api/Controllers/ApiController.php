<?php

namespace App\Api\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Dingo\Api\Routing\Helpers;
use App\Device;
use App\Sensor_data;
use App\Accelerator_data;
use App\Sleep_time;


class ApiController extends Controller
{
    use Helpers;
    public function esleep($location = null, $content = null){
      $response = new Response($content);
    $response->setStatusCode(201);die;
      $temp = Input::all();
      //$this->post();
      echo $this->post();die;
           echo "<pre>";
                print_r($this->post());
                echo "</pre>";   
    	if(isset($_POST['esleep'])){

            $data = json_decode($_POST['esleep']);
                
            $device_id = 0;
            foreach ($data->sensor_data as $value) {
                $device = Device::all()->where("device_id" ,$data->user_id)->where("device_type" ,$data->device_os)->count();
                if(!$device){
                    // Device
                    $device = new Device();
                    $device->device_id = $data->user_id;
                    $device->device_type = $data->device_os; 
                    $device->save();
                    $device_id = $device->id;
                }else{
                    $device = Device::all()->where("device_id" ,$data->user_id)->where("device_type" ,$data->device_os)->get();
                    $device_id = $device->id;
                }

                $time = strtotime( $value->create_time );
                
                $sensorData = new Sensor_data();
               // $sensorData->device_id              = $data->user_id;
                $sensorData->device_id              = $device_id;
                $sensorData->data_send_time         = date("Y-m-d H:i:s"); 
                $sensorData->time_check             = date("Y-m-d H:i:s", $time);
                $sensorData->status_screen          = ($value->screen_status) ? 1 : 0;
                $sensorData->lux                    = $value->light_value;
                $sensorData->baterry_pct            = $value->baterry_pct;
                $sensorData->latitude               = $value->location->lat;
                $sensorData->longitude              = $value->location->long;
                $sensorData->accelerator_time       = $data->acceleration_sampling_time;
                $sensorData->save();
                $id = $sensorData->id;

                // Accelerator
                foreach ($value->acceleration as $acceleration) {
                    $accelerator = new Accelerator_data();
                    $accelerator->sensor_data_id = $id;
                    $accelerator->x = $acceleration->x;
                    $accelerator->y = $acceleration->y;
                    $accelerator->z = $acceleration->z;
                    $accelerator->save();
                }    
            }

            // Sleep time
            $timeRegisterReply  = strtotime( $data->quiz_data->create_time ); 
            $timeBed            = strtotime( $data->quiz_data->bed_time );
            $timeDelay          = strtotime( $data->quiz_data->fall_to_sleep_time ) - $timeBed;
            $timeWakeUp         = strtotime( $data->quiz_data->wake_up_time );

            $sleepTime = new Sleep_time();
            //$sleepTime->device_id           = $data->user_id;
            $sleepTime->device_id           = $device_id;
            $sleepTime->data_send_time      = date("Y-m-d H:i:s");
            $sleepTime->time_register_reply = date("Y-m-d H:i:s", $timeRegisterReply);
            $sleepTime->bed_time            = date("H:i:s", $timeBed);
            $sleepTime->time_delay          = date("H:i:s", $timeDelay);
            $sleepTime->wake_up_time        = date("H:i:s", $timeWakeUp);
            $sleepTime->save();

            return 1;
        }
    	return 0;
    }

    public function client(){
    	$json = '{
              "device_os": "android",
              "acceleration_sampling_time": 30,
              "user_id": "123-bac",
              "sensor_data": [
                {
                  "create_time": "2017-08-31T08:45:30+09:00",
                  "screen_status": true,
                  "light_value": 123,
                  "baterry_pct": 0.3,
                  "acceleration": [
                    {
                      "x": 1.2,
                      "y": 1.3,
                      "z": 1.4
                    },
                    {
                      "x": 1.5,
                      "y": 1.6,
                      "z": 1.7
                    }
                  ],
                  "location": {
                    "lat": 11.22,
                    "long": 33.44
                  }
                },
                {
                  "create_time": "2017-07-31T08:43:30+09:00",
                  "screen_status": true,
                  "light_value": 123,
                  "baterry_pct": 0.3,
                  "acceleration": [
                    {
                      "x": 1.2,
                      "y": 1.3,
                      "z": 1.4
                    },
                    {
                      "x": 1.5,
                      "y": 1.6,
                      "z": 1.7
                    }
                  ],
                  "location": {
                    "lat": 11.22,
                    "long": 33.44
                  }
                }
              ],
              "quiz_data": {
                "create_time": "2017-08-31T08:45:30+09:00",
                "bed_time": "2017-08-31T08:45:30+09:00",
                "fall_to_sleep_time": "2017-08-31T08:45:30+09:00",
                "wake_up_time": "2017-08-31T08:45:30+09:00",
                "notes": "abcxyz"
              }
            }';

        $data = json_decode($json);

       
        foreach ($data->sensor_data as $value) {
            $device = Device::all()->where("device_id" ,$data->user_id)->count();
            if(!$device){
                // Device
                $device = new Device();
                $device->device_id = $data->user_id;
                $device->device_type = $data->device_os; 
                $device->save();
            }

            $time = strtotime( $value->create_time );
            
            $sensorData = new Sensor_data();
            $sensorData->device_id              = $data->user_id;
            $sensorData->data_send_time         = date("Y-m-d H:i:s"); 
            $sensorData->time_check             = date("Y-m-d H:i:s", $time);
            $sensorData->status_screen          = ($value->screen_status) ? 1 : 0;
            $sensorData->lux                    = $value->light_value;
            $sensorData->baterry_pct            = $value->baterry_pct;
            $sensorData->latitude               = $value->location->lat;
            $sensorData->longitude              = $value->location->long;
            $sensorData->accelerator_time       = $data->acceleration_sampling_time;
            $sensorData->save();
            $id = $sensorData->id;

            // Accelerator
            foreach ($value->acceleration as $acceleration) {
                $accelerator = new Accelerator_data();
                $accelerator->sensor_data_id = $id;
                $accelerator->x = $acceleration->x;
                $accelerator->y = $acceleration->y;
                $accelerator->z = $acceleration->z;
                $accelerator->save();
            }    
        }

        // Sleep time
        $timeRegisterReply  = strtotime( $data->quiz_data->create_time ); 
        $timeBed            = strtotime( $data->quiz_data->bed_time );
        $timeDelay          = strtotime( $data->quiz_data->fall_to_sleep_time ) - $timeBed;
        $timeWakeUp         = strtotime( $data->quiz_data->wake_up_time );

        $sleepTime = new Sleep_time();
        $sleepTime->device_id           = $data->user_id;
        $sleepTime->data_send_time      = date("Y-m-d H:i:s");
        $sleepTime->time_register_reply = date("Y-m-d H:i:s", $timeRegisterReply);
        $sleepTime->bed_time            = date("H:i:s", $timeBed);
        $sleepTime->time_delay          = date("H:i:s", $timeDelay);
        $sleepTime->wake_up_time        = date("H:i:s", $timeWakeUp);
        $sleepTime->save();

        echo "<pre>";
        print_r($data);
        echo "<pre>";
    }

}
