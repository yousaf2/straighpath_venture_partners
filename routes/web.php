<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::group(['middleware' => 'auth', 'prefix' => '/'], function () {
    Route::get('{first}/{second}/{third}', 'RoutingController@thirdLevel')->name('third');
    Route::get('{first}/{second}', 'RoutingController@secondLevel')->name('second');
    Route::post('crm/customers', 'RoutingController@secondLevel')->name('second');
    Route::get('{any}', 'RoutingController@root')->name('any');

    // landing
    Route::get('', 'RoutingController@root')->name('index');

});

Route::get('users/create', 'UserController@create')->name('create');
Route::post('users/save', 'UserController@save')->name('save');
Route::get('users/edit/{$i}', 'UserController@edit')->name('edit');
Route::post('users/update', 'UserController@update')->name('update');
Route::post('users/delete/{id}', 'UserController@delete')->name('delete');
Route::get('customers/create', 'CustomerController@create')->name('create');
Route::post('customers/save', 'CustomerController@save')->name('save');
Route::get('customers/edit/{id}', 'CustomerController@edit')->name('edit');
Route::post('customers/update', 'CustomerController@update')->name('update');
Route::post('customers/delete/{id}', 'CustomerController@delete')->name('delete');
Route::get('companies/create', 'CompanyController@create')->name('create');
Route::post('companies/save', 'CompanyController@save')->name('save');
Route::get('companies/edit/{id}', 'CompanyController@edit')->name('edit');
Route::post('companies/update', 'CompanyController@update')->name('update');
Route::post('companies/delete/{id}', 'CompanyController@delete')->name('delete');
Route::post('companies/save-company', 'CompanyController@saveAjax')->name('saveAjax');
/*Route::get('coustomers/info/{id}','CustomerController@info');*/
Route::post('cun','CustomerController@cun');
Route::post('dc','CompanyController@dc');
Route::post('uci','CompanyController@uci');
