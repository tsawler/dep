<?php

class Submission extends Eloquent  {

	public static $rules = array(
	   'phone'=>'required',
	   'manuscript'=>'required',
	   'manuscript_title'=>'required'
	);
	
	protected $guarded = array('*');
	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'submissions';

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}
	
	public function getManuscript_title()
	{
		return $this->manuscript_title;
	}
	
	public function getPen_name()
	{
		return $this->pen_name;
	}
	
	public function users()
    {
        return $this->belongsTo('User', 'user_id', 'id');
    }
    
    public function author()
    {
        return $this->hasOne('PublisherInfo', 'user_id', 'user_id');
    }

}