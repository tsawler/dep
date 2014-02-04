<?php

class PageController extends BaseController {

	public function __construct() {
		$this->beforeFilter('csrf', array('on'=>'post'));
		$this->beforeFilter('auth', array('only'=>array('postDashboard')));
	}

	protected $layout = "layout";

	
	/**
	 * Save edits to page (in place, called via ajax)
	 *
	 * @return text
	 */
	 public function editPage(){
		if (Auth::user()->access_level == 3){
			$page = Page::find(Input::get('page_id'));
			$page->page_content = trim(Input::get('thedata'));
			$page->page_title = trim(Input::get('thetitledata'));
			$page->save();
			return "Page updated successfully";
		}
	}


	/**
	 * Display home page
	 *
	 * @return null
	 */
	public function showHome(){
	

		$page_title = "";
		$page_content = "";
		$page_id = 0;
		$meta = "";

		$results = DB::select('select * from pages where slug = ?', array("home"));

		foreach ($results as $result)
		{
		    $page_title = $result->page_title;
		    $page_content = $result->page_content;
		    $meta = $result->meta;
		    $page_id = $result->id;
		}
		
		return View::make('pages.home')
			->with('page_title', $page_title)
			->with('page_content', $page_content)
			->with('meta', $meta)
			->with('page_id', $page_id);
	}
	
	
	/**
	 * Show generic page
	 *
	 * @return null
	 */
	public function showPage(){

		$slug = Request::segment(1);
		$page_title = "Not active";
		$page_content = "The page you have requested is not active.";
		$meta = "";
		$active = 0;
		$page_id = 0;
		
		$results = DB::select('select * from pages where slug = ?', array($slug));
		$page_title = urldecode($page_title);

		foreach ($results as $result)
		{
			$active = $result->active;
			if ($active > 0){
				$page_title = $result->page_title;
				$page_content = $result->page_content;
				$meta = $result->meta;
				$page_id = $result->id;
			}
		}
		
		return View::make('pages.defaultpage')
			->with('page_title', $page_title)
			->with('page_content', $page_content)
			->with('meta', $meta)
			->with('page_id', $page_id);
	}


}