<?php
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface
{
    public $timestamps = false;

    protected $table = 'users';
    protected $primaryKey = 'id';

	public function getAuthIdentifier()
	{
		return $this->getKey();
	}
	public function getAuthPassword()
	{
		return $this->password;
	}

    public function websites()
    {
        return $this->hasMany('Website');
    }
    
}