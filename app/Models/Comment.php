<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    // start table relationship
    
    public function post()
    {
        return $this->belongsTo('App\Models\Post');
    }
    
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    // end table relaationships

    // start validation rules functions

    public function getValRulesChooseComment($obj_regex_helper)
    {
      
       return array(
        'comment_id' => ['required', 'integer', 'exists:comments,id'],               
       );
    }

    public function getValRulesCreateComment($obj_regex_helper)
    {
        $str_regex = $obj_regex_helper->str_val_safe_chars();
       return array(
    //    'str_title' => ['required', $str_regex],     
        'str_comment' => ['required', $str_regex],     
          
       );
    }

    // end validation rules functions

    // start val messages functions

    public function getValMessagesChooseComment()
    {
        $str_message_req = __('models/model_chat.str_message_req');
        $str_message_alpha = __('models/model_chat.str_message_alpha');


        return [
            'str_title.required' => $str_message_req,
            'str_title.regex' => $str_message_alpha,
            'str_comment.required' => $str_message_req,
            'str_comment.regex' => $str_message_alpha,
         ];
    }

    public function getValMessagesCreateComment()
    {
        $str_message_req = __('models/model_chat.str_message_req');
        $str_message_alpha = __('models/model_chat.str_message_alpha');


        return [
         //   'str_title.required' => $str_message_req,
         //   'str_title.regex' => $str_message_alpha,
            'str_comment.required' => $str_message_req,
            'str_comment.regex' => $str_message_alpha,
         ];
    }

    // end val messages functions

    // start unclassified functions
    
    public function coll_get_formatted_date($coll_comments, $obj_date_helper)
    {
        foreach($coll_comments as &$coll_comment)
        {
            $coll_comment->str_created_at_formatted = $obj_date_helper->str_format_date_short($coll_comment->created_at);
        }
        return $coll_comments;
    }

    public function coll_get_active_comments()
    {
        return $this
                    ->where('bool_soft_delete', 0)
                    ->get();
    }

    
    public function coll_get_one_comment_by_id($comment_id)
    {
        return $this->find($comment_id);
    }


    public function coll_get_owned_comments($user_id)
    {
        return $this->where('user_id', $user_id)
                    ->where('bool_soft_delete', 0)
                    ->get();
    }

}
