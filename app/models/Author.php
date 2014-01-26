<?php

class Author extends Eloquent {

	protected $table = 'authors';

	protected $hidden = array();

	public function getId() {
		return $this->getKey();
	}

	public function getPen_name() {
		return $this->pen_name;
	}
	
	public function getActive() {
		return $this->active;
	}
	
	public function getPhone() {
		return $this->phone;
	}
	
	public function getAddress() {
		return $this->address;
	}
}