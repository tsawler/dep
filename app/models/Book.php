<?php

class Book extends Eloquent {

	protected $table = 'books';

	protected $hidden = array();

	public function getId() {
		return $this->getKey();
	}

	public function getBook_title() {
		return $this->book_title;
	}
	
	public function getAuthor_id() {
		return $this->author_id;
	}
	
	public function getPublication_date() {
		return $this->publication_date;
	}
	
	public function getActive() {
		return $this->active;
	}
	
}