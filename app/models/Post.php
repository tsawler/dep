<?php

class Post extends Eloquent  {
	
	public static $rules = array(
	   'title'=>'required|min:2|unique:fbf_blog_posts',
	   'summary'=>'required|min:2',
	   'content'=>'required|min:2',
	   'meta_keywords'=>'required',
	   'meta_description'=>'required',
	);
	
	protected $guarded = array('*');

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'fbf_blog_posts';

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}
}