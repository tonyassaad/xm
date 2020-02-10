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
    return view('welcome');
});

Route::get('/',['uses'=>'CompanyController@index']);
Route::post('/company-historical-quotes',['uses'=>'CompanyController@getHistoricalQuotes']);
Route::get('/company-chart/{company?}/{startDate?}/{endDate?}',['uses'=>'CompanyController@displayChart']);
