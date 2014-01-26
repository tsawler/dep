<?php

class Page extends Eloquent {

	protected $table = 'pages';

	protected $hidden = array();

	public function getId()
	{
		return $this->getKey();
	}

	public function getPage_name()
	{
		return $this->page_name;
	}
	
	public function getPage_title()
	{
		return $this->page_title;
	}

	public function getPage_content()
	{
		return $this->page_content;
	}
	
	public function getActive()
	{
		return $this->active;
	}
	
	public function getMeta()
	{
		return $this->meta;
	}

}