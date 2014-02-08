<?php

class AdminController extends BaseController {

	public function __construct() {
		$this->beforeFilter('csrf', array('on'=>'post'));
		$this->beforeFilter('auth', array('only'=>array('showUser')));
		$this->beforeFilter('auth', array('only'=>array('saveUser')));
		$this->beforeFilter('auth', array('only'=>array('getAdminUsers')));
		$this->beforeFilter('auth', array('only'=>array('getAllUsers')));
		$this->beforeFilter('auth', array('only'=>array('postAllUsers')));
	}

	protected $layout = "layout";
	
	
	/**
	 * Show user in form
	 *
	 * @return mixed
	 */
	public function showUser(){
		if (Auth::user()->access_level == 3)
		{
			$user_id = Request::segment(3);
			$user = User::find($user_id);
			$this->layout->content = View::make('users.dashboard.user')
				->with('user',$user);
		} else {
			$this->layout->content = View::make('users.dashboard.dashboard');
		}
	}
	
	
	/**
	 * Save user
	 *
	 * @return mixed
	 */
	public function saveUser(){
		if (Auth::user()->access_level == 3)
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
			$this->layout->content = View::make('users.dashboard.dashboard');
		}
	}
	
	
	/**
	 * Show list of admin users
	 *
	 * @return mixed
	 */
	public function getAdminUsers() {
		if (Auth::user()->access_level == 3)
		{
			$adminusers = User::where('access_level', '=', '3')->orderby('last_name')->paginate(15);
			$this->layout->content = View::make('users.dashboard.adminusers')
				->with('adminusers',$adminusers);
		} else {
			$purchased = UserBook::where('user_id', '=', Auth::user()->id)->get();
			$submissions = Submission::where('user_id', '=', Auth::user()->id)->get();
	
			$this->layout->content = View::make('users.dashboard.dashboard')
				->with('purchased',$purchased)
				->with('submissions',$submissions)
				->with('error','You do not have access to the requested page');
		}
	}
	
	/**
	 * Show list of all users
	 *
	 * @return mixed
	 */
	public function getAllUsers() {
		if (Auth::user()->access_level == 3)
		{
			$allusers = User::where('access_level', '>=', '1')->orderby('last_name')->paginate(15);
			$this->layout->content = View::make('users.dashboard.allusers')
				->with('allusers',$allusers)
				->with('email', '')
				->with('last_name', '');
		} else {
			$purchased = UserBook::where('user_id', '=', Auth::user()->id)->get();
			$submissions = Submission::where('user_id', '=', Auth::user()->id)->get();
	
			$this->layout->content = View::make('users.dashboard.dashboard')
				->with('purchased',$purchased)
				->with('submissions',$submissions)
				->with('error','You do not have access to the requested page');
		}
	}
	
	
	/**
	 * Show filtered list of all users
	 *
	 * @return mixed
	 */
	public function postAllUsers() {
	
		if (Auth::user()->access_level == 3)
		{
			$allusers = DB::table('users');

			if(strlen(Input::get('last_name')) > 0)
				$allusers->where('last_name','like', Input::get('last_name') . "%");

			if(Input::get('email'))
				$allusers->where('email','like', Input::get('email'));
			
			$allusers = $allusers->paginate(15);
			
			$this->layout->content = View::make('users.dashboard.allusers')
				->with('allusers',$allusers)
				->with('last_name',Input::get('last_name'))
				->with('email', Input::get('email'));
		} else {
			$purchased = UserBook::where('user_id', '=', Auth::user()->id)->get();
			$submissions = Submission::where('user_id', '=', Auth::user()->id)->get();
	
			$this->layout->content = View::make('users.dashboard.dashboard')
				->with('purchased',$purchased)
				->with('submissions',$submissions)
				->with('error','You do not have access to the requested page');
		}
	}

}