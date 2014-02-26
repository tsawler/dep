<?php

class UserController extends BaseController {

	protected $layout = "layout";

	public function __construct() {
		$this->beforeFilter('csrf', array('on'=>'post'));
		$this->beforeFilter('auth', array('only'=>array('getDashboard')));
		$this->beforeFilter('auth', array('only'=>array('getPassword')));
		$this->beforeFilter('auth', array('only'=>array('postDashboard')));
		$this->beforeFilter('auth', array('only'=>array('getAccount')));
		$this->beforeFilter('auth', array('only'=>array('postDashboard')));
		$this->beforeFilter('auth', array('only'=>array('getAuthor')));
		$this->beforeFilter('auth', array('only'=>array('postAuthor')));
		$this->beforeFilter('auth', array('only'=>array('getSecurity')));
		$this->beforeFilter('auth', array('only'=>array('postSecurity')));
		$this->beforeFilter('auth', array('only'=>array('getAdminusers')));
		//$this->beforeFilter('ssl');
	}

	/**
	 * Display user registration form
	 *
	 * @return null
	 */
	public function getRegister() {
		if (Auth::check())
		{
			return Redirect::to('users/dashboard')->with('message', 'You have already registered!');
		} else {
			$this->layout->content = View::make('users.register');
		}
	}

	/**
	 * Show registration confirmation screen
	 *
	 * @return null
	 */
	public function getConfirmation() {
		$this->layout->content = View::make('users.confirmation');
	}

	/**
	 * Display user login form
	 *
	 * @return null
	 */
	public function getLogin() {
		$this->layout->content = View::make('users.login');
	}

	/**
	 * Try to log the user in
	 *
	 * @return redirect
	 */
	public function postSignin() {
		// get the supplied login credentials
		$credentials = array('email'=>Input::get('username'), 'password'=>Input::get('password'));
		$remember = false;
		if (Input::get('remember') == 1)
		{
			$remember = true;
		}

		// try logging in
		if (Auth::attempt($credentials, $remember))
		{
			if (strlen(Input::get('targetUrl')) > 0) {
				$tfa = Auth::user()->use_tfa;
				// check for cookie to see if we need to use tfa
				if (Cookie::has('deptfa'))
				{
					$tfa = 0;
				}
				if ($tfa == 1)
				{
					Auth::logout();
					Session::put('credentials', $credentials);
					Session::put('remember',$remember);
					return Redirect::to('users/tfa');
				}
				else
				{
					return Redirect::to(Input::get('targetUrl'))->with('message', 'You are now logged in!');
				}

			} else {

				$tfa = Auth::user()->use_tfa;
				if (Cookie::has('deptfa'))
				{
					$tfa = 0;
				}
				if ($tfa == 1)
				{
					Auth::logout();
					Session::put('credentials', $credentials);
					Session::put('remember',$remember);
					return Redirect::to('users/tfa');
				}
				else
				{
					return Redirect::to('users/dashboard')->with('message', 'You are now logged in!');
				}
			}
		} else {
			return Redirect::to('users/login')
				->with('error', 'Your username/password combination is incorrect')
				->withInput();
		}
	}

	/**
	 * Create a new, inactive user
	 *
	 * @return redirect
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
					$message->to($user['email'], $user['first_name'])->subject('Welcome to the Dog-Eared Press');
				});

			return Redirect::to('users/confirmation');

		} else {
			return Redirect::to('users/register')
				->with('error', 'The following errors occurred')
				->withErrors($validator)
				->withInput();
		}
	}

	/**
	 * Show user dashboard
	 *
	 * @return null
	 */
	public function getDashboard() {
		$purchased = UserBook::where('user_id', '=', Auth::user()->id)->get();
		$submissions = Submission::where('user_id', '=', Auth::user()->id)->get();

		$this->layout->content = View::make('users.dashboard.dashboard')
			->with('purchased',$purchased)
			->with('submissions',$submissions);
	}

	/**
	 * Log the user out
	 *
	 * @return redirect
	 */
	public function getLogout() {
		Auth::logout();
		return Redirect::to('users/login')
			->with('message', 'Your are now logged out!');
	}

	/**
	 * Display author account details
	 *
	 * @return null
	 */
	public function getAuthor() {
		$publisher = new PublisherInfo;
		$user_id = Auth::user()->id;
		$publisher = PublisherInfo::where('user_id', '=', Auth::user()->id)->first();

		$this->layout->content = View::make('users.dashboard.publisher')
			->with('publisher', $publisher);
	}

