<?php

use Illuminate\Support\MessageBag;

class LoginController extends BaseController {

	public function processLogin() {
		
		$errors = new MessageBag();
		
        if ($old = Input::old("errors")) {
            $errors = $old;
        }
        
        $data = [
            "errors" => $errors
        ];

		if (Input::server("REQUEST_METHOD") == "POST") {
            $validator = Validator::make(Input::all(), [
                "username" => "required",
                "password" => "required"
            ]);
            
			if ($validator->passes()) {
                $credentials = [
                    "email" => Input::get("username"),
                    "password" => Input::get("password")
                ];
                if (Auth::attempt($credentials)) {
                	session_start();
					$_SESSION['KCFINDER']['disabled'] = false;
                    return Redirect::route("/");
                }
            } else {
                $data["errors"] = new MessageBag([
                    "password" => [
                        "Username and/or password invalid."
                    ]
                ]);
                
                $data["username"] = Input::get("username");
                return Redirect::route("/users/login")
                    ->withInput($data);
            }
        }
        return View::make('users.login');
        //Route::post('/login', 'LoginController@processLogin');
	}

}