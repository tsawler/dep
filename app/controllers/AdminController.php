<?php

class AdminController extends BaseController {

	public function __construct() {
		$this->beforeFilter('csrf', array('on'=>'post'));
	}

	protected $layout = "layout";
	
	/* ------- Pages -------- */
	
	
	/**
	 * Show page for adding
	 *
	 * @return mixed
	 */
	public function getAddpage(){
		if (Auth::user()->access_level == 3)
		{
			return View::make('users.dashboard.addpage');
		} else {
			return View::make('users.dashboard.dashboard');
		}
	}
	
	/**
	 * Save page 
	 *
	 * @return mixed
	 */
	 public function postSavepage(){
		if (Auth::user()->access_level == 3){
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
				return Redirect::to('/admin/allpages')->with('message','Page saved successfully');
			} else {
				return Redirect::to('admin/addpage')
					->with('error', 'Error! Changes not saved!')
					->withErrors($validator)
					->withInput();
			}
		}
	}
	
	
	/**
	 * Show page for edit
	 *
	 * @return mixed
	 */
	public function getEditpage(){
		if (Auth::user()->access_level == 3)
		{
			$page_id = Request::segment(3);
			$page = Page::find($page_id);
			return View::make('users.dashboard.editpage')
				->with('page',$page);
		} else {
			return View::make('users.dashboard.dashboard');
		}
	}
	
	
	/**
	 * Save edited page 
	 *
	 * @return mixed
	 */
	 public function postEditpage(){
		if (Auth::user()->access_level == 3){
			$page = new Page;
			$page = Page::find(Request::segment(3));
			$page->page_name = trim(Input::get('page_name'));
			$page->page_title = trim(Input::get('page_name'));
			$page->active = Input::get('active');
			$page->page_content = trim(Input::get('page_content'));
			$page->meta = Input::get('meta');
			$page->meta_tags = Input::get('meta_tags');
			$page->slug = urlencode(trim(Input::get('page_name')));
			Cache::flush();
			$page->save();
			return Redirect::to('/admin/allpages')->with('message','Page saved successfully');
		}
	}
	
	
	
	/**
	 * Get all pages
	 *
	 * @return mixed
	 */
	public function getAllpages() {
		if (Auth::user()->access_level == 3)
		{
			return View::make('users.dashboard.allpages');
		} else {
	
			return Redirect::to('users/dashboard')
				->with('error','You do not have access to the requested page');
		}
	}
	
	
	/**
	 * Delete a page
	 *
	 * @return mixed
	 */
	public function getDeletepage() {
		if (Auth::user()->access_level == 3) {
			$page_id = Request::segment(3);
			$page = Page::find($page_id);
			$page->delete();
			return Redirect::to('admin/allpages')->with('message','Page deleted successfully.');
		}
	}
	
	
	/**
	 * Get list of users as json response
	 *
	 * @return json
	 */
	public function getAllpagesajax() {
		if ((Auth::check()) && (Auth::user()->access_level == 3))
		{
			$pages = DB::table('pages')
                     ->select(DB::raw("id, page_name, case when active = 1 then '<span style=\"color: green;\">Active</span>' else '<span style=\"color: red;\">Inactive</span>' end as status"))
                     ->where("id", "<>", 8)
                     ->orderBy('page_name')
                     ->get();
                     
            $eArray = array();

			foreach ($pages as $page){
				$eArray[] = array(
					"<a href='/admin/editpage/".$page->id."'>".$page->page_name."</a>",
					$page->status
					);
			}
                     
            $contents =  '{ "aaData" : [';
			$first = true;
			foreach ($eArray as $value){
				if ($first == false){
					$contents .= ",";
				} else {
					$first = false;
				}
				$contents .= json_encode($value);
			}
			$contents .= "] }";

			$response = Response::make($contents, '200');
			$response->header('Cache-Control', 'no-cache, must-revalidate');
			$response->header('Expires', 'Mon, 26 Jul 1997 05:00:00 GMT');
            $response->header('Content-Type', 'application/json');
			
			return $response;
		
		} else {
			return Redirect::to('users/login');
		}
	}
	
	
	/**
	 * Show user in form
	 *
	 * @return mixed
	 */
	public function getEdituser(){
		if ((Auth::check()) && (Auth::user()->access_level == 3))
		{
			$user_id = Request::segment(3);
			$user = User::find($user_id);
			$purchased = UserBook::where('user_id', '=', $user_id)->get();
			$submissions = Submission::where('user_id', '=', $user_id)->get();
			$this->layout->content = View::make('users.dashboard.user')
				->with('user',$user)
				->with('submissions',$submissions)
				->with('purchased', $purchased);
		} else {
			return Redirect::to('users/login');
		}
	}
	
	
	/**
	 * Save user
	 *
	 * @return mixed
	 */
	public function postEdituser(){
		if ((Auth::check()) && (Auth::user()->access_level == 3))
		{
			$user_id = Request::segment(3);
			$user = User::find($user_id);
			$user->first_name = Input::get('first_name');
			$user->last_name = Input::get('last_name');
			$user->email = Input::get('email');
			$user->access_level = Input::get('access_level');
			$user->user_active = Input::get('user_active');
			$user->save();
			
			return Redirect::to('admin/edituser/'.$user_id)
				->with('message', 'Changes saved.');
		} else {
			return Redirect::to('users/login');
		}
	}
	
	
	/**
	 * Save a user's roles
	 *
	 * @return mixed
	 */
	public function postEdituserroles(){
		if ((Auth::check()) && (Auth::user()->access_level == 3))
		{
			$user_id = Request::segment(3);
			$user = User::find($user_id);			
			$roles = array();
			
			foreach(Input::all() as $name => $value){
				if ($this->startsWith($name, "r_")) {
					$roles[] = $value;
				}
			}

			$user->roles()->sync($roles);
			
			return Redirect::to('admin/edituser/'.$user_id)
				->with('message', 'Changes saved.');
		} else {
			return Redirect::to('users/login');
		}
	}
	
	
	/**
	 * Show list of admin users
	 *
	 * @return mixed
	 */
	public function getAdminusers() {
		if ((Auth::check()) && (Auth::user()->access_level == 3))
		{
			$adminusers = User::where('access_level', '=', '3')->orderby('last_name')->paginate(15);
			$this->layout->content = View::make('users.dashboard.adminusers')
				->with('adminusers',$adminusers);
		} else {
			return Redirect::to('users/login');
		}
	}
	
	/**
	 * Show list of all users
	 *
	 * @return mixed
	 */
	public function getAllusers() {
		if ((Auth::check()) && (Auth::user()->access_level == 3))
		{
			$this->layout->content = View::make('users.dashboard.allusers');
		} else {
			return Redirect::to('users/login');
		}
	}
	
	
	/**
	 * Show list of manuscripts
	 *
	 * @return mixed
	 */
	public function getManuscripts() {
		if ((Auth::check()) && (Auth::user()->access_level == 3))
		{
			$manuscripts = Submission::orderby('manuscript_title')->get();
			$this->layout->content = View::make('users.dashboard.allmanuscripts')
				->with('manuscripts',$manuscripts)
				->with('manuscript_title','');
		} else {
			return Redirect::to('users/login');
		}
	}
	
	
	/**
	 * Show a manuscript
	 *
	 * @return mixed
	 */
	public function getShowmanuscript() {
		if ((Auth::check()) && (Auth::user()->access_level == 3))
		{
			$id = Request::segment(3);
			$manuscript = Submission::find($id);
			$doc = $manuscript->manuscript;
			$file = base_path() . '/manuscriptUploads/'.$doc;
			$headers = array(
              'Content-Type: '.$manuscript->mime_type,
            );
			return Response::download($file, $manuscript->file_name, $headers);
		} else {
			return Redirect::to('users/login');
		}
	}
	
	
	/**
	 * Manage a manuscript
	 *
	 * @return mixed
	 */
	public function getManagems() {
		if ((Auth::check()) && (Auth::user()->access_level == 3))
		{
			$id = Request::segment(3);
			$manuscript = Submission::find($id);
			$this->layout->content = View::make('users.dashboard.manage_manuscript')->with('manuscript',$manuscript);
		} else {
			return Redirect::to('users/login');
		}
	}
	
	/**
	 * Manage a manuscript status
	 *
	 * @return mixed
	 */
	public function postManuscriptstatus() {
		if ((Auth::check()) && (Auth::user()->access_level == 3))
		{
			$id = Request::input('id');
			$status = Request::input('status');
			$manuscript = Submission::find($id);
			$manuscript->status = $status;
			$manuscript->save();
			return Redirect::to('/admin/managems/'.$id)->with('message','Manuscript status updated');
		} else {
			return Redirect::to('users/login');
		}
	}
	
	
	/**
	 * Get list of users as json response
	 *
	 * @return json
	 */
	public function getAllusersajax() {
		if ((Auth::check()) && (Auth::user()->access_level == 3))
		{
			$users = DB::table('users')
                     ->select(DB::raw("id, last_name, first_name, email, case when user_active = 1 "
                     	. "then '<span style=\"color: green;\">Active</span>' "
                     	. "else '<span style=\"color: red;\">Inactive</span>' end as status"))
                     ->where('access_level', '>=', 1)
                     ->orderBy('last_name')
                     ->get();
                     
            $eArray = array();

			foreach ($users as $user){
				$eArray[] = array(
					"<a href=/admin/edituser/".$user->id.">".$user->last_name."</a>",
					$user->first_name,
					$user->email,
					$user->status
					);
			}
                     
            $contents =  '{ "aaData" : [';
			$first = true;
			foreach ($eArray as $value){
				if ($first == false){
					$contents .= ",";
				} else {
					$first = false;
				}
				$contents .= json_encode($value);
			}
			$contents .= "] }";

			$response = Response::make($contents, '200');
			$response->header('Cache-Control', 'no-cache, must-revalidate');
			$response->header('Expires', 'Mon, 26 Jul 1997 05:00:00 GMT');
            $response->header('Content-Type', 'application/json');
			
			return $response;
		
		} else {
			return Redirect::to('users/login');
		}
	}
	
	/**
	 * Function to test for start of string
	 *
	 * @return mixed
	 */
	private function startsWith($haystack, $needle)
	{
	    return $needle === "" || strpos($haystack, $needle) === 0;
	}

}