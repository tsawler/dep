<?php

/**
 * Home Page
 */
Route::any('/','PageController@showHome');
Route::any('/home','PageController@showHome');

/**
 * Search site
 */
Route::get('/search','SearchController@showSearchPage');
Route::post('/search','SearchController@performSearch');

/**
 * Page Routes
 */
Route::get('{pagename?}','PageController@showPage');

Route::post('/page/edit','PageController@editPage');

Route::get('/page/create', array('before' => 'auth', function()
	{
		return View::make('pages.createpage');
	}));


/**
 * User/account routes
 */
Route::controller('/users', 'UserController');

Route::get('/verifyaccount','UsersPendingController@validateUser');

Route::controller('password', 'RemindersController');

Route::controller('/submit', 'SubmitController');


/**
 * Blog Routes
 */
Route::controller('/post', 'BlogController');


/**
 * Menu Routes
 */
Route::controller('/menu', 'MenuController');
