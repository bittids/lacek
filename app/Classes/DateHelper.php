<?php
namespace App\Classes;

use Carbon\Carbon;


class DateHelper
{
//	var $obj_logged_in_user;
//	var $arr_logged_in_user;
	
	
    public function carbon_date_get_date($date_date)
    {
        return new Carbon($date_date);
    }

// this would return monday, 25th of may, 2023, 11:57 PM
    public function str_format_date_one($carbon_date)
    {      
        return $carbon_date->format('l jS \of F Y h:i:s A');
    }

// this would return may 25th, 2023 11:57 PM
    public function str_format_date_two($carbon_date)
    {      
        return $carbon_date->format('F jS, Y,  h:i:s A');
    }

    // this would return may 25th, 2023 11:57 PM
    public function str_format_date_short($carbon_date)
    {      
        return $carbon_date->format('Y-m-d,  h:i:s A');
    }

    public function carbon_get_curr_date_time()
    {      
        return Carbon::now();
    }

    public function carbon_get_now_add_minutes($int_minutes)
    {      
        return Carbon::now()->addMinutes($int_minutes);
    }

    

}