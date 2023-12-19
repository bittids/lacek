<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;



class UsersSeeder extends Seeder
{    
	private $role;
    private $role_user;
    private $user;
    
    public function __construct(User $user)
    {
        $this->user = $user;
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        // I remover the actual password, as this is stored in the repository
        $this->user->create(array(
       //     'first_name'     => 'Doug',
       //     'last_name' => 'Bittinger',
       		'name'		=> 'Doug Bittinger',
            'email'    => 'bittids@gmail.com',
            'password' => Hash::make('12345678'),
        )); 
 // 230515 the current password is cat, 1996, 3rd letter caps, fav num twice, exclamation point
        //
    }
}
