<?php

/**
 * Home Page
 */
//Route::any('/','PageController@showHome');
//Route::any('/home','PageController@showHome');
Route::any('/', array('before' => 'cache', 'after' => 'cache', 'uses' => 'PageController@showHome'));
Route::any('/home', array('before' => 'cache', 'after' => 'cache', 'uses' => 'PageController@showHome'));

/**
 *
 * Mailing list routes
 */
Route::post('/joinlist','MailRecipientController@joinList');


/**
 * Search site
 */
Route::get('/search','SearchController@showSearchPage');
Route::post('/search','SearchController@performSearch');


/**
 * Page Routes
 */
 
//Route::get('{pagename?}','PageController@showPage');

Route::get('{pagename?}', array('before' => 'cache', 'after' => 'cache', 'uses' => 'PageController@showPage'));

Route::post('/page/edit','PageController@editPage');

Route::get('/page/create', array('before' => 'auth', function()
{
	return View::make('pages.createpage');
}));


/**
 *
 * Ajax routes
 */
Route::controller('/ajax','AjaxController');


/**
 * User/account routes
 */
Route::controller('/users', 'UserController');

Route::get('/verifyaccount','UsersPendingController@validateUser');

Route::controller('/password', 'RemindersController');

Route::controller('/submit', 'SubmitController');


/**
 * Blog Routes
 */
Route::controller('/post', 'BlogController');
Route::post('/searchblog','SearchController@performBlogSearch');


/**
 * Menu Routes
 */
Route::controller('/menu', 'MenuController');

/**
 * Admin Routes
 */
Route::get('/admin/edituser/{userid}','AdminController@showUser');
Route::post('/admin/edituser/{userid}','AdminController@saveUser');
Route::get('/admin/adminusers','AdminController@getAdminUsers');
Route::get('/admin/allusers','AdminController@getAllUsers');
Route::post('/admin/allusers','AdminController@postAllUsers');
Route::post('/admin/edituserroles/{userid}','AdminController@saveUserRoles');
