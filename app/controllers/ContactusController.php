<?php
use Gregwar\Captcha\CaptchaBuilder;

class ContactusController extends BaseController {

	public function __construct() {
		$this->beforeFilter('csrf', array('on'=>'post'));
	}
	
	public function getContactus(){
		$builder = new CaptchaBuilder;
		$builder->setDistortion(false);
		$builder->build();
		Session::flash('captcha', $builder->getPhrase());
		return View::make('pages.contact')->with('builder',$builder);
	}
	
	
	public function postContactus(){
		$phrase = Session::get('captcha');
		if(strtoupper($phrase) == strtoupper(Input::get('captcha'))) {
		    
		    
		    // build email
			$user = array(
				'email'=>Input::get('email'),
				'name'=>Input::get('name')
			);

			// the data that will be passed into the mail view blade template
			$data = array(
				'users_name'  => $user['name'],
				'the_message'=>Input::get('message'),
				'email'=>Input::get('email')
			);
			
			// use Mail::send function to send email passing the data and using the $user variable in the closure
			Mail::send('emails.contact_email', $data, function($message) use ($user) {
					$message->from('donotreply@dogearedpress.ca', 'Do not reply');
					$message->to('query@dogearedpress.ca', 'dogearedpress.ca')->subject('Contact form from dogearedpress.ca');
			});
			
			return Redirect::to('/Thanks');
		}
		else {
		   return Redirect::to('/contactus')
				->with('error', 'Incorrect validation characters entered!')
				->withInput();
		}
	}
}