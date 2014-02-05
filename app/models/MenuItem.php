<?php

class MenuItem extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'menu_items';

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}
	
	public function dropdownItems()
    {
        return $this->hasMany('MenuDropdownItem')->orderBy('sort_order');;
    }
    
    public function targetPage()
    {
	    return $this->hasOne('Page', 'id', 'page_id');
    }
}