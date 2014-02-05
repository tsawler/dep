<?php

class MenuController extends BaseController {

	public function __construct() {
		//$this->beforeFilter('csrf', array('on'=>'post'));
		$this->beforeFilter('auth', array('only'=>array('getMenujson')));
	}

	protected $layout = "layout";

	
	/**
	 * Save edits to page (in place, called via ajax)
	 *
	 * @return text
	 */
	 public function getMenujson(){
		if (Auth::user()->access_level == 3){
			$menu_item_id = Input::get('id');
			$menu_item = MenuItem::find($menu_item_id);
			if ($menu_item->page_id == 0) 
			{
				$theResponse = array(
					'menu_text' => $menu_item->menu_text,
					'page_id' => $menu_item->page_id,
					'active' => $menu_item->active,
					'url' => $menu_item->url
				);
			}
			else
			{
				$theResponse = array(
					'menu_text' => $menu_item->menu_text,
					'page_id' => $menu_item->page_id,
					'active' => $menu_item->active,
					'url' =>''
				);
			}
			
			return Response::json($theResponse);
		}
	}

}