<?php

class ContentController extends BaseController {

	public function getSave($id, $value = '')
	{
		$ctt = Content::find($id);
		if (isset($ctt))
		{
			$ctt->content = $value;
			$ctt->save();
			return "Le contenu a bien été enregistré";
		}else{
			return "L'id de ce contenu n'existe pas";
		}
	}
	public function getView($id)
	{
		$ctt = Content::find($id);
		if (isset($ctt))
		{
			return $ctt;
		}else{
			return "L'id de ce contenu n'existe pas";
		}
	}
	public function getEdit($id)
	{
		$ctt = Content::find($id);
		if (isset($ctt))
		{
			return $ctt;
		}else{
			return "L'id de ce contenu n'existe pas";
		}
	}
	public function QuickSave()
	{
        $ctt = Content::find(Input::get('pk'));
        $ctt->content = Input::get('value');
        return $ctt->save();
	}
}