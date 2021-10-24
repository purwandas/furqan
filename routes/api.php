<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'job-trace','middleware' => ['auth:api']], function() {
	Route::post('datatable', 'UtilController@datatable')->name('job-trace.data');
});

	// GLOBAL
	Route::post('province/select2', 'ProvinceController@select2')->name('province.select2');
	Route::post('city/select2', 'CityController@select2')->name('city.select2');

	Route::group(['middleware' => ['auth:api']], function() {
		Route::put('update-profile', 'UserController@updateProfile')->name('profile.edit');
		Route::put('update-password', 'UserController@updatePassword')->name('password.edit');
	});


Route::group(['prefix' => 'role','middleware' => ['auth:api']], function() {
	Route::get('', 'RoleController@list')->name('role.list');
	Route::post('', 'RoleController@store')->name('role.create');
	Route::get('{id}', 'RoleController@detail')->name('role.detail')->where('id', '[0-9]+');
	Route::put('{id}', 'RoleController@update')->name('role.edit')->where('id', '[0-9]+');
	Route::delete('{id}', 'RoleController@destroy')->name('role.delete')->where('id', '[0-9]+');
	Route::post('datatable', 'RoleController@datatable')->name('role.datatable');
	Route::post('export-xls', 'RoleController@exportXls')->name('role.export-xls');
	Route::post('export-pdf', 'RoleController@exportPdf')->name('role.export-pdf');
	Route::post('import', 'RoleController@import')->name('role.import');
	Route::post('select2', 'RoleController@select2')->name('role.select2');
});

Route::group(['prefix' => 'user','middleware' => ['auth:api']], function() {
	Route::get('', 'UserController@list')->name('user.list');
	Route::post('', 'UserController@store')->name('user.create');
	Route::get('{id}', 'UserController@detail')->name('user.detail')->where('id', '[0-9]+');
	Route::put('{id}', 'UserController@update')->name('user.edit')->where('id', '[0-9]+');
	Route::delete('{id}', 'UserController@destroy')->name('user.delete')->where('id', '[0-9]+');
	Route::post('datatable', 'UserController@datatable')->name('user.datatable');
	Route::post('export-xls', 'UserController@exportXls')->name('user.export-xls');
	Route::post('export-pdf', 'UserController@exportPdf')->name('user.export-pdf');
	Route::post('import', 'UserController@import')->name('user.import');
	Route::post('select2', 'UserController@select2')->name('user.select2');
});

Route::group(['prefix' => 'province','middleware' => ['auth:api']], function() {
	Route::get('', 'ProvinceController@list')->name('province.list');
	Route::post('', 'ProvinceController@store')->name('province.create');
	Route::get('{id}', 'ProvinceController@detail')->name('province.detail')->where('id', '[0-9]+');
	Route::put('{id}', 'ProvinceController@update')->name('province.edit')->where('id', '[0-9]+');
	Route::delete('{id}', 'ProvinceController@destroy')->name('province.delete')->where('id', '[0-9]+');
	Route::post('datatable', 'ProvinceController@datatable')->name('province.datatable');
	Route::post('export-xls', 'ProvinceController@exportXls')->name('province.export-xls');
	Route::post('export-pdf', 'ProvinceController@exportPdf')->name('province.export-pdf');
	Route::post('import', 'ProvinceController@import')->name('province.import');
});

Route::group(['prefix' => 'city','middleware' => ['auth:api']], function() {
	Route::get('', 'CityController@list')->name('city.list');
	Route::post('', 'CityController@store')->name('city.create');
	Route::get('{id}', 'CityController@detail')->name('city.detail')->where('id', '[0-9]+');
	Route::put('{id}', 'CityController@update')->name('city.edit')->where('id', '[0-9]+');
	Route::delete('{id}', 'CityController@destroy')->name('city.delete')->where('id', '[0-9]+');
	Route::post('datatable', 'CityController@datatable')->name('city.datatable');
	Route::post('export-xls', 'CityController@exportXls')->name('city.export-xls');
	Route::post('export-pdf', 'CityController@exportPdf')->name('city.export-pdf');
	Route::post('import', 'CityController@import')->name('city.import');
});
