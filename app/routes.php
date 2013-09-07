<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});

/**
 * Old redirects
 */
Route::get('product.json', function() {
    return Redirect::to('product?' . http_build_query(Input::all()));
});

Route::get('types.json', function() {
    return Redirect::to('product?' . http_build_query(Input::all()));
});

/**
 * Api resources
 */
Route::resource('product', 'ProductController');
Route::resource('tag', 'TagController');

/**
 * Route models
 */
Route::model('product', 'Product');
Route::model('tag', 'Tag');