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

Route::get("/login","UserController@login")->name("login");
Route::post("/login","UserController@makeLogin")->name("makeLogin");

Route::middleware(['auth.doctor'])->group(function() {

    Route::get("/",function() {
        return redirect()->route("schedules");
    });
    Route::get("/logout","UserController@logout");

    Route::post("/countries","AddressController@getCountries");
    Route::post("/states","AddressController@getStates");
    Route::post("/cities","AddressController@getCities");
    Route::post("/searchByCep","AddressController@searchByCep");
    Route::post("/professional_advices","DoctorsController@getProfessionalAdvices");

    Route::prefix('schedules')->group(function() {
        Route::get("/","SchedulesController@index")->name("schedules");
        Route::post("/list","SchedulesController@getSchedules")->name("schedules.list");
        Route::post("/add","SchedulesController@makeAdd")->name("schedules.make.add");
        Route::post("/delete","SchedulesController@delete")->name("schedules.delete");
    });

    Route::prefix('specialties')->group(function() {
		Route::get("/","SpecialtiesController@index")->name("specialties");
		Route::get("/list","SpecialtiesController@getSpecialties")->name("specialties.list");
		Route::post("/add","SpecialtiesController@makeAdd")->name("specialties.make.add");
		Route::delete("/delete/{id}","SpecialtiesController@delete")->name("specialties.delete");
    });

    Route::prefix('rooms')->group(function() {
		Route::get("/","RoomsController@index")->name("rooms");
		Route::get("/list","RoomsController@getrooms")->name("rooms.list");
		Route::post("/add","RoomsController@makeAdd")->name("rooms.make.add");
		Route::delete("/delete/{id}","RoomsController@delete")->name("rooms.delete");
	});

    Route::prefix('patients')->group(function() {
        Route::get("/","PatientsController@index")->name("patients");
        Route::get("/list","PatientsController@getPatients")->name("patients.list");
        Route::post("/add","PatientsController@makeAdd")->name("patients.make.add");
        Route::delete("/delete/{id}","PatientsController@delete")->name("patients.delete");
    });

    Route::prefix('doctors')->group(function() {
        Route::get("/","DoctorsController@index")->name("doctors");
        Route::get("/list","DoctorsController@getDoctors")->name("doctors.list");
        Route::post("/add","DoctorsController@makeAdd")->name("doctors.make.add");
        Route::post("/getSpecialtiesByDoctor","DoctorsController@getSpecialtiesByDoctor")->name("doctors.getSpecialtiesByDoctor");
        Route::delete("/delete/{id}","DoctorsController@delete")->name("doctors.delete");
    });

    Route::prefix("user")->group(function() {
        Route::get("/","UserController@index")->name("user");
        Route::get("/list","UserController@getUsers")->name("user.list");
        Route::post("/add","UserController@makeAdd")->name("user.make.add");
        Route::delete("/delete/{id}","UserController@delete")->name("user.delete");
        Route::get("/loged-user", "UserController@getLogeUser")->name("user.loged-user");
	});

	Route::prefix("acl")->group(function(){
	    Route::get("/", "AclController@index")->name('acl.list');
	    Route::post("/save", "AclController@saveACL")->name('acl.save');
	    Route::post("/get", "AclController@getAcl")->name('acl.get');
    });
});

