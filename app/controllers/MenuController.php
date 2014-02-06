<?php

class MenuController extends BaseController {

	public function __construct() {
		$this->beforeFilter('auth', array('only'=>array('getMenujson')));
		$this->beforeFilter('auth', array('only'=>array('getDdmenujson')));
		$this->beforeFilter('auth', array('only'=>array('postSavemenuitem')));
		$this->beforeFilter('auth', array('only'=>array('postSaveddmenuitem')));
		$this->beforeFilter('auth', array('only'=>array('postDeleteddmenuitem')));
		$this->beforeFilter('auth', array('only'=>array('postDeletemenuitem')));
		$this->beforeFilter('auth', array('only'=>array('getDdsortitems')));
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
					'url' => $menu_item->url,
					'has_children' => $menu_item->has_children
				);
			}
			else
			{
				$theResponse = array(
					'menu_text' => $menu_item->menu_text,
					'page_id' => $menu_item->page_id,
					'active' => $menu_item->active,
					'url' =>'',
					'has_children' => $menu_item->has_children
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
			$has_children = Input::get('has_children');
			
			$menuItem = MenuItem::find($menu_item_id);
			
			if ($menuItem === null)
			{
				$so = MenuItem::where('menu_id', '=', '1')->max('sort_order');
				$menuItem = new MenuItem;
				$menuItem->sort_order = $so;
				$menuItem->menu_text = $menu_text;
				$menuItem->page_id = $menu_page_id;
				$menuItem->active = $menu_active;
				$menuItem->url = $menu_url;
				$menuItem->has_children = $has_children;
				$menuItem->menu_id = 1;
				$menuItem->save();
			}
			else
			{
				$menuItem->menu_text = $menu_text;
				$menuItem->page_id = $menu_page_id;
				$menuItem->active = $menu_active;
				$menuItem->has_children = $has_children;
				$menuItem->url = $menu_url;
				$menuItem->save();
				
				// handle sorting
				$sort = json_decode(Input::get('sortorder'));;
				
				$i = 1;
				foreach($sort as $name => $value){
					$menu = MenuItem::find($value->id);
					$menu->sort_order = $i;
					$menu->save();
					$i++;
				}
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

		if (Auth::user()->access_level == 3){
			$menu_item_id = Input::get('ddmenu_item_id');
			$menu_text = Input::get('ddmenu_text');
			$menu_page_id = Input::get('ddmenu_page_id');
			$menu_active = Input::get('ddmenu_active');
			$menu_url = Input::get('ddmenu_url');
			$menu_id = Input::get('dd_parent_menu_item_id');
			
			$menuItem = MenuDropdownItem::where('id', '=', $menu_item_id)->first();
			
			if ($menuItem === null)
			{	
				Log::info("menu id is $menu_id");
				$so = MenuDropdownItem::where('menu_item_id', '=', $menu_id)->max('sort_order');
				$menuItem = new MenuDropdownItem;
				$menuItem->menu_text = $menu_text;
				$menuItem->page_id = $menu_page_id;
				$menuItem->active = $menu_active;
				$menuItem->menu_item_id = $menu_id;
				$menuItem->url = $menu_url;
				$menuItem->sort_order = $so + 1;
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
	 * Delete menu item
	 *
	 * @return mixed
	 */
	public function postDeletemenuitem(){
		if (Auth::user()->access_level == 3){
		// check to see if it has any children
		$children = MenuDropdownItem::where('menu_item_id', '=', Input::get('deleteid'))->count();
		
		if ($children == 0)
		{
			$menuItem = MenuItem::find(Input::get('deleteid'));
			$menuItem->delete();
			
			return Redirect::to(URL::previous())
					->with('message', 'Changes saved.');
		}
		else
		{
			return Redirect::to(URL::previous())
					->with('error', 'You cannot delete a menu that still has items under it! Delete the items first.');
		}
		}
	}
	
	/**
	 * Delete submenu item
	 *
	 * @return mixed
	 */
	public function postDeleteddmenuitem(){
		if (Auth::user()->access_level == 3){
		$menuItem = MenuDropdownItem::find(Input::get('dddeleteid'));
		$menuItem->delete();
		
		return Redirect::to(URL::previous())
				->with('message', 'Changes saved.');
		}
	}
	
	/**
	 * Return html for sortable menu list
	 *
	 * @return string
	 */
	public function getDdsortitems() {
		// create list of sortable top level menu items
		$menu_items = MenuDropdownItem::where('menu_item_id','=', Input::get('id'))->orderBy('sort_order', 'ASC')->get();
		
		$theHtml = '<div class="dd" id="nestable">'
			. '<ol class="dd-list">';
		
		foreach($menu_items as $item){
			$theHtml .= '<li class="dd-item" data-id="'
				. $item->id
				. '">'
				. '<div class="dd-handle">'
				. $item->menu_text
				. '</div>'
				. '</li>';
		}
		$theHtml .= '</ol></div>';
		return $theHtml;
	}
}