<?php
/*
|--------------------------------------------------------------------------
| General Routes
|--------------------------------------------------------------------------
*/

Route::any('/', function()
	{
		return View::make('home');
	});

/*
|--------------------------------------------------------------------------
| Display/Edit/Create pages
|--------------------------------------------------------------------------
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
|--------------------------------------------------------------------------
| Account/User Routes
|--------------------------------------------------------------------------
*/
Route::controller('/users', 'UserController');

Route::get('/verifyaccount','UsersPendingController@validateUser');

Route::controller('password', 'RemindersController');

Route::get('/authors', 'AuthorController@listAuthors');

Route::controller('/submit', 'SubmitController');

/*
|--------------------------------------------------------------------------
| Blog routes (others in vendor fbf package)
|--------------------------------------------------------------------------
*/
Route::post('/post/edit', array('before' => 'auth', function()
	{
		// make sure we are admin
		if (Auth::user()->access_level == 3)
		{
			$validator = Validator::make(
				Input::all(),
				array(
					'title' => 'required|min:2|unique:fbf_blog_posts',
					'published_date' => 'required',
					'content' => 'required|min:2')
			);

			if ($validator->passes())
			{
				$post = Post::find(Input::get('post_id'));
				$post->title = trim(Input::get('title'));
				$post->slug = trim(Input::get('title'));
				$post->status = Input::get('status');
				$post->published_date = Input::get('published_date'). " 00:00:01";
				$post->content = Input::get('content');
				$post->status = Input::get('status');
				$post->save();
				return "Post updated successfully";
			}
			else
			{
				$m =  "The following errors occurred:";
				$messages = $validator->messages();
				var_dump($messages);
				return $m;
			}
		}
	}));

Route::controller('post/create', 'BlogController');

Route::post('/post/save', array('before' => 'auth', function()
	{
		// make sure we are admin
		if (Auth::user()->access_level == 3)
		{
			$validator = Validator::make(Input::all(), Post::$rules);
			if ($validator->passes())
			{
				$post = new Post;
				$post->title = trim(Input::get('title'));
				$post->status = Input::get('status');
				$post->published_date = Input::get('post_date'). " 00:00:01";
				$post->content = Input::get('content');
				$post->summary = Input::get('summary');
				$post->meta_description = Input::get('meta_description');
				$post->meta_keywords = Input::get('meta_keywords');
				$post->in_rss = 1;
				$post->slug = trim(Input::get('title'));
				$post->save();
				return Redirect::to('/blog')->with('message', 'Post saved successfully');
			}
			else
			{
				return Redirect::to('post/create')->with('message', 'The following errors occurred')->withErrors($validator)->withInput();
			}
		}
	}));

Route::post('/post/delete', array('before' => 'auth', function()
	{
		// make sure we are admin
		if (Auth::user()->access_level == 3)
		{
			$post = Post::find(Input::get('post_id'));
			$post->delete();
			return Redirect::to('/blog')->with('message', 'Post deleted successfully');
		}
	}));