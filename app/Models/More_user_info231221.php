<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\Factory;
use Database\Factories\MoreUserInfoFactory;

class More_user_info231221 extends Model
{
    use HasFactory;

    protected $table = 'more_user_info';

    // from Laravel docs, at
    // https://laravel.com/docs/10.x/eloquent-factories
  //  protected static function newFactory(): Factory
  // {
  //      return MoreUserInfoFactory::new();
  //  }

    
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
