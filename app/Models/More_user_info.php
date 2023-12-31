<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\Factory;
use Database\Factories\MoreUserInfoFactory;

class More_user_info extends Model
{
    use HasFactory;

    protected $table = 'more_user_info';

    public function user()
    {
        return $this->belongsTo('App\Models\User')->withDefault();
    }



    // start unclassified functions

    public function int_get_random($int_min, $int_max)
    {
        return rand($int_min, $int_max);
    }
}
