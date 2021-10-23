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