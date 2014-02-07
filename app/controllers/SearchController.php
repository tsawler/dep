<?php

class SearchController extends BaseController {

	public function __construct() {
		$this->beforeFilter('csrf', array('on'=>'post'));
	}

	protected $layout = "layout";

	
	/**
	 * Show the search page
	 *
	 * @return mixed
	 */
	public function showSearchPage(){
		$searchterm = "";
		return View::make('pages.search')
			->with('searchterm',$searchterm);
	}

	/**
	 * Perform search
	 *
	 * @return mixed
	 */
	public function performSearch(){
		$searchterm = Input::get('searchterm');
		return View::make('pages.search')
			->with('searchterm',$searchterm);
	}
}