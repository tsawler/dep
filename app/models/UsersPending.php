<?php

class UsersPending extends Eloquent {

	protected $table = 'users_pending';

	protected $hidden = array();

	public function getId()
	{
		return $this->getKey();
	}

	public function getJoin_key()
	{
		return $this->join_key;
	}
	
	public function getEmail()
	{
		return $this->email;
	}
}