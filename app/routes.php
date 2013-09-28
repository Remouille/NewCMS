<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


/*
|--------------------------------------------------------------------------
| URL de l'administration
|--------------------------------------------------------------------------
*/
Route::filter('auth', function(){
	if(Auth::guest()){
		Session::flash('message', 'Merci de vous authentifier !');
		return Response::view('admin.authent');
	}else{
		if (Auth::user()->type != 'admin')
			return 'Vous n\'êtes pas authorisé';
	}
});

Route::group(array('prefix' => 'admin', 'before' => 'auth'), function()
{

	Route::any('siteSettings', array('as'=>'siteSettings', function()
	{
		return View::make('admin.sitesettings')->with('title','Website settings')->with('pages', Page::all());
	}));
	Route::any('content/quicksave', 'ContentController@QuickSave');
	Route::controller('content', 'ContentController');
	Route::controller('page', 'PageController');
	Route::controller('user', 'UserController');
	
	
	Route::any('{slug}', function($slug)
	{
		// return Redirect::to('user/login');
		// return "ADMIN : ". $slug;
		return Redirect::route('siteSettings');
	})->where('slug', '([A-z\d-\/_.]+)?');

	Route::any('', function()
	{
		return Redirect::route('siteSettings');
	});

});

/*
|--------------------------------------------------------------------------
| Toutes les autres URL du site vont vers le controller
|--------------------------------------------------------------------------
*/

Route::controller('user', 'UserController');

Route::any('{slug}', 'RouteController@getPage')->where('slug', '([A-z\d-\/_.]+)?');