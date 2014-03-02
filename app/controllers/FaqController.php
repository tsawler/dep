<?php

class FaqController extends BaseController {

	public function __construct() {
		$this->beforeFilter('auth', array('only'=>array('showUser')));
	}
	
	/**
	 * Show faq page
	 *
	 * @return mixed
	 */
	public function showFaqPage()
	{
		$faqs = Faq::where('active', '=', '1')->orderby('id')->get();
		return View::make('pages.faqs')->with('faqs',$faqs);
	}
	
	
	/**
	 * Edit FAQs
	 *
	 * @return mixed
	 */
	public function editFaq(){
			if (Auth::user()->access_level == 3){
				$faq_id = Input::get('faq_id');
				$faq = Faq::find($faq_id);
				
				$faq->label = trim(Input::get('thelabeldata_'.$faq_id));
				$faq->question = trim(Input::get('thequestiondata_'.$faq_id));
				$faq->answer = trim(Input::get('theanswerdata_'.$faq_id));
				$faq->save();
				return "FAQ updated successfully";
		}
	}
}