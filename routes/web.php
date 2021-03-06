<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::group(['middleware' => ['auth']], function() {
	Route::get('profile', 'UserController@formProfile')->name('profile.index');
	Route::get('password', 'UserController@formPassword')->name('password.index');

	Route::group(['prefix' => 'blog'], function() {
		Route::get('', 'BlogController@index')->name('blog.index');
		Route::get('import-template', 'BlogController@importTemplate')->name('blog.import-template');
	});
});



Route::group(['middleware' => ['auth', 'admin']], function() {

	Route::group(['prefix' => 'role'], function() {
		Route::get('', 'RoleController@index')->name('role.index');
		Route::get('import-template', 'RoleController@importTemplate')->name('role.import-template');
	});

	Route::group(['prefix' => 'user'], function() {
		Route::get('', 'UserController@index')->name('user.index');
		Route::get('import-template', 'UserController@importTemplate')->name('user.import-template');
	});

	Route::group(['prefix' => 'blog-category'], function() {
		Route::get('', 'BlogCategoryController@index')->name('blog-category.index');
		Route::get('import-template', 'BlogCategoryController@importTemplate')->name('blog-category.import-template');
	});

	Route::group(['prefix' => 'language'], function() {
		Route::get('', 'LanguageController@index')->name('language.index');
		Route::get('import-template', 'LanguageController@importTemplate')->name('language.import-template');
	});

	Route::group(['prefix' => 'province'], function() {
		Route::get('', 'ProvinceController@index')->name('province.index');
		Route::get('import-template', 'ProvinceController@importTemplate')->name('province.import-template');
	});

	Route::group(['prefix' => 'city'], function() {
		Route::get('', 'CityController@index')->name('city.index');
		Route::get('import-template', 'CityController@importTemplate')->name('city.import-template');
	});

});

