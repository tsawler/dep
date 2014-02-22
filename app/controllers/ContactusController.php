<?php

class ContactusController extends BaseController {

	public function __construct() {
		$this->beforeFilter('csrf', array('on'=>'post'));
	}
	
	public function getContactus(){
		return View::make('pages.contact');
	}

}