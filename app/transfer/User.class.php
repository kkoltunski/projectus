<?php

namespace app\transfer;

use core\App;

class User{
	public $pesel;
	public $role;
	
	public function __construct($date)
	{
		$this->pesel = $date[0];
		$this->role = "user";		
	}	
}