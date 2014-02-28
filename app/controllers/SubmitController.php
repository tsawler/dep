<?php

class SubmitController extends BaseController {

	public function __construct() {
		$this->beforeFilter('csrf', array('on'=>'post'));
		$this->beforeFilter('auth', array('only'=>array('postCreate')));
	}

	protected $layout = "layout";
	
	/**
	 * Display manuscript submission form, or redirect to login
	 *
	 * @return null
	 */
	public function getIndex()
	{
		if (Auth::check()){
			$this->layout->content = View::make('submit.index');
		} else {
			return Redirect::to('users/login')
					->with('message', 'You must <a href="/users/register">create an account</a> or login first!')
					->with('targetUrl', '/submit/index');
		}
	}
	
	
	/**
	 * handle manuscript submission
	 *
	 * @return null
	 */
	public function postCreate() {
	
		$validator = Validator::make(Input::all(), Submission::$rules);
		
		if ($validator->passes()) {
		
			// get the file
			$mime_type = Input::file('manuscript')->getMimeType();
			$file = Input::file('manuscript');
			$destinationPath = base_path() . '/manuscriptUploads/'.Auth::user()->id."/";
			$filename = str_random(10) . "_" . $file->getClientOriginalName();
			
			$upload_success = Input::file('manuscript')->move($destinationPath, $filename);
			
			if ($upload_success) {
				// get file contents
				$content = file_get_contents($destinationPath.$filename);
				
				// create a new Submission record and save the data
				$submission = new Submission;
				$submission->user_id = Auth::user()->id;
				$submission->pen_name = Input::get('pen_name');
				$submission->manuscript_title = Input::get('manuscript_title');
				$submission->manuscript = Auth::user()->id."/".$filename;
				$submission->manuscript_submitted = $content;
				$submission->mime_type = $mime_type;
				$submission->status = 1;
				$submission->save();
				
				// send email
				// build email
				$user = array(
					'email'=>Auth::user()->email,
					'first_name'=>Auth::user()->first_name
				);
		
				// the data that will be passed into the mail view blade template
				$data = array(
					'users_name'  => Auth::user()->first_name,
					'manuscript_title' => Input::get('manuscript_title')
				);
		
				// use Mail::send function to send email passing the data and using the $user variable in the closure
				Mail::after(5,'submit.manuscript_received_email', $data, function($message) use ($user) {
						$message->from('donotreply@dogearedpress.ca', 'Do not reply');
						$message->to($user['email'], $user['first_name'])->subject('Your manuscript has been received');
				});
				
				Mail::queue('emails.submission', $data, function($message) use ($user)  {
					$message->from('donotreply@dogearedpress.ca', 'Do not reply');
					$message->to(Config::get('app.notify_email'), 'Editor')->subject('Manuscript submitted to DEP');
				});
				
				$this->layout->content = View::make('submit.submitted');
				
			} else {
				return Redirect::to('submit/index')->with('message', 'There was an error with your submission!');
			}
		} else {
			return Redirect::to('submit/index')->with('message', 'The following errors occurred')->withErrors($validator)->withInput();
		}
	}

}