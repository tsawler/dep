<?php
/*
|---------------------------------------------------------------------------------------
| PageController
|---------------------------------------------------------------------------------------
|
| Handles all functions for Page CRUD
|
|---------------------------------------------------------------------------------------
*/
class PageController extends BaseController {

	public function __construct() {
		$this->beforeFilter('csrf', array('on'=>'post'));
		$this->beforeFilter('auth', array('only'=>array('postDashboard')));
	}

	protected $layout = "layout";

	
	/*
	|------------------------------------------------------------------------------------
	|
	|  editPage: Save edits to page (called via Ajax)
	|
	|------------------------------------------------------------------------------------
	*/
	public function editPage(){
		if (Auth::user()->access_level == 3){
			$page = Page::find(Input::get('page_id'));
			$page->page_content = Input::get('thedata');
			$page->page_title = Input::get('thetitledata');
			$page->save();
			return "Page updated successfully";
		}
	}

	/*
	|------------------------------------------------------------------------------------
	|
	|  showPage: Show a page, or not active message if not active (or found)
	|
	|------------------------------------------------------------------------------------
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