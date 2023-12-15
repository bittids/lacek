<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class More_user_info extends Model
{
    use HasFactory;

    protected $table = 'more_user_info';
    
    public function user()
    {
        return $this->belongsTo('App\Models\User')->withDefault();
    }
     
    public function client()
    {
        return $this->hasOne('App\Models\Client')->withDefault();
    }

        
    public function content_provider()
    {
        return $this->belongsTo('App\Models\Content_provider')->withDefault();
    }

    
    public function timezone()
    {
        return $this->belongsTo('App\Models\Timezone');
    }
    
    public function language()
    {
        return $this->belongsTo('App\Models\Language');
    }
   
    public function language_capable()
    {
        return $this->hasMany('App\Models\Language_capable');
    }
    
    
    public function country()
    {
        return $this->belongsTo('App\Models\Country');
    }

    // start unclassified functions

    public function int_get_random($int_min, $int_max)
    {
        return rand($int_min, $int_max);
    }

    public function str_get_complete_cell($str_country_calling_code, $str_phone)
    {
        //return "+".$str_country_calling_code.$str_phone;

        // temp code - vonage only allows transmission to registered numbers
        return "+50768274823";
    }
 
    public function str_get_friendly_country_code($str_country_calling_code)
    {
        return "+".$str_country_calling_code;

        // temp code - vonage only allows transmission to registered numbers
      //  return "+50768274823";
    }
  
  // this is modified from 
  // https://stackoverflow.com/questions/4708248/formatting-phone-numbers-in-php
    public function str_get_friendly_phone($str_phone)
    {
        $phoneNumber = preg_replace('/[^0-9]/','', $str_phone);

        if(strlen($phoneNumber) == 10) {
            $areaCode = substr($phoneNumber, 0, 3);
            $nextThree = substr($phoneNumber, 3, 3);
            $lastFour = substr($phoneNumber, 6, 4);
    
            $phoneNumber = '('.$areaCode.') '.$nextThree.'-'.$lastFour;
        }
        else if(strlen($phoneNumber) == 8) {
            $firstFour = substr($phoneNumber, 0, 4);
            $lastFour = substr($phoneNumber, 4, 4);
    
            $phoneNumber = $firstFour.'-'.$lastFour;
        }
        else if(strlen($phoneNumber) == 7) {
            $nextThree = substr($phoneNumber, 0, 3);
            $lastFour = substr($phoneNumber, 3, 4);
    
            $phoneNumber = $nextThree.'-'.$lastFour;
        }
    
        return $phoneNumber;
    }
     
}
