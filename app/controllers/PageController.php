<?php

class PageController extends BaseController {
	
	public function show($id)
	{
		

		if (Auth::guest())
			$this->layout = 'site.layout';
		else
			if(Auth::user()->type == 'admin'){
				$this->layout = 'admin.layout';
			}

		$this->setupLayout();
		
		// Requete de tous les contenus de la page
		$ctt = Content::where('page_id', '=', $id)->get();

		// Je vérifie si tous les tags sont bien en BdD, sinon je les crée.
		if ($ctt->count() < Content::nbTags($id)){
			Content::seedPage($id);
			$ctt = Content::where('page_id', '=', $id)->get();			
		}

		// Transformation de l'objet en tableau
		foreach ($ctt as $ContentTag) {
			$listContent[$ContentTag->tag] = $ContentTag->content;
		}

		$tpl = PageController::findView($id);

		// Affichage de la vue
		$view = View::make($tpl)->with('t',$listContent);
		return $this->layout->with('content', $view)->with('page', Page::find($id));
	}




	public function showAndEdit($id)
	{
		
		$this->layout = 'admin.layout';
		$this->setupLayout();
		
		// Requete de tous les contenus de la page
		$ctt = Content::where('page_id', '=', $id)->get();
		// echo($ctt->count());
		
		// Je vérifie si tous les tags sont bien en BdD, sinon je les crée.
		if ($ctt->count() < Content::nbTags($id)){
			Content::seedPage($id);
			$ctt = Content::where('page_id', '=', $id)->get();			
		}
		// Transformation de l'objet en tableau
		foreach ($ctt as $ContentTag) {
			switch (substr($ContentTag->tag, 0, 1)) {
				case 'w':
					$link = '<a href="#" class="edit" data-pk="'.$ContentTag->id.'" data-type="textarea">'.$ContentTag->content.'</a>';
					break;				
				case 'c':
					$link = '<a href="#" class="edit" data-pk="'.$ContentTag->id.'" data-type="text">'.$ContentTag->content.'</a>';
					break;				
				case 'l':
					$link = '<a href="#" class="edit" data-pk="'.$ContentTag->id.'" data-type="text">'.$ContentTag->content.'</a>';
					$link = $link.'<a href="#" class="edit link" data-pk="toto" data-type="select"><i class="icon-search"></i></a>';
					break;
				default:
					$link = '<a href="#" class="edit" data-pk="'.$ContentTag->id.'" data-type="text">'.$ContentTag->content.'</a>';
					break;
			}
			$listContent[$ContentTag->tag] = $link;
		}

		$tpl = PageController::findView($id);

		// Affichage de la vue
		
		$view = View::make($tpl)->with('t',$listContent);
		return $this->layout->with('content', $view)->with('page', Page::find($id));
	}

	// Fonction pour transformer un Path en Nom de Template Blade
	private static function findView($id)
	{
		$template = Page::find($id)->template->url;
		$tpl = strstr($template,'/views/');
		$tpl = substr($tpl, 7);
		$tpl = substr($tpl, 0, strlen($tpl)-10);
		$tpl = str_replace('/', '.', $tpl);
		return $tpl;
	}

	public function getEditSettings($id)
	{
		foreach (Template::all() as $key => $value) {
			$tpl[$value->id] = $value->title;
		}

		return View::make('admin.partial.editPage', array('page' => Page::find($id), 'templates' => $tpl) );
	}

	public function postUpdate($id='')
	{
		$rule = array(
			'title' => 'Required|min:5',
			'url' => 'unique:pages,url,'.Input::get('id')
		);

		$validator = Validator::make(Input::all(), $rule);

		if ($validator->fails()){
			$response = $validator->messages();
			return Response::json($response);
		}else{
			$page = Page::find(Input::get('id'));
			$page->title = Input::get('title');
			$page->url = Input::get('url');
			$page->save();
			$resp = new stdClass;
			$resp->resp = true;
			$resp->messages = '<div class="alert alert-success message"><strong>Well done !</strong> It\'s correctly saved.</div>';
			$resp->redirect = '?';
			return Response::json($resp);
		}
	}
}