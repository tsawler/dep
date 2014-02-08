<?php

class MailRecipientController extends BaseController {

	public function __construct() {
		$this->beforeFilter('csrf', array('on'=>'post'));
	}

	protected $layout = "layout";
	
	
	/**
	 * Show user in form
	 *
	 * @return mixed
	 */
	public function joinList(){
	
		$validator = Validator::make(Input::all(), MailRecipient::$rules);
		
		if ($validator->passes()) 
		{
			$email = Input::get('email');
			$recipient = new MailRecipient;
			$recipient->email = $email;
			$recipient->save();
	
			Return Redirect::to(URL::previous())
				->with('message', 'Thanks. You have been added to our list.');
		
		} else {
		
			Return Redirect::to(URL::previous())
				->with('error', 'The following errors occurred')
				->withErrors($validator)
				->withInput();
		}
	}
}