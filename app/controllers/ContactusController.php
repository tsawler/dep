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
		return View::make('pages.contact')->with('builder',$builder);
	}

}