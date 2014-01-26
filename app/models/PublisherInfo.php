<?php

class PublisherInfo extends Eloquent  {


	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'publisher_info';

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}
	
	public function user()
    {
        return $this->belongsTo('User');
    }
    
    public function address()
    {
	    return $this->address;
    }
    
    public function user_id()
    {
	    return $this->user_id;
    }

}