<?php

class PublisherInfo extends Eloquent  {

	public static $rules = array(
	   'address'=>'required|min:2',
	   'city'=>'required|min:2',
	   'phone'=>'required|min:10',
	   'province'=>'required',
	   'country'=>'required',
	   'zip'=>'required|min:5'
	);
	
	protected $guarded = array('*');


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
}