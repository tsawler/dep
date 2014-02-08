<?php

class AdminController extends BaseController {

	public function __construct() {
		$this->beforeFilter('csrf', array('on'=>'post'));
		$this->beforeFilter('auth', array('only'=>array('showAdminUser')));
		$this->beforeFilter('auth', array('only'=>array('getAdminUsers')));
		$this->beforeFilter('auth', array('only'=>array('getAllUsers')));
		$this->beforeFilter('auth', array('only'=>array('postAllUsers')));
	}

	protected $layout = "layout";
	
	public function showAdminUser(){
		if (Auth::user()->access_level == 3)
		{
			$user_id = Request::segment(3);
			$user = User::find($user_id);
			$this->layout->content = View::make('users.dashboard.user')
				->with('user',$user);
		}
		else
		{
			$this->layout->content = View::make('users.dashboard.dashboard');
		}
	}
	
	public function getAdminUsers() {
		if (Auth::user()->access_level == 3)
		{
			$adminusers = User::where('access_level', '=', '3')->orderby('last_name')->paginate(15);
			$this->layout->content = View::make('users.dashboard.adminusers')
				->with('adminusers',$adminusers);
		}
		else
		{
			$purchased = UserBook::where('user_id', '=', Auth::user()->id)->get();
			$submissions = Submission::where('user_id', '=', Auth::user()->id)->get();
	
			$this->layout->content = View::make('users.dashboard.dashboard')
				->with('purchased',$purchased)
				->with('submissions',$submissions)
				->with('error','You do not have access to the requested page');
		}
	}
	
	public function getAllUsers() {
		if (Auth::user()->access_level == 3)
		{
			$allusers = User::where('access_level', '>=', '1')->orderby('last_name')->paginate(15);
			$this->layout->content = View::make('users.dashboard.allusers')
				->with('allusers',$allusers)
				->with('email', '')
				->with('last_name', '');
		}
		else
		{
			$purchased = UserBook::where('user_id', '=', Auth::user()->id)->get();
			$submissions = Submission::where('user_id', '=', Auth::user()->id)->get();
	
			$this->layout->content = View::make('users.dashboard.dashboard')
				->with('purchased',$purchased)
				->with('submissions',$submissions)
				->with('error','You do not have access to the requested page');
		}
	}
	
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
		}
		else
		{
			$purchased = UserBook::where('user_id', '=', Auth::user()->id)->get();
			$submissions = Submission::where('user_id', '=', Auth::user()->id)->get();
	
			$this->layout->content = View::make('users.dashboard.dashboard')
				->with('purchased',$purchased)
				->with('submissions',$submissions)
				->with('error','You do not have access to the requested page');
		}
	}

}