	/**
	 * Save/update author account details
	 *
	 * @return redirect
	 */
	public function postAuthor(){
		$publisher = new PublisherInfo;
		$publisher = PublisherInfo::where('user_id', '=', Auth::user()->id)->first();

		$validator = Validator::make(Input::all(), PublisherInfo::$rules);

		if ($validator->passes()) {
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
			return Redirect::to('users/dashboard')
				->with('message', 'Changes saved.');
		} else {
			return Redirect::to('users/author')
				->withErrors($validator)
				->withInput();
		}
	}

	/**
	 * Display user account details
	 *
	 * @return null
	 */
	public function getAccount() {
		$user = new User;
		$user = User::find(Auth::user()->id);
		$this->layout->content = View::make('users.dashboard.account')
			->with('user', $user);

	}

	/**
	 * Save/update upser account details
	 *
	 * @return redirect
	 */
	public function postAccount(){
		$user = new User;
		$user = User::find(Auth::user()->id);
		$user->first_name = Input::get('first_name');
		$user->last_name = Input::get('last_name');
		$user->email = Input::get('email');
		$user->save();
		return Redirect::to('users/dashboard')
			->with('message', 'Changes saved.');
	}

	/**
	 * Display password update form
	 *
	 * @return null
	 */
	public function getPassword() {
		$this->layout->content = View::make('users.dashboard.password');
	}

	/**
	 * Try to update user password
	 *
	 * @return null or redirect
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
			return Redirect::to('users/password')
				->with('error', 'Existing password is wrong, or new passwords do not match.');
		}
	}

	/**
	 * Display password update form
	 *
	 * @return null
	 */
	public function getTfa() {
		$this->layout->content = View::make('users.tfa');
	}

	public function postChecktfa() {
		$credentials = array();
		$credentials = Session::get('credentials');
		$remember = Session::get('remember');
		$tfa = Input::get('tfa');

		// try logging in
		if (Auth::once($credentials))
		{
			$tfa_secret = Auth::user()->tfa_secret;
			$ga = new GoogleAuthenticator();
			$checkResult = $ga->verifyCode($tfa_secret, $tfa, 10);
			if ($checkResult) {
				Auth::attempt($credentials, $remember);
				Session::forget('credentials');
				if (Input::get('remember') == 1)
				{
					return Redirect::to('/users/dashboard')
						->withCookie(Cookie::make('deptfa', 'true', 43200))
						->with('message', 'You are now logged in!');
				}
				else
				{
					return Redirect::to('/users/dashboard')
						->with('message', 'You are now logged in!');
				}

			} else {
				return Redirect::to('users/tfa')
					->with('error','Invalid code');
			}
		}

	}

	/**
	 * Display security form
	 *
	 * @return null
	 */
	public function getSecurity() {
		$ga = new GoogleAuthenticator();
		$user = new User;
		$user = User::find(Auth::user()->id);
		$qrCodeUrl = $ga->getQRCodeGoogleUrl(Config::get('app.url'), Auth::user()->tfa_secret);
		$this->layout->content = View::make('users.dashboard.security')
			->with('qrCodeUrl', $qrCodeUrl)
			->with('user',$user);
	}

	/**
	 * Process security form
	 *
	 * @return null
	 */
	public function postSecurity() {

		$use_tfa = Input::get('use_tfa');
		$secret = Auth::user()->tfa_secret;

		if ($use_tfa == 1)
		{
			if (Auth::user()->use_tfa == 1)
			{
				// do nothing. This is already set
			} else {
				$ga = new GoogleAuthenticator();
				$secret = $ga->createSecret();
			}
		}

		// save new info
		$user = new User;
		$user = User::find(Auth::user()->id);
		$user->use_tfa = $use_tfa;
		$user->tfa_secret = $secret;
		$user->save();
		return Redirect::to('users/security')
			->with('message', 'Changes saved.');
	}

	/**
	 * Test a tfa code and return valid/invalid message
	 *
	 * @return String
	 */
	public function postTestcode() {
		$tfa_secret = Auth::user()->tfa_secret;
		$ga = new GoogleAuthenticator();
		$tfa = Input::get('testval');
		$checkResult = $ga->verifyCode($tfa_secret, $tfa, 10);
		if ($checkResult)
		{
			return "<span style='color: green'>Valid code!</span>";
		}
		else
		{
			return "<span style='color: red'>Invalid code!</span>";
		}
	}
}