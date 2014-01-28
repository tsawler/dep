<?php
/*
|---------------------------------------------------------------------------------------
| UserController
|---------------------------------------------------------------------------------------
|
| Handles all functions for Users
|
|---------------------------------------------------------------------------------------
*/
class UserController extends BaseController {

	protected $layout = "layout";

	public function __construct() {
		$this->beforeFilter('csrf', array('on'=>'post'));
		$this->beforeFilter('auth', array('only'=>array('getDashboard')));
		$this->beforeFilter('auth', array('only'=>array('getPassword')));
		$this->beforeFilter('auth', array('only'=>array('postDashboard')));
		$this->beforeFilter('auth', array('only'=>array('getAccount')));
		$this->beforeFilter('auth', array('only'=>array('postDashboard')));
	}

	/*
	|------------------------------------------------------------------------------------
	|
	|  getRegister: show page to permit users to register, or redirect to dashboard
	|             if already has account
	|
	|------------------------------------------------------------------------------------
	*/
	public function getRegister() {
		if (Auth::check())
		{
			return Redirect::to('users/dashboard')->with('message', 'You have already registered!');
		} else {
			$this->layout->content = View::make('users.register');
		}
	}

	/*
	|------------------------------------------------------------------------------------
	|
	|  getConfirmation: Show confirmation screen telling user 
	| 			  to check his/her email (part of user validation process)
	|
	|------------------------------------------------------------------------------------
	*/
	public function getConfirmation() {
		$this->layout->content = View::make('users.confirmation');
	}

	/*
	|------------------------------------------------------------------------------------
	|
	|  getLogin: Show user login scree
	|
	|------------------------------------------------------------------------------------
	*/
	public function getLogin() {
		$this->layout->content = View::make('users.login');
	}

	/*
	|------------------------------------------------------------------------------------
	|
	|  postSignin: Try to log the user in
	|
	|------------------------------------------------------------------------------------
	*/
	public function postSignin() {
		if (Auth::attempt(array('email'=>Input::get('username'), 'password'=>Input::get('password')))) {
			if (strlen(Input::get('targetUrl')) > 0) {
				return Redirect::to(Input::get('targetUrl'))->with('message', 'You are now logged in!');
			} else {
				return Redirect::to('users/dashboard')->with('message', 'You are now logged in!');
			}
		} else {
			return Redirect::to('users/login')
			->with('message', 'Your username/password combination was incorrect')
			->withInput();
		}
	}

	/*
	|------------------------------------------------------------------------------------
	|
	|  postCreate: Create (but do not make active) a new user
	|
	|------------------------------------------------------------------------------------
	*/
	public function postCreate() {
		$validator = Validator::make(Input::all(), User::$rules);

		if ($validator->passes()) {
			$user = new User;
			$user->first_name = Input::get('first_name');
			$user->last_name = Input::get('last_name');
			$user->email = Input::get('email');
			$user->password = Hash::make(Input::get('password'));
			$user->access_level = 1;
			$user->user_active = 0;
			$user->save();


			// put an entry into users_pending
			$randtoken = md5(uniqid(rand(), true)) . md5(uniqid(rand(), true));
			$user_pending = new UsersPending;
			$user_pending->join_token = $randtoken;
			$user_pending->email = Input::get('email');
			$user_pending->save();

			// build email
			$user = array(
				'email'=>Input::get('email'),
				'first_name'=>Input::get('first_name')
			);

			// the data that will be passed into the mail view blade template
			$data = array(
				'users_name'  => $user['first_name'],
				'token'=>$randtoken
			);

			// use Mail::send function to send email passing the data and using the $user variable in the closure
			Mail::send('users.welcome_email', $data, function($message) use ($user) {
					$message->from('donotreply@dogearedpress.ca', 'Do not reply');
					$message->to($user['email'], $user['first_name'])->subject('Welcome to the Dog Eared Press');
				});

			return Redirect::to('users/confirmation');

		} else {
			return Redirect::to('users/register')->with('message', 'The following errors occurred')->withErrors($validator)->withInput();
		}
	}

