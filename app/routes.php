<?php

/**
 * Home Page
 */
Route::group(array('before' => 'force.nonssl'), function()
{
	Route::any('/','PageController@showHome');
	Route::any('/home','PageController@showHome');
});

/**
 * Process
 */
Route::get('/process', array('before' => 'force.nonssl', function()
{
    return View::make('pages.process');
}));


/**
 * FAQs
 */
Route::group(array('before' => 'force.nonssl'), function()
{
	Route::get('/faq','FaqController@showFaqPage');
	Route::any('/faq/edit', 'FaqController@editFaq');
});

/**
 *
 * Mailing list routes
 */
Route::group(array('before' => 'force.nonssl'), function()
{
	Route::post('/joinlist','MailRecipientController@joinList');
});

/**
 * Contact Us
 */
Route::group(array('before' => 'force.ssl'), function()
{
	Route::get('/contactus', 'ContactusController@getContactus');
	Route::post('/contactus', 'ContactusController@postContactus');
});

/**
 * Search site
 */
Route::group(array('before' => 'force.nonssl'), function()
{
	Route::get('/search','SearchController@showSearchPage');
	Route::post('/search','SearchController@performSearch');
});


/**
 * Blog Routes
 */
Route::group(array('before' => 'force.nonssl'), function()
{
	Route::controller('/post', 'BlogController');
	Route::post('/searchblog','SearchController@performBlogSearch');
	Route::get('/blog/{year?}/{month?}', 'PostsController@index')->where(array('year' => '\d{4}', 'month' => '\d{2}'));
	Route::get('/blog/{slug}', 'PostsController@view');
	Route::get('/blog.rss', 'PostsController@rss');
});


/**
 * User/account routes
 */

Route::group(array('before' => 'force.ssl'), function()
{
	Route::controller('/users', 'UserController');
	Route::get('/verifyaccount','UsersPendingController@validateUser');
	Route::controller('/password', 'RemindersController');
	Route::controller('/submit', 'SubmitController');
});


/**
 *
 * Ajax routes
 */
Route::group(array('before' => 'force.nonssl'), function()
{
	Route::controller('/ajax','AjaxController');
});

/**
 * Menu Routes
 */
Route::group(array('before' => 'force.nonssl'), function()
{
	Route::controller('/menu', 'MenuController');
});

/**
 * Admin Routes
 */
Route::group(array('before' => 'auth|force.ssl'), function()
{
	Route::controller('/admin', 'AdminController');
});




/**
 * Page Routes
 */
Route::group(array('before' => 'force.nonssl'), function()
{
	Route::get('{pagename?}','PageController@showPage');
	Route::post('/page/edit','PageController@editPage');
	Route::post('/page/savepage','PageController@savePage');
	Route::get('/page/create', array('before' => 'auth', function()
	{
		return View::make('pages.createpage');
	}));
});



