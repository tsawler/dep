<?php

/**
 * Home Page
 */
Route::any('/','PageController@showHome');
Route::any('/home','PageController@showHome');


/**
 * Process
 */
Route::get('/process', function()
{
    return View::make('pages.process');
});


/**
 * FAQs
 */
/*Route::get('/faqs', function()
{
    return View::make('pages.faqs');
}); */
/**
 * FAQs
 */
Route::get('/faq','FaqController@showFaqPage');
Route::any('/faq/edit', 'FaqController@editFaq');

/**
 *
 * Mailing list routes
 */
Route::post('/joinlist','MailRecipientController@joinList');


/**
 * Contact Us
 */
Route::get('/contactus', 'ContactusController@getContactus');
Route::post('/contactus', 'ContactusController@postContactus');


/**
 * Search site
 */
Route::get('/search','SearchController@showSearchPage');
Route::post('/search','SearchController@performSearch');


/**
 * Blog Routes
 */
Route::controller('/post', 'BlogController');
Route::post('/searchblog','SearchController@performBlogSearch');
Route::get('/blog/{year?}/{month?}', 'PostsController@index')->where(array('year' => '\d{4}', 'month' => '\d{2}'));
Route::get('/blog/{slug}', 'PostsController@view');
Route::get('/blog.rss', 'PostsController@rss');


/**
 * User/account routes
 */
//Route::controller('/users', array('before' => 'ssl',  'uses' => 'UserController'));
Route::controller('/users', 'UserController');
Route::get('/verifyaccount','UsersPendingController@validateUser');
Route::controller('/password', 'RemindersController');
Route::controller('/submit', 'SubmitController');


/**
 *
 * Ajax routes
 */
Route::controller('/ajax','AjaxController');


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
Route::get('/admin/manuscripts','AdminController@getManuscripts');
Route::get('/admin/showmanuscript/{id}', 'AdminController@getShowmanuscript');
Route::get('/admin/managems/{id}', 'AdminController@getManagems');


/**
 * Page Routes
 */
Route::get('{pagename?}','PageController@showPage');
Route::post('/page/edit','PageController@editPage');
Route::get('/page/create', array('before' => 'auth', function()
{
	return View::make('pages.createpage');
}));
Route::post('/page/savepage','PageController@savePage');
