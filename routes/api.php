<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


//Route::post("esleep", ['as' => 'esleep_post', 'uses' => 'ApiController@esleep']);

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {
	$api->get('test', function(){
		return "ok";
	});
	$api->post('test',['namespace' => 'App\Api\Controllers\ApiController'], 'esleep');
	/*$api->post('test', function (Request $request){
				echo "<pre>";
			    print_r($request->all());
			    echo "</pre>";
	    //return response()->json($request->getContent());
	    //echo json_decode($request->getContent());
	});*/
});
