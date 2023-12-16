<?php
namespace App\Classes;

use Auth;
//use App\Models\Role_user;

class RegexHelper
{
	
    // this permits alpha numberic chars, dashes, underlines, and spaces
	public function str_val_safe_chars()
	{
	
		return 'regex:/^[A-Za-z0-9_\- ]+$/i';
	}

}