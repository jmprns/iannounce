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

Route::get('/', function () {
    return redirect('/dashboard');
});

Auth::routes();

Route::get('/dashboard', 'DashboardController@index');
Route::post('/dashboard', 'DashboardController@send');

Route::prefix('announcement')->group(function (){
	Route::get('/all', 'AnnouncementController@all_form');
	Route::post('/all', 'AnnouncementController@all_announce');
	Route::get('/department', 'AnnouncementController@dept_form2');
	Route::post('/department', 'AnnouncementController@dept_announce2');
	Route::get('/csg', 'AnnouncementController@dept_form');
	Route::post('/csg', 'AnnouncementController@dept_announce');
	Route::get('/bulk', 'AnnouncementController@bulk_form');
	Route::post('/bulk', 'AnnouncementController@bulk_announce');
	Route::get('/individual', 'AnnouncementController@one_form');
	Route::post('/individual', 'AnnouncementController@one_announce');

});

Route::prefix('subscriber')->group(function (){
	Route::get('/', 'SubscriberController@index');
	Route::get('/add', 'SubscriberController@create');
	Route::post('/store', 'SubscriberController@store');
	Route::get('/edit/{id}', 'SubscriberController@edit');
	Route::post('/update/{id}', 'SubscriberController@update');
	Route::get('/delete/{id}', 'SubscriberController@destroy');
});

Route::prefix('message')->group(function() {
	Route::get('outbox', 'MessageController@outbox');
	Route::post('outbox', 'MessageController@message');
	Route::get('compose', 'MessageController@compose');
	Route::post('compose', 'MessageController@send');
});

Route::prefix('settings')->group(function() {
	Route::get('/', 'SettingsController@index');
	Route::post('/', 'SettingsController@settings');
});




