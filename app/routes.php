<?php
// Routes

Route::any('/', function()
{
	return View::make('home');
});

Route::controller('/users', 'UserController');

Route::get('page/{pageid}/{pagename?}', function($pageid,$pagename)
{
    return View::make('defaultpage');
})->where('pageid', '[0-9]+');

Route::post('/savepage', array('before' => 'auth', function()
{
	// make sure we are admin
	if (Auth::user()->access_level == 3){
		$page = Page::find(Input::get('page_id'));
		$page->page_content = Input::get('thedata');
		$page->save();
		return "Page updated successfully";
	}
}));

Route::post('/savepagetitle', array('before' => 'auth', function()
{
	// make sure we are admin
	if (Auth::user()->access_level == 3){
		$page = Page::find(Input::get('page_id'));
		$page->page_title = Input::get('thetitledata');
		$page->save();
		return "Page title updated successfully";
	}
}));

Route::get('/verifyaccount','UsersPendingController@validateUser');

Route::controller('password', 'RemindersController');

Route::get('/authors', 'AuthorController@listAuthors');

Route::controller('/submit', 'SubmitController');

// Blog routes
Route::post('/saveeditedpost', array('before' => 'auth', function()
{
	// make sure we are admin
	if (Auth::user()->access_level == 3){
		$post = Post::find(Input::get('post_id'));
		$post->title = Input::get('thetitledata');
		$post->status = Input::get('status');
		$post->published_date = Input::get('post_date'). " 00:00:01";
		$post->content = Input::get('thedata');
		$post->save();
		return "Post updated successfully";
	}
}));

Route::controller('post/create', 'BlogController');