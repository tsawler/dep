<?php
/*
|---------------------------------------------------------------------------------------
| BlogController
|---------------------------------------------------------------------------------------
|
| Handles all functions for Blog CRUD
| Note that some functions are still in the fbf vendor package
|
|---------------------------------------------------------------------------------------
*/
class BlogController extends BaseController {

	public function __construct() {
		$this->beforeFilter('csrf', array('on'=>'post'));
		$this->beforeFilter('auth', array('only'=>array('postSave')));
		$this->beforeFilter('auth', array('only'=>array('postDelete')));
		$this->beforeFilter('auth', array('only'=>array('postEdit')));
	}
	
	/*
	|------------------------------------------------------------------------------------
	|
	|  getCreate: Show create blog post form (views in app)
	|
	|------------------------------------------------------------------------------------
	*/
	public function getCreate()
	{
		return View::make('blog.posts.create');
	}
	
	/*
	|------------------------------------------------------------------------------------
	|
	|  postSave: Save posted form (new entry)
	|
	|------------------------------------------------------------------------------------
	*/
	public function postSave()
	{
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
				return Redirect::to('/blog')
					->with('message', 'Post saved successfully');
			}
			else
			{
				return Redirect::to('post/create')
					->with('message', 'The following errors occurred')
					->withErrors($validator)
					->withInput();
			}
		}
	}
	
	/*
	|------------------------------------------------------------------------------------
	|
	|  postDelete: Delete blog post
	|
	|------------------------------------------------------------------------------------
	*/
	public function postDelete()
	{
		if (Auth::user()->access_level == 3)
		{
			$post = Post::find(Input::get('post_id'));
			$post->delete();
			return Redirect::to('/blog')
				->with('message', 'Post deleted successfully');
		}
	}
	
	/*
	|------------------------------------------------------------------------------------
	|
	|  postEdit: Save edited blog post (called via ajax)
	|
	|------------------------------------------------------------------------------------
	*/
	public function postEdit()
	{
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
	}
}