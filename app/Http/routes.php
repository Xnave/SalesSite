<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::get('/', 'WelcomeController@index');
Route::get('/', function () {
	return view('index');
});



Route::group(['middleware' => 'admin.auth'] , function() {
	Route::resource('Brands', 'BrandsController');
	Route::resource('Centers', 'CentersController'); /* TODO: show all records to the public */
	Route::resource('Stores', 'StoresController'); /* TODO: show all records to the public */
} );

Route::get('allBrands','BrandsController@publicIndex');


Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::resource('brand', 'BrandController');

Route::get('{any}', function(){
	return view('404');
})->where('any', '.+');
