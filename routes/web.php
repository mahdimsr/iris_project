<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Route;


Route::get('/', function()
{
	return view('welcome');
});

Route::prefix('dashboard')->group(function()
{
	Route::get('/view', 'Dashboard\\DashboardController@dashboardView');


	//meting
	Route::prefix('meeting')->group(function()
	{
		Route::get('/view', 'Dashboard\\MeetingController@View');
		Route::get('/insertView', 'Dashboard\\MeetingController@insertView');
		Route::post('/insert', 'Dashboard\\MeetingController@insert');
		Route::get('/editView/{id}', 'Dashboard\\MeetingController@editView');
		Route::get('/remove', 'Dashboard\\MeetingController@remove');
	});

});

Route::get('test', function()
{
	$meeting = \App\Model\Meeting::find(2);

	$date       = \Illuminate\Support\Carbon::create(2019, 1, 3, 23);
	$customDate = \Illuminate\Support\Carbon::create(2019, 1, 5, 21);

	$targetDay = $customDate->min($date);

	return $targetDay;

	if ($targetDay->addDays(2)->eq($customDate))
	{
		return 'ok';
	}
	else
	{
		return 'not ok';
	}

});