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
	Route::get('/view', 'DashboardController@dashboardView');


	//meting
	Route::prefix('meeting')->group(function()
	{
        Route::get('/view', 'MeetingController@View')->name('meetings');
        Route::get('/show/{Meeting}', 'MeetingController@Show')->name('meetings-show');
		Route::get('/insertView', 'MeetingController@insertView');
		Route::post('/insert', 'MeetingController@insert');
        Route::get('/editView/{Meeting}', 'MeetingController@editView')->name('meetings-edit');
        Route::post('/edit', 'MeetingController@edit')->name('meetings-edit-post');
		Route::get('/remove/{Meeting}', 'MeetingController@remove')->name('meetings-remove');
	});

});

Route::get('test', function()
{

	$event = \App\Model\Event::all();

	return $event;
});