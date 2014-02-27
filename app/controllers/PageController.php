<?php

class PageController extends BaseController {

	public function __construct() {
		$this->beforeFilter('csrf', array('on'=>'post'));
		$this->beforeFilter('auth', array('only'=>array('editPage')));
	}

	protected $layout = "layout";

	
	/**
	 * Save edits to page (in place, called via ajax)
	 *
	 * @return text
	 */
	 public function editPage(){
		if ((Auth::user()->access_level == 3) && (Auth::user()->roles->contains(1))) {
			$page = Page::find(Input::get('page_id'));
			$key = 'route-'.$page->slug;

			$page->page_content = trim(Input::get('thedata'));
			$page->page_title = trim(Input::get('thetitledata'));
			$page->save();
			if (Cache::has($key))
			{
			    Cache::forget($key);
			}
			return "Page updated successfully";
		}
	}
	
	/**
	 * Save page 
	 *
	 * @return mixed
	 */
	 public function savePage(){
		if ((Auth::user()->access_level == 3) && (Auth::user()->roles->contains(1))) {
			$validator = Validator::make(Input::all(), Page::$rules);
			if ($validator->passes()) {
				$page = new Page;
				$page->page_name = trim(Input::get('page_name'));
				$page->page_title = trim(Input::get('page_name'));
				$page->active = Input::get('active');
				$page->page_content = trim(Input::get('page_content'));
				$page->meta = Input::get('meta_description');
				$page->meta_tags = Input::get('meta_keywords');
				$page->slug = urlencode(trim(Input::get('page_name')));
				$page->save();
				return Redirect::to('/'.trim(Input::get('page_name')));
			} else {
				return Redirect::to('page/create')
					->with('error', 'Error! Changes not saved!')
					->withErrors($validator)
					->withInput();
			}
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
		$page_content = "Either the page you have requested is not active, or it does not exist.";
		$meta = "";
		$meta_tags = "";
		$active = 0;
		$page_id = 0;
		
		$results = DB::select('select * from pages where slug = ?', array($slug));
		$page_title = urldecode($page_title);

		foreach ($results as $result)
		{
			$active = $result->active;
			if (($active > 0) || 
					((Auth::check()) && (Auth::user()->access_level == 3))) {
				$page_title = $result->page_title;
				$page_content = $result->page_content;
				$meta = $result->meta;
				$page_id = $result->id;
				$meta_keywords = $result->meta_tags;
			}
		}
		
		if ($active == 0){
			App::abort(404);
		} else {}
			return View::make('pages.defaultpage')
				->with('page_title', $page_title)
				->with('page_content', $page_content)
				->with('meta', $meta)
				->with('meta_tags',$meta_keywords)
				->with('active',$active)
				->with('page_id', $page_id);
	}
}