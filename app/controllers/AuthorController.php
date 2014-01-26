<?php

class AuthorController extends BaseController {

	public function listAuthors()
	{
		$authors = Author::all();
		return View::make('authors')->with('authors',$authors);
	}

}