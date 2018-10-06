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
Route::get('/admin/login', function(){
    return view('admin.login');
});
Route::prefix('admin')->name('admin.')->middleware('role:administrator|superadministrator|agent')->group(function () {
    Route::get('/', function(){
        return view('admin.index');
    })->name('home');
    /*Agent*/
    Route::get('/agent/approve/{id}', 'Admin\AgentController@approve')->name('agent.approve');
    Route::get('/agent/reject/{id}', 'Admin\AgentController@reject')->name('agent.reject');
    Route::get('/getAgentsData', 'Admin\AgentController@getAgentsData')->name('getAgentsData');
    Route::get('/agent-application', 'Admin\AgentController@agentApplication')->name('agentApplication');
    Route::get('/getAgentsApplicationData', 'Admin\AgentController@getAgentsApplicationData')->name('getAgentsApplicationData');
    Route::resource('/agent', 'Admin\AgentController');

    /*Worker*/
    Route::get('/getWorkersData', 'Admin\WorkerController@getWorkersData')->name('getWorkersData');
    Route::resource('/worker', 'Admin\WorkerController');

    /*Maid*/
    Route::get('/getMaidsData', 'Admin\MaidController@getMaidsData')->name('getMaidsData');
    Route::resource('/maid', 'Admin\MaidController');

    /*Settings*/
    Route::resource('/country', 'Admin\CountryController');
    Route::get('/getCountryData', 'Admin\CountryController@getCountryData')->name('getCountryData');
});

Route::get('/', 'HomeController@index')->name('home');
Route::get('/profile/{public}', 'ProfileController@public')->name('profile.public');
Route::group(['middleware' => 'auth'], function(){
    Route::resource('profile', 'ProfileController')->except('destroy');
    Route::resource('experience', 'ExperienceController')->except('destroy');
});
Route::get('agent/createuser', 'AgentProfileController@createuser')->name('agent.createuser');
Route::post('agent/saveuser', 'AgentProfileController@saveuser')->name('agent.saveuser');
Route::resource('agent', 'AgentProfileController')->except('destroy');

Route::get('/maids', 'HomeController@maids')->name('maids');
Route::any('/maids/search', 'HomeController@maidsearch')->name('maids.search');

Route::get('/workers', 'HomeController@workers')->name('workers');
Route::any('/workers/search', 'HomeController@workersearch')->name('workers.search');

Route::get('/CadidateStatusView', function(){
    return view('CadidateStatusView');
})->name('CadidateStatusView');

/*Employer*/
Route::prefix('employer')->group(function(){
    Route::get('/register', 'EmployerProfileController@create');
});