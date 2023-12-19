<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Comment;
use App\Models\More_user_info;
use App\Models\Post;
use App\Models\User;
//use App\Models\MoreUseInfor;

use Database\Factories\MoreuserInfoFactory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    
    public function run(): void
    {
        
        $this->call([
            UsersSeeder::class,
            MoreUserInfoSeeder::class,
    	]);
      //   \App\Models\User::factory(10)->create();

         // see https://stackoverflow.com/questions/35449226/laravel-seeding-relationships
         //create 10 users
        User::factory(10
            )->create()
            ->each(function ($user) 
            {
        //create 5 posts for each user
                Post::factory(5)
                    ->create(['user_id'=>$user->id])
                    ->each(function ($post) use ($user) 
                    {  
                        // create two comments for each post
                        Comment::factory(2)
                            ->create(['user_id'=>$user->id, 'post_id'=>$post->id]);
                    });
                 More_user_info::factory(1)->create(['user_id'=>$user->id]);

        });

        

           

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
