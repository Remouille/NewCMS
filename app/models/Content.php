<?php

class Content extends Eloquent
{
    public $timestamps = false;

    public function page()
    {
        return $this->belongsTo('Page');
    }

	public static function seedPage($id)
	{
		message::$content = 'Des contenus ajoutés';
		$url = Page::find($id)->Template->url;
		$pageContent = file_get_contents($url);
		
		// Récupération de tous les marqueur d'un template
		$ctt = Content::parsing($pageContent);
		
		$i=0;
		// Ajout d'un nouveau tag vide
		foreach ($ctt as $key => $value) {
			// Vérif que le tag n'est pas deja dans la base
			if (Content::whereRaw('tag="'.$value.'" AND page_id='.$id)->count() == 0)
			{
				$content = new Content;
				$content->tag = $value;
				$content->content ='';
				$content->page_id = $id;
				$content->save();
				$i++;
			}
		}
		return $i . ' tags ajoutés dans la BdD !' ;
	}

	// Fonction qui renvoie un array avec la liste des Marqueurs
	public static function parsing($pageContent = "")
	{
		$explodedPage = explode("{{\$", $pageContent);
		unset($explodedPage[0]);
		foreach ($explodedPage as $key => $value) {
			$listTag[$key] = substr($value, 3, strpos($value,"']}}")-3);
		}
		// var_dump($listTag);
		return $listTag;
	}

	public static function nbTags($id)
	{
		// var_dump(Page::find($id)->Template->);
		
		$url = Page::find($id)->template->url;
		$pageContent = file_get_contents($url);
		
		// Récupération de tous les marqueur d'un template
		$ctt = Content::parsing($pageContent);

		
		return count($ctt);
	}
}