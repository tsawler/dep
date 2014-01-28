<?php
/*
|------------------------------------------------------------------------------------
|
|  General Routes
|
|------------------------------------------------------------------------------------
*/

Route::any('/', function()
	{
		return View::make('home');
	});

/*
|------------------------------------------------------------------------------------
|
| Page Routes
|
|------------------------------------------------------------------------------------
*/
Route::get('page/{pageid}/{pagename?}', function($pageid,$pagename)
	{
		return View::make('defaultpage');
	})->where('pageid', '[0-9]+');

Route::post('/saveeditedpage', array('before' => 'auth', function()
	{
		// make sure we are admin
		if (Auth::user()->access_level == 3){
			$page = Page::find(Input::get('page_id'));
			$page->page_content = Input::get('thedata');
			$page->page_title = Input::get('thetitledata');
			$page->save();
			return "Page updated successfully";
		}
	}));

Route::get('/page/create', array('before' => 'auth', function()
	{
		return View::make('createpage');
	}));

/*
|------------------------------------------------------------------------------------
|
| User/Account Routes
|
|------------------------------------------------------------------------------------
*/
Route::controller('/users', 'UserController');

Route::get('/verifyaccount','UsersPendingController@validateUser');

Route::controller('password', 'RemindersController');

Route::get('/authors', 'AuthorController@listAuthors');

Route::controller('/submit', 'SubmitController');

/*
|------------------------------------------------------------------------------------
|
| Blog Routes
|
|------------------------------------------------------------------------------------
*/
Route::controller('/post', 'BlogController');
