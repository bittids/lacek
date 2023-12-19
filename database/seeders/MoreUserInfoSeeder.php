<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\More_user_info;
use App\Models\User;

class MoreUserInfoSeeder extends Seeder
{
      var $obj_user;
      var $obj_more_user_info;
    
    public function __construct(
        User $obj_user, More_user_info $obj_more_user_info
        )
    {
        $this->obj_user = $obj_user;
        $this->obj_more_user_info = $obj_more_user_info;
    }
    
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('more_user_info')->delete();
        
        $obj_user = $this->obj_user
        ->where('email', 'bittids@gmail.com')
        ->first();
        
  //      dd($obj_user);
        
        $this->obj_more_user_info->str_first_name = "Douglas";
        $this->obj_more_user_info->str_last_name = "Bittinger";
        $this->obj_more_user_info->user_id = $obj_user->id;
        $this->obj_more_user_info->save();
        
        //
    }
}
