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
  Route::resource('churches', 'ChurchesController');
  Route::resource('civilstates', 'CivilStatesController');
  Route::resource('jobstates', 'JobstatesController');
  Route::resource('updatemembers', 'updateMembersController');
  Route::resource('/genders', 'GendersController');
  Route::resource('/countries', 'CountriesController');
  Route::resource('/bloods', 'BloodTypesController');
  Route::resource('/members/civilstates', 'CivilStatesController');
  Route::resource('/members/jobstates', 'JobstatesController');
  Route::resource('/banks/accounts', 'BankAccountController'); 
  Route::post('logout', 'AuthenticateController@logout');  
});
