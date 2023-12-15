<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    use HasFactory;
           
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
        
    public function session()
    {
        return $this->belongsTo('App\Models\Session');
    }
       
    public function login_verification()
    {
        return $this->hasMany('App\Models\Login_verification');
    }


}