	/*
	|------------------------------------------------------------------------------------
	|
	|  getDashboard: Show user dashboard
	|
	|------------------------------------------------------------------------------------
	*/
	public function getDashboard() {
		$purchased = UserBook::where('user_id', '=', Auth::user()->id)->get();
		$submissions = Submission::where('user_id', '=', Auth::user()->id)->get();

		$this->layout->content = View::make('users.dashboard.dashboard')
		->with('purchased',$purchased)
		->with('submissions',$submissions);
	}

	/*
	|------------------------------------------------------------------------------------
	|
	|  getLogout: Log the user out
	|
	|------------------------------------------------------------------------------------
	*/
	public function getLogout() {
		Auth::logout();
		return Redirect::to('users/login')->with('message', 'Your are now logged out!');
	}

	/*
	|------------------------------------------------------------------------------------
	|
	|  getAuthor: get Author Account Details for for create/edit
	|
	|------------------------------------------------------------------------------------
	*/
	public function getAuthor() {
		$publisher = new PublisherInfo;
		$user_id = Auth::user()->id;
		$publisher = PublisherInfo::where('user_id', '=', Auth::user()->id)->first();
	
		$this->layout->content = View::make('users.dashboard.publisher')->with('publisher', $publisher);
	}

	/*
	|------------------------------------------------------------------------------------
	|
	|  postAuthor: Save/Update Author account information
	|
	|------------------------------------------------------------------------------------
	*/
	public function postAuthor(){
		$publisher = new PublisherInfo;
		//$publisher = PublisherInfo::find(Auth::user()->id);
		$publisher = PublisherInfo::where('user_id', '=', Auth::user()->id)->first();
		
		if ($publisher === null){
			$publisher = new PublisherInfo;
			$publisher->address = Input::get('address');
			$publisher->city = Input::get('city');
			$publisher->province = Input::get('province');
			$publisher->province_other = Input::get('province_other');
			$publisher->country = Input::get('country');
			$publisher->zip = Input::get('zip');
			$publisher->phone = Input::get('phone');
			$publisher->user_id = Auth::user()->id;
			$publisher->save();
		} else {
			$publisher->address = Input::get('address');
			$publisher->city = Input::get('city');
			$publisher->province = Input::get('province');
			$publisher->province_other = Input::get('province_other');
			$publisher->country = Input::get('country');
			$publisher->zip = Input::get('zip');
			$publisher->phone = Input::get('phone');
			$publisher->save();
		}
		return Redirect::to('users/dashboard')->with('message', 'Changes saved.');
	}
	
	/*
	|------------------------------------------------------------------------------------
	|
	|  getAccount: Show user account details
	|
	|------------------------------------------------------------------------------------
	*/
	public function getAccount() {
		$user = new User;
		$user = User::find(Auth::user()->id);
		$this->layout->content = View::make('users.dashboard.account')->with('user', $user);

	}

	/*
	|------------------------------------------------------------------------------------
	|
	|  postAccount: Update user account details
	|
	|------------------------------------------------------------------------------------
	*/
	public function postAccount(){
		$user = new User;
		$user = User::find(Auth::user()->id);
		$user->first_name = Input::get('first_name');
		$user->last_name = Input::get('last_name');
		$user->email = Input::get('email');
		$user->save();
		return Redirect::to('users/dashboard')->with('message', 'Changes saved.');
	}

	/*
	|------------------------------------------------------------------------------------
	|
	|  getPassword: Show form to update password
	|
	|------------------------------------------------------------------------------------
	*/
	public function getPassword() {
		$this->layout->content = View::make('users.dashboard.password');
	}

	/*
	|------------------------------------------------------------------------------------
	|
	|  postPassword: try to update user password
	|
	|------------------------------------------------------------------------------------
	*/
	public function postPassword() {
		$credentials = array('email' => Auth::user()->email, 'password' => Input::get('password'));
		if (Auth::validate($credentials)) 
		{
			$user = new User;
			$user = User::find(Auth::user()->id);
			$user->password = Hash::make(Input::get('new_password'));
			$user->save();
			$this->layout->content = View::make('users.dashboard.passwordchanged');
		}else {
			return Redirect::to('users/password')->with('message', 'Existing password is wrong, or new passwords do not match.');
		}
	}
}