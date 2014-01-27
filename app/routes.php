<?php
// Routes

Route::any('/', function()
{
	return View::make('home');
});

Route::controller('/users', 'UserController');

// Routes for Page display and edit
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


Route::get('/verifyaccount','UsersPendingController@validateUser');

Route::controller('password', 'RemindersController');

Route::get('/authors', 'AuthorController@listAuthors');

Route::controller('/submit', 'SubmitController');

// Routes for Blog display and edit (other routes in package)
Route::post('/saveeditedpost', array('before' => 'auth', function()
{
	// make sure we are admin
	if (Auth::user()->access_level == 3){
		$post = Post::find(Input::get('post_id'));
		$post->title = trim(Input::get('thetitledata'));
		$post->status = Input::get('status');
		$post->published_date = Input::get('post_date'). " 00:00:01";
		$post->content = Input::get('thedata');
		$post->status = Input::get('status');
		$post->save();
		return "Post updated successfully";
	}
}));

Route::controller('post/create', 'BlogController');

Route::post('/post/save', array('before' => 'auth', function()
{
	// make sure we are admin
	if (Auth::user()->access_level == 3){
		$post = new Post;
		$post->title = trim(Input::get('post_title'));
		$post->status = Input::get('status');
		$post->published_date = Input::get('post_date'). " 00:00:01";
		$post->content = Input::get('post_content');
		$post->summary = Input::get('post_summary');
		$post->meta_description = Input::get('meta_description');
		$post->meta_keywords = Input::get('meta_keywords');
		$post->in_rss = 1;
		$post->slug = trim(Input::get('post_title'));
		$post->save();
		return Redirect::to('/blog')->with('message', 'Post saved successfully');
	}
}));