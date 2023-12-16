<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Classes\DateHelper;
use App\Classes\RegexHelper;

use App\Mail\NotifyAdminCPSetupComplete;
use App\Models\Blog; 
use App\Models\More_user_info;
use App\Models\Post; 
use App\Models\User;


class PostController extends Controller
{
      // start get functions


      public function get_choose_post(
        Blog $obj_model_blog,
        DateHelper $obj_date_helper,
        More_user_info $obj_model_more_user_info,
        Post $obj_model_post,
        User $obj_model_user
      )
    {
        // this method of enforcing authenitication is used
        // instead of middleware for the following reasons
        // 1. code re-use - it is almost cut and paste
        // 2. allows method level authentication, as opposed to
        //      controller level authenticaiton
        // 3. this is more conducive the customized authenticaiton
        //      the autheitication shipped with Laravel works, 
        //      but is not flexible
        $bool_pass_val = $obj_model_blog->bool_pass_or_redirect(
          $obj_model_user
        );

        $coll_user_info = $obj_model_user->coll_get_user_wmui();
        $coll_more_user_info = $coll_user_info->more_user_info;

        $coll_posts = $obj_model_post->coll_get_owned_posts($coll_user_info->id);
        $coll_posts = $obj_model_post->coll_get_formatted_date($coll_posts, $obj_date_helper);
        return view('posts.choose_post', 
            compact('coll_user_info', 'coll_more_user_info', 'coll_posts'));

    }

    // end get choose post

    public function get_create_post(
        Blog $obj_model_blog,
        More_user_info $obj_model_more_user_info,
        User $obj_model_user
      )
    {
        // this method of enforcing authenitication is used
        // instead of middleware for the following reasons
        // 1. code re-use - it is almost cut and paste
        // 2. allows method level authentication, as opposed to
        //      controller level authenticaiton
        // 3. this is more conducive the customized authenticaiton
        //      the autheitication shipped with Laravel works, 
        //      but is not flexible
        $bool_pass_val = $obj_model_blog->bool_pass_or_redirect(
          $obj_model_user
        );

        $coll_user_info = $obj_model_user->coll_get_user_wmui();
        $coll_more_user_info = $coll_user_info->more_user_info;
      
        return view('posts.create_post', 
            compact('coll_user_info', 'coll_more_user_info'));

    }

    // end get create post


    // end get functions


    // start post functions

    

// start post create post
    public function post_create_post(
        Request $request, 
        Blog $obj_model_blog,
        More_user_info $obj_model_more_user_info,
        Post $obj_model_post,
        User $obj_model_user,
        RegexHelper $obj_regex_helper
        )
    {
  
        // authenitcate user and check for proper role authorization
        $bool_pass_val = $obj_model_blog->bool_pass_or_redirect(
            $obj_model_user
        );
  
  // validate all input     
  
    
        $validation_rules = $obj_model_post->getValRulesCreatePost($obj_regex_helper);
        $validation_messages = $obj_model_post->getValMessagesCreatePost();
        $this->validate($request, $validation_rules, $validation_messages);
   // $validator = Validator::make($request->all(), $validation_rules, $validation_messages);
  //  $validated = $request->safe();
  
        $auth_user_id = Auth::user()->id;
  
  
        $coll_user = $obj_model_user->coll_get_user_wmui();
        $coll_more_user_info = $coll_user->more_user_info;
  
        $coll_post = $obj_model_post;
               
        $coll_post->user_id = $coll_user->id;
        $coll_post->str_title = $request->str_title;
        $coll_post->str_post = $request->str_post;
        $coll_post->bool_soft_delete_post = 0;
        $coll_post->save();
  
  
        $str_setup_response = "Your post was successfully saved";
        $bool_bar_green = 1;
        $request->session()->flash('status', $str_setup_response);
        $request->session()->flash('bool_bar_green', $bool_bar_green);
  
        return view('posts.create_post_result', 
        compact('coll_user_info', 'coll_more_user_info', 'coll_post'));
    }
  // end post create post
  
  

}
