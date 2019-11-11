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

Route::middleware(['guest'])->group(function () {
  Route::post('register', 'AuthenticateController@register');
  Route::post('login', 'AuthenticateController@login');
  
});
Route::post('refresh-token', 'AuthenticateController@refreshToken');

Route::middleware(['jwt.auth'])->group(function () {  
  Route::resource('banks', 'BanksController');
  Route::resource('/accounts', 'BankAccountController'); 
  Route::resource('churches', 'ChurchesController');
  Route::resource('/churches/hierarchies', 'HierarchiesController');
  Route::resource('civilstates', 'CivilStatesController');
  Route::resource('jobstates', 'JobstatesController');
  Route::resource('ministries', 'MinistriesController');
  //Route::resource('members', 'updateMembersController');
  Route::resource('/updatemember', 'updateMembersController');
  Route::resource('/genders', 'GendersController');
  Route::resource('/countries', 'CountriesController');
  Route::resource('/bloods', 'BloodTypesController');
  Route::resource('/allcivilstates', 'CivilStatesController');
  Route::resource('/alljobstates', 'JobstatesController');  
  Route::post('logout', 'AuthenticateController@logout');
    

});
