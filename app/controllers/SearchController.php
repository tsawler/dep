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
		
		/* $results = DB::select("select * from pages WHERE MATCH (page_title,page_content) "
								. "AGAINST (?)", array($searchterm));*/
		$results = DB::select("(select id as the_id, page_title as the_title, "
								. "concat(substring(page_content,1,150),'...') as the_content,  "
								. "concat('/',slug) as target "
								. "from pages WHERE MATCH (page_title,page_content) AGAINST (?))"
								. " union "
								. "(select id as the_id, `title` as the_title, "
								. "concat(substring(`content`,1,150),'...') as the_content, "
								. "concat('/blog/',slug) as target " 
								. "from fbf_blog_posts WHERE MATCH (title,content) AGAINST (?))"
								, array($searchterm, $searchterm));
								
								
		return View::make('pages.search')
			->with('searchterm',$searchterm)
			->with('results',$results);
	}
}