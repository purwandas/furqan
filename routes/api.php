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


Route::group(['prefix' => 'blog-category','middleware' => ['auth:api']], function() {
	Route::get('', 'BlogCategoryController@list')->name('blog-category.list');
	Route::post('', 'BlogCategoryController@store')->name('blog-category.create');
	Route::get('{id}', 'BlogCategoryController@detail')->name('blog-category.detail')->where('id', '[0-9]+');
	Route::put('{id}', 'BlogCategoryController@update')->name('blog-category.edit')->where('id', '[0-9]+');
	Route::delete('{id}', 'BlogCategoryController@destroy')->name('blog-category.delete')->where('id', '[0-9]+');
	Route::post('datatable', 'BlogCategoryController@datatable')->name('blog-category.datatable');
	Route::post('export-xls', 'BlogCategoryController@exportXls')->name('blog-category.export-xls');
	Route::post('export-pdf', 'BlogCategoryController@exportPdf')->name('blog-category.export-pdf');
	Route::post('import', 'BlogCategoryController@import')->name('blog-category.import');
	Route::post('select2', 'BlogCategoryController@select2')->name('blog-category.select2');
});

Route::group(['prefix' => 'language','middleware' => ['auth:api']], function() {
	Route::get('', 'LanguageController@list')->name('language.list');
	Route::post('', 'LanguageController@store')->name('language.create');
	Route::get('{id}', 'LanguageController@detail')->name('language.detail')->where('id', '[0-9]+');
	Route::put('{id}', 'LanguageController@update')->name('language.edit')->where('id', '[0-9]+');
	Route::delete('{id}', 'LanguageController@destroy')->name('language.delete')->where('id', '[0-9]+');
	Route::post('datatable', 'LanguageController@datatable')->name('language.datatable');
	Route::post('export-xls', 'LanguageController@exportXls')->name('language.export-xls');
	Route::post('export-pdf', 'LanguageController@exportPdf')->name('language.export-pdf');
	Route::post('import', 'LanguageController@import')->name('language.import');
	Route::post('select2', 'LanguageController@select2')->name('language.select2');
});

Route::group(['prefix' => 'blog','middleware' => ['auth:api']], function() {
	Route::get('', 'BlogController@list')->name('blog.list');
	Route::post('', 'BlogController@store')->name('blog.create');
	Route::get('{id}', 'BlogController@detail')->name('blog.detail')->where('id', '[0-9]+');
	Route::put('{id}', 'BlogController@update')->name('blog.edit')->where('id', '[0-9]+');
	Route::delete('{id}', 'BlogController@destroy')->name('blog.delete')->where('id', '[0-9]+');
	Route::post('datatable', 'BlogController@datatable')->name('blog.datatable');
	Route::post('export-xls', 'BlogController@exportXls')->name('blog.export-xls');
	Route::post('export-pdf', 'BlogController@exportPdf')->name('blog.export-pdf');
	Route::post('import', 'BlogController@import')->name('blog.import');
	Route::post('select2', 'BlogController@select2')->name('blog.select2');
});