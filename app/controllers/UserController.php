<?php

class UserController extends BaseController {
	public function postLogin()
	{
		$resp = new stdClass;
		// Auth::attempt(array('username'=>Input::get('username'), 'password'=>Input::get('password')), true)
		if (Auth::attempt(array('username'=>Input::get('username'), 'password'=>Input::get('password')), true)){
			$resp->resp = true;
			$resp->message = '<div class="alert alert-success hide">Authentication Succeed! Wait...</div>';
			$resp->redirect = '?';
			// $firstname =  Auth::user()->firstname;
			// $lastname = Auth::user()->lastname;
			$theUser = Auth::user();

			$message = 'Welcome back '. $theUser->firstname .' '. $theUser->lastname . ' ! ! !';
			Session::put('message', $message);
			Session::put('messageType', 'alert-success');
		}else{
			$resp->resp = false;
			$resp->message = '<div class="alert alert-error hide">Wrong Password</div>';
		}
		return Response::json($resp);
		// return $a;
	}
	public function getLogout()
	{
		Auth::logout();
		return Redirect::to('/');
	}
	public function getCheck()
	{
		if (!Auth::guest())
			return Auth::user()->firstname. " est logué";
		else
			return 'Non Logué';
	}
	public function getEditSettings($id)
	{
		return View::make('admin.partial.editUser', array('user' => User::find($id) ) );
	}

	public function postUpdate($id='')
	{
		$rule = array(
			'username' => 'Required|min:4|unique:users,username,'.Input::get('id'),
			'email' => 'Required|unique:users,email,'.Input::get('id'),
			'avatar' => 'image|max:3000'
		);

		$validator = Validator::make(Input::all(), $rule);

		if ($validator->fails()){
			$response = $validator->messages();
			return Response::json($response);
		}else{
			// Enregistrement !
			$user = User::find(Input::get('id'));
			$user->username = Input::get('username');
			$user->firstname = Input::get('firstname');
			$user->lastname = Input::get('lastname');
			$user->email = Input::get('email');
			// $user->avatar = Input::file('avatar')->getSize();
			// var_dump(Input::file('file'));
			$user->avatar = Input::file('file')->getClientOriginalName();
			$user->save();

			// Création de la réponse 
			$resp = new stdClass;
			$resp->resp = true;
			$resp->messages = '<div class="alert alert-success message"><strong>Well done !</strong> It\'s correctly saved.</div>';
			$resp->redirect = '?';
			return Response::json($resp);
		}
	}
}