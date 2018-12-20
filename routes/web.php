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
Route::get('/logout', function(){
    return view('admin.login');
});
Route::group(['middleware' => 'auth'], function(){
    Route::get('/changePassword', 'UserController@showPasswordChangeForm')->name('changePassword');
    Route::patch('/changePassword', 'UserController@changePassword')->name('updatePassword');
});
Route::prefix('admin')->name('admin.')->middleware('role:administrator|superadministrator|agent|employer')->group(function () {
    Route::get('/', function(){
        return view('admin.index');
    })->name('home');

    /*Notification*/
    Route::get('/notifications/all', 'Admin\NotificationController@showAllNotification')->name('showAllNotification');
    Route::get('/notifications/mark-all-as-read', 'Admin\NotificationController@markAllAsRead')->name('markAllAsRead');
    Route::get('/notifications/read/{id}', 'Admin\NotificationController@readSingleNotification')->name('readSingleNotification');
    Route::get('/notifications/delete/{id}', 'Admin\NotificationController@deleteSingleNotification')->name('deleteSingleNotification');
    

    /*Publish Unpublish*/
    Route::get('/publish/{table}/{id}', 'Admin\StatusController@publish')->name('publish');
    Route::get('/unpublish/{table}/{id}', 'Admin\StatusController@unpublish')->name('unpublish');

    /*Employer*/
    Route::get('/employer/approve/{id}', 'Admin\EmployerController@approve')->name('employer.approve');
    Route::get('/employer/reject/{id}', 'Admin\EmployerController@reject')->name('employer.reject');
    Route::get('/agent/restore/{id}', 'Admin\AgentController@restore')->name('agent.restore');
    Route::get('/getEmployersData', 'Admin\EmployerController@getEmployersData')->name('getEmployersData');
    Route::get('/employer-application', 'Admin\EmployerController@employerApplication')->name('employerApplication');
    Route::get('/getEmployersApplicationData', 'Admin\EmployerController@getEmployersApplicationData')->name('getEmployersApplicationData');
    Route::resource('/employer', 'Admin\EmployerController');

    Route::get('/employer-demands', 'Admin\EmployerController@employerDemands')->name('employerDemands');
    Route::get('/getEmployersDemandData', 'Admin\EmployerController@getEmployersDemandData')->name('getEmployersDemandData');
    Route::post('/assignDemandAgent', 'Admin\EmployerController@assignDemandAgent')->name('assignDemandAgent');
    Route::post('/proposeGWToDemand', 'Admin\EmployerController@proposeGWToDemand')->name('proposeGWToDemand');
    Route::post('/finalizeGWToDemand', 'Admin\EmployerController@finalizeGWToDemand')->name('finalizeGWToDemand');

    /*Agent*/
    Route::get('/agent/approve/{id}', 'Admin\AgentController@approve')->name('agent.approve');
    Route::get('/agent/reject/{id}', 'Admin\AgentController@reject')->name('agent.reject');
    Route::get('/agent/restore/{id}', 'Admin\AgentController@restore')->name('agent.restore');
    Route::get('/getAgentsData', 'Admin\AgentController@getAgentsData')->name('getAgentsData');
    Route::get('/agent-application', 'Admin\AgentController@agentApplication')->name('agentApplication');
    Route::get('/getAgentsApplicationData', 'Admin\AgentController@getAgentsApplicationData')->name('getAgentsApplicationData');
    Route::get('/rejected-agent-application', 'Admin\AgentController@rejectedAgentApplication')->name('rejectedAgentApplication');
    Route::get('/getRejectedAgentApplicationData', 'Admin\AgentController@getRejectedAgentApplicationData')->name('getRejectedAgentApplicationData');
    Route::resource('/agent', 'Admin\AgentController');
    Route::get('/downloadFiles', 'Admin\AgentController@downloadFiles')->name('downloadFiles');

    /*Professional*/
    Route::get('/getProfessionalsData', 'Admin\ProfessionalController@getProfessionalsData')->name('getProfessionalsData');
    Route::resource('/professional', 'Admin\ProfessionalController');

    /*Worker*/
    Route::get('/getWorkersData', 'Admin\WorkerController@getWorkersData')->name('getWorkersData');
    Route::resource('/worker', 'Admin\WorkerController');

    /*Maid*/
    Route::get('/getMaidsData', 'Admin\MaidController@getMaidsData')->name('getMaidsData');
    Route::resource('/maid', 'Admin\MaidController');

    /*Settings*/
    Route::resource('/country', 'Admin\CountryController');
    Route::get('/getCountryData', 'Admin\CountryController@getCountryData')->name('getCountryData');

    Route::resource('/religion', 'Admin\ReligionController');
    Route::get('/getReligionData', 'Admin\ReligionController@getReligionData')->name('getReligionData');

    Route::resource('/language', 'Admin\LanguageController');
    Route::get('/getLanguageData', 'Admin\LanguageController@getLanguageData')->name('getLanguageData');

    Route::resource('/gender', 'Admin\GenderController');
    Route::get('/getGenderData', 'Admin\GenderController@getGenderData')->name('getGenderData');

    Route::resource('/maritalStatus', 'Admin\MaritalStatusController');
    Route::get('/getMaritalStatusData', 'Admin\MaritalStatusController@getMaritalStatusData')->name('getMaritalStatusData');
    
    Route::resource('/skillLevel', 'Admin\SkillLevelController');
    Route::get('/getSkillLevelData', 'Admin\SkillLevelController@getSkillLevelData')->name('getSkillLevelData');

    Route::resource('/skill', 'Admin\SkillController');
    Route::get('/getSkillData', 'Admin\SkillController@getSkillData')->name('getSkillData');
    
    Route::resource('/educationLevel', 'Admin\EducationLevelController');
    Route::get('/getEducationLevelData', 'Admin\EducationLevelController@getEducationLevelData')->name('getEducationLevelData');
    
    Route::resource('/downloads', 'Admin\DownloadsController');
    Route::get('/getDownloadsData', 'Admin\DownloadsController@getDownloadsData')->name('getDownloadsData');

    Route::resource('/sector', 'Admin\SectorController');
    Route::get('/getSectorData', 'Admin\SectorController@getSectorData')->name('getSectorData');
    Route::get('/getSubsectors/{id}', 'Admin\SectorController@getSubsectors')->name('getSubsectors');

    Route::resource('/subSector', 'Admin\SubSectorController');
});

