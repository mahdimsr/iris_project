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

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');


// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

// Email Verification Routes...
Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
Route::get('email/verify/{id}', 'Auth\VerificationController@verify')->name('verification.verify');
Route::get('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', function () {
    return view('welcome');
});
Route::middleware('auth')->group(function () {
    Route::redirect('/home', 'dashboard/view');
    Route::redirect('/', 'dashboard/view');
    Route::get('getUsers' ,function(){
        $q = request('q');#str_replace(' ','%20' , request('q'));
        $search_exploded = explode(" ", $q);
        $x = 0;
        $construct = " ";
        foreach ($search_exploded as $search_each) {
            $x++;
            if ($x == 1)
                $construct .= "name LIKE '%$search_each%' ";
            else
                $construct .= "AND name LIKE '%$search_each%' ";
        }

        return DB::table('user')->whereRaw($construct)->where('id' , '!=' , auth()->user()->id)->take(15)->get();
    });

    // Registration Routes...
    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'Auth\RegisterController@register');

    Route::prefix('dashboard')->group(function () {
        Route::get('/view', 'DashboardController@dashboardView')->name('dashboard');


        //meting
        Route::prefix('meeting')->group(function () {
            Route::get('/view', 'MeetingController@View')->name('meetings');
            Route::get('/show/{Meeting}', 'MeetingController@Show')->name('meetings-show');
            Route::get('/insertView', 'MeetingController@insertView');
            Route::post('/insert', 'MeetingController@insert');
            Route::get('/editView/{Meeting}', 'MeetingController@editView')->name('meetings-edit');
            Route::post('/edit', 'MeetingController@edit')->name('meetings-edit-post');
            Route::get('/remove/{Meeting}', 'MeetingController@remove')->name('meetings-remove');
            Route::post('/document/{Meeting}', 'MeetingController@document')->name('meetings-document');
        });

        //meting
        Route::prefix('message')->group(function () {
            Route::get('/send', 'MessageController@sendView')->name('message-send');
            Route::post('/send', 'MessageController@send')->name('message-send-post');
            Route::get('/receive-list', 'MessageController@receiveListView')->name('message-receive-list');
            Route::get('/send-list', 'MessageController@sendListView')->name('message-send-list');
            Route::get('/show/{Message}', 'MessageController@show')->name('message-show');
        });

        Route::prefix('news')->group(function () {
            Route::get('/send', 'NewsController@sendView')->name('news-send');
            Route::post('/send', 'NewsController@send')->name('news-send-post');
            Route::get('/list', 'NewsController@list')->name('news-list');
            Route::get('/show/{Message}', 'NewsController@show')->name('news-show');
        });


        Route::get('statics', 'StaticsController@index')->name('statics');

        Route::get('/download/{File}', 'FileController@getDownload')->name('download-file');

        Route::get('/file/accept/{File}', 'FileController@accept')->name('accept-file');
        Route::get('/file/reject/{File}', 'FileController@reject')->name('reject-file');

    });
    Route::redirect('dashboard/view' , 'statics');
})
;

Route::get('test', function () {

    $event = \App\Model\Event::all();

    return $event;
});

