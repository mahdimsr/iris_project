<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


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

Route::middleware('auth:api')->get('/user', function(Request $request)
{
	return $request->user();
});


Route::get('/events/{userId}', 'Api\\AndroidController@getEvent');

Route::post('/getMeeting', 'Api\\AndroidController@getMeeting');
Route::post('/getMeetingDetails', 'Api\\AndroidController@getMeetingDetails');
Route::post('/setMeetingState', 'Api\\AndroidController@setMeetingState');
Route::post('/getMessage', 'Api\\AndroidController@getMessage');

Route::post('/setTask', 'Api\\AndroidController@setTask');
