<?php

class RouteController extends PageController {

	/*
	|--------------------------------------------------------------------------
	| Trouver si le Slug correspond à une URL en base et renvoyer la page
	|--------------------------------------------------------------------------
	*/
	public function getPage($slug)
	{
		$page = Page::where('url', '=', $slug)->first();
		if ($page)
			return $this->showPage($page->id);
		else
			return $this->show404();
	}

	/*
	|--------------------------------------------------------------------------
	| Affichage de la page
	|--------------------------------------------------------------------------
	*/
	public function showPage($id)
	{
		// ;
		if (Auth::guest())
			return $this::show($id);
		else
			if(Auth::user()->type == 'admin' && !((Request::has('preview'))) )
				return $this::showAndEdit($id);
			else
				return $this::show($id);
	}


	/*
	|--------------------------------------------------------------------------
	| Affichage de la 404
	|--------------------------------------------------------------------------
	*/
	public function show404()
	{
		return Response::view('error.404', array(), 404);
	}
}