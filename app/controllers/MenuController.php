<?php

class MenuController extends BaseController {

	public function __construct() {
		//$this->beforeFilter('csrf', array('on'=>'post'));
		$this->beforeFilter('auth', array('only'=>array('getMenujson')));
	}

	protected $layout = "layout";

	
	/**
	 * Get menu for edit (in place, called via ajax)
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
	
	/**
	 * Get dd menu for edit (in place, called via ajax)
	 *
	 * @return text
	 */
	 public function getDdmenujson(){
		if (Auth::user()->access_level == 3){
			$menu_item_id = Input::get('id');
			$menu_item = MenuDropdownItem::find($menu_item_id);
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
	
	/**
	 * Save or create menu item
	 *
	 * @return void
	 */
	 public function postSavemenuitem(){

		if (Auth::user()->access_level == 3){
			$menu_item_id = Input::get('menu_item_id');
			$menu_text = Input::get('menu_text');
			$menu_page_id = Input::get('menu_page_id');
			$menu_active = Input::get('menu_active');
			$menu_url = Input::get('menu_url');
			
			$menuItem = MenuItem::find($menu_item_id);
			
			if ($menuItem === null)
			{
				$menuItem = new MenuItem;
				$menuItem->menu_text = $menu_text;
				$menuItem->page_id = $menu_page_id;
				$menuItem->active = $menu_active;
				$menuItem->url = $menu_url;
				$menuItem->save();
			}
			else
			{
				$menuItem->menu_text = $menu_text;
				$menuItem->page_id = $menu_page_id;
				$menuItem->active = $menu_active;
				$menuItem->url = $menu_url;
				$menuItem->save();
			}
			
			return Redirect::to(URL::previous())
				->with('message', 'Changes saved.');
		}
	}
	
	/**
	 * Save or create dd menu item
	 *
	 * @return void
	 */
	 public function postSaveddmenuitem(){
	 
	 	Log::info('This is some useful information.');

		if (Auth::user()->access_level == 3){
			$menu_item_id = Input::get('ddmenu_item_id');
			$menu_text = Input::get('ddmenu_text');
			$menu_page_id = Input::get('ddmenu_page_id');
			$menu_active = Input::get('ddmenu_active');
			$menu_url = Input::get('ddmenu_url');
			$menu_id = Input::get('dd_parent_menu_item_id');
			
			Log::info('menu item id is ' . $menu_item_id);
			
			//$menuItem = MenuDropdownItem::find($menu_item_id);
			$menuItem = MenuDropdownItem::where('id', '=', $menu_item_id)->first();
			
			if ($menuItem === null)
			{
				Log::info('Saving new one.');
				$menuItem = new MenuDropdownItem;
				$menuItem->menu_text = $menu_text;
				$menuItem->page_id = $menu_page_id;
				$menuItem->active = $menu_active;
				$menuItem->menu_item_id = $menu_id;
				$menuItem->url = $menu_url;
				$menuItem->save();
			}
			else
			{
				Log::info('updating menu item ' . $menuItem->id);
				$menuItem->menu_text = $menu_text;
				$menuItem->page_id = $menu_page_id;
				$menuItem->active = $menu_active;
				$menuItem->url = $menu_url;
				$menuItem->save();
			}
			
			return Redirect::to(URL::previous())
				->with('message', 'Changes saved.');
		}
	}
}