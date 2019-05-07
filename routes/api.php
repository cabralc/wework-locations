<?php

use App\Location;
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

Route::get('locations', 'LocationController@index');
Route::get("locations/{location}", "LocationController@show");
Route::post('locations', 'LocationController@store');
Route::put('locations/{id}', 'LocationController@update');
Route::delete('locations/{id}', 'LocationController@delete');

Route::get('locations/{location}/floors', 'FloorController@showFloors');
Route::get('locations/{location}/desks-amount', 'FloorController@desksAmount');
Route::post('locations/{location}/floors-amount', 'FloorController@floorsAmount');
Route::post('locations/{location}/floors', 'FloorController@store');

Route::get("countries", "CountryController@index");
Route::get("country/{country}/locations", "CountryController@showLocations");
Route::get("country/{country}/earliest-location", "CountryController@earliestLocation");
Route::get("country/{country}/opening-next-month", "CountryController@openingNextMonth");
