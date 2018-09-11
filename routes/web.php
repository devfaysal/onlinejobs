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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/test', function(){
    return view('layouts.new');
});

Route::get('/', 'HomeController@index')->name('home');
Route::get('/profile/{public}', 'ProfileController@public')->name('profile.public');
Route::group(['middleware' => 'auth'], function(){
    Route::resource('profile', 'ProfileController')->except('destroy');
    Route::resource('experience', 'ExperienceController')->except('destroy');
});
Route::get('/maids', 'HomeController@maids')->name('maids');
Route::any('/maids/search', 'HomeController@maidsearch')->name('maids.search');

Route::get('/workers', 'HomeController@workers')->name('workers');
Route::any('/workers/search', 'HomeController@workersearch')->name('workers.search');