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
		    return "Good! tested " . $phrase . " against " . Input::get('captcha');
		}
		else {
		   return Redirect::to('/contactus')
				->with('error', 'Incorrect validation characters entered!')
				->withInput();
		}
	}
}