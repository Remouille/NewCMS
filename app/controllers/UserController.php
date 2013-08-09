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
}