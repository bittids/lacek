<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // start table relationship

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    // end table relaationships

    // start validation rules functions

    public function getValRulesCreatePost($obj_regex_helper)
    {
        $str_regex = $obj_regex_helper->str_val_safe_chars();
       return array(
        'str_title' => ['required', $str_regex],     
        'str_post' => ['required', $str_regex],     
          
       );
    }

    // end validation rules functions

    // start val messages functions

    public function getValMessagesCreatePost()
    {
        $str_message_req = __('models/model_chat.str_message_req');
        $str_message_alpha = __('models/model_chat.str_message_alpha');


        return [
            'str_title.required' => $str_message_req,
            'str_title.regex' => $str_message_alpha,
            'str_post.required' => $str_message_req,
            'str_post.regex' => $str_message_alpha,
         ];
    }

    // end val messages functions

    // start unclassified functions
    
    public function coll_get_formatted_date($coll_posts, $obj_date_helper)
    {
        foreach($coll_posts as &$coll_post)
        {
            $coll_post->str_created_at_formatted = $obj_date_helper->str_format_date_short($coll_post->created_at);
        }
        return $coll_posts;
    }

    public function coll_get_owsned_posts($user_id)
    {
        return $this->where('user_id', $user_id)
                    ->get();
    }

}