Route::get('/', 'HomeController@index')->name('home');
Route::group(['middleware' => 'auth'], function(){
    Route::get('/profile/{public}', 'ProfileController@public')->name('profile.public');
    Route::resource('profile', 'ProfileController')->except('destroy');
    Route::resource('experience', 'ExperienceController')->except('destroy');
});
Route::get('agent/createuser', 'AgentProfileController@createuser')->name('agent.createuser');
Route::post('agent/saveuser', 'AgentProfileController@saveuser')->name('agent.saveuser');
Route::get('agent/print/{id}/{data}', 'AgentProfileController@print')->name('agent.print');
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
    Route::get('/', 'EmployerProfileController@index')->name('employer.index');
    Route::get('/register', 'EmployerProfileController@create')->name('employer.register');
    Route::get('/profile', 'EmployerProfileController@show')->name('employer.show');
    Route::get('/{id}/edit', 'EmployerProfileController@edit')->name('employer.edit');
    Route::patch('/{id}', 'EmployerProfileController@update')->name('employer.update');
    Route::get('/view/{public_id}', 'EmployerProfileController@public')->name('employer.public');
    Route::get('/getAllMaids', 'EmployerProfileController@getAllMaids')->name('getAllMaids');
    Route::post('/sendOffer', 'EmployerProfileController@sendOffer')->name('sendOffer');
    // Demand section
    Route::post('/saveDemand', 'EmployerProfileController@saveDemand')->name('saveDemand');
    Route::get('/getAllDemands', 'EmployerProfileController@getAllDemands')->name('getAllDemands');
    Route::get('/demand/{id}', 'EmployerProfileController@viewDemand')->name('demand');
    Route::get('/proposedGW/{damand_id}', 'EmployerProfileController@proposedGW')->name('proposedGW');
    Route::post('/confirmGWToDemand', 'EmployerProfileController@confirmGWToDemand')->name('confirmGWToDemand');

    Route::get('/getDownloadsFile/{type}', 'CommonController@getDownloadsFile')->name('getDownloadsFile');
});

/*Job*/
route::resource('/job', 'JobController');

/*Professional*/
route::resource('/professional', 'ProfessionalProfileController');
route::get('/qualification/{user}/edit', 'ProfessionalProfileController@editQualification')->name('qualification.edit');
route::patch('/qualification/{user}', 'ProfessionalProfileController@updateQualification')->name('qualification.update');

route::get('/professionalExperience/{user}/edit', 'ProfessionalProfileController@editProfessionalExperience')->name('professionalExperience.edit');
route::patch('/professionalExperience/{user}', 'ProfessionalProfileController@updateProfessionalExperience')->name('professionalExperience.update');