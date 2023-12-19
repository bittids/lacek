<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Classes\DateHelper;
use App\Classes\RegexHelper;

use App\Mail\NotifyAdminCPSetupComplete;
use App\Models\Blog; 
use App\Models\Comment; 
use App\Models\More_user_info;
use App\Models\Post; 
use App\Models\User;


class CommentsController extends Controller
{
      // start get functions


      public function get_choose_comment(
        Blog $obj_model_blog,
        DateHelper $obj_date_helper,
        More_user_info $obj_model_more_user_info,
        Comment $obj_model_comment,
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

        $coll_comments = $obj_model_comment->coll_get_owned_comments($coll_user_info->id);
        $coll_comments = $obj_model_comment->coll_get_formatted_date($coll_comments, $obj_date_helper);
        return view('comments.choose_comment', 
            compact('coll_user_info', 'coll_more_user_info', 'coll_comments'));

    }
    // end get choose comment


    // start get create comment
    public function get_create_comment(
        Blog $obj_model_blog,
        More_user_info $obj_model_more_user_info,
        Post $obj_model_post,
        Request $request,
        User $obj_model_user,
        $post_id
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
   //     $curr_post_id = $request->session()->get('post_id');
        $coll_post = $obj_model_post->coll_get_one_post_by_id($post_id);

        return view('comments.create_comment', 
            compact('coll_user_info', 'coll_more_user_info', 'coll_post', 'post_id'));

    }
    // end get create comment

    
    // start get delete comment
    public function get_delete_comment(
        Blog $obj_model_blog,
        More_user_info $obj_model_more_user_info,
        Comment $obj_model_comment,
        Request $request,
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
        $curr_comment_id = $request->session()->get('comment_id');
        $coll_comment = $obj_model_comment->coll_get_one_comment_by_id($curr_comment_id);
      
        return view('comments.delete_comment', 
            compact('coll_user_info', 'coll_more_user_info', 'coll_comment'));

    }
    // end get delete  comment

    
    // start get update comment
    public function get_update_comment(
        Blog $obj_model_blog,
        More_user_info $obj_model_more_user_info,
        Comment $obj_model_comment,
        Request $request,
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
        $curr_comment_id = $request->session()->get('comment_id');
     
        $coll_comment = $obj_model_comment->coll_get_one_comment_by_id($curr_comment_id);
      
        return view('comments.update_comment', 
            compact('coll_user_info', 'coll_more_user_info', 'coll_comment'));

    }
    // end get update comment

    // start get view your comments
    public function get_view_comments(
      Blog $obj_model_blog,
      DateHelper $obj_date_helper,
      More_user_info $obj_model_more_user_info,
      Comment $obj_model_comment,
      Request $request,
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
   //   $curr_comment_id = $request->session()->get('comment_id');
      $coll_comments = $obj_model_comment->coll_get_owned_comments($coll_user_info->id);
    
      
      foreach($coll_comments as &$coll_comment)
      {
        $carbon_date = $obj_date_helper->carbon_date_get_date(
          $coll_comment->created_at);
        $coll_comment->str_date_formatted = $obj_date_helper->str_format_date_one(
                                                           $carbon_date);
     //   $coll_comment->str_post_first_name = $coll_comment->post->str_first_name;
     //   $coll_comment->str_post_lst_name = $coll_comment->post->str_first_name;
      }    
      return view('comments.view_comments', 
          compact('coll_user_info', 'coll_more_user_info', 'coll_comments'));

  }
  // end get update comment


    // end get functions


    // start post functions
      
// start post choose comment
public function post_choose_comment(
  Request $request, 
  Blog $obj_model_blog,
  DateHelper $obj_date_helper,
  More_user_info $obj_model_more_user_info,
  Comment $obj_model_comment,
  User $obj_model_user,
  RegexHelper $obj_regex_helper
  )
{

  // authenitcate user and check for proper role authorization
  $bool_pass_val = $obj_model_blog->bool_pass_or_redirect(
      $obj_model_user
  );

// validate all input     


  $validation_rules = $obj_model_comment->getValRulesChooseComment($obj_regex_helper);
  $validation_messages = $obj_model_comment->getValMessagesChooseComment();
  $this->validate($request, $validation_rules, $validation_messages);
// $validator = Validator::make($request->all(), $validation_rules, $validation_messages);
//  $validated = $request->safe();

  $auth_user_id = Auth::user()->id;


  $coll_user_info = $obj_model_user->coll_get_user_wmui();
  $coll_more_user_info = $coll_user_info->more_user_info;
 // dd($request->comment_id);
  $coll_comment = $obj_model_comment->coll_get_one_comment_by_id($request->comment_id);
  $carbon_date = $obj_date_helper->carbon_date_get_date(
    $coll_comment->created_at);
    $coll_comment->str_date_formatted = $obj_date_helper->str_format_date_one(
                                  $carbon_date);
//
    $request->session()->put('comment_id', $request->comment_id);
    $carbon_date = $obj_date_helper->carbon_get_curr_date_time();
    $str_curr_date_formatted = $obj_date_helper->str_format_date_one($carbon_date);
    $request->session()->put('str_choose_comment_date_formatted', $str_curr_date_formatted);
  
  return view('comments.choose_comment_result', 
  compact('coll_user_info', 'coll_more_user_info', 'coll_comment'));
}
// end post choose comment

  

// start post create comment
    public function post_create_comment(
        Request $request, 
        Blog $obj_model_blog,
        More_user_info $obj_model_more_user_info,
        Comment $obj_model_comment,
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
  //dd($request->post_id);
    
        $validation_rules = $obj_model_comment->getValRulesCreateComment($obj_regex_helper);
        $validation_messages = $obj_model_comment->getValMessagesCreateComment();
        $this->validate($request, $validation_rules, $validation_messages);
   // $validator = Validator::make($request->all(), $validation_rules, $validation_messages);
  //  $validated = $request->safe();
  
        $auth_user_id = Auth::user()->id;
  
  
        $coll_user_info = $obj_model_user->coll_get_user_wmui();
        $coll_more_user_info = $coll_user_info->more_user_info;
    //    $curr_post_id = $request->session()->get('post_id');
        $coll_post = $obj_model_post->coll_get_one_post_by_id($request->post_id);

        $coll_comment = $obj_model_comment;
               
        $coll_comment->user_id = $coll_user_info->id;
        $coll_comment->post_id = $request->post_id;
   //     $coll_comment->str_title = $request->str_title;
        $coll_comment->str_comment = $request->str_comment;
        $coll_comment->bool_soft_delete = 0;
        $coll_comment->save();
  
  
        $str_setup_response = "Your comment was successfully saved";
        $bool_bar_green = 1;
        $request->session()->flash('status', $str_setup_response);
        $request->session()->flash('bool_bar_green', $bool_bar_green);
  
        return view('comments.create_comment_result', 
        compact('coll_user_info', 'coll_more_user_info', 'coll_comment'));
    }
  // end post create comment
   
 

// start post delete comment
public function post_delete_comment(
  Request $request, 
  Blog $obj_model_blog,
  More_user_info $obj_model_more_user_info,
  Comment $obj_model_comment,
  User $obj_model_user,
  RegexHelper $obj_regex_helper
  )
{

  // authenitcate user and check for proper role authorization
  $bool_pass_val = $obj_model_blog->bool_pass_or_redirect(
      $obj_model_user
  );

// validate all input     

// nothing to validate
 // $validation_rules = $obj_model_comment->getValRulesCreateComment($obj_regex_helper);
 // $validation_messages = $obj_model_comment->getValMessagesCreateComment();
//  $this->validate($request, $validation_rules, $validation_messages);
// $validator = Validator::make($request->all(), $validation_rules, $validation_messages);
//  $validated = $request->safe();

//  $auth_user_id = Auth::user()->id;


  $coll_user_info = $obj_model_user->coll_get_user_wmui();
  $coll_more_user_info = $coll_user_info->more_user_info;

  $curr_comment_id = $request->session()->get('comment_id');
  $coll_comment = $obj_model_comment->coll_get_one_comment_by_id($curr_comment_id);

  $coll_comment->bool_soft_delete = 1;
  $coll_comment->save();

  $str_setup_response = "Your comment was successfully deleted, or at least removed from the blog";
  $bool_bar_green = 1;
  $request->session()->flash('status', $str_setup_response);
  $request->session()->flash('bool_bar_green', $bool_bar_green);

  return view('comments.delete_comment_result', 
  compact('coll_user_info', 'coll_more_user_info', 'coll_comment'));
}
// end post delete comment

  
// start post update comment
public function post_update_comment(
  Request $request, 
  Blog $obj_model_blog,
  More_user_info $obj_model_more_user_info,
  Comment $obj_model_comment,
  User $obj_model_user,
  RegexHelper $obj_regex_helper
  )
{

  // authenitcate user and check for proper role authorization
  $bool_pass_val = $obj_model_blog->bool_pass_or_redirect(
      $obj_model_user
  );

// validate all input     


  $validation_rules = $obj_model_comment->getValRulesCreateComment($obj_regex_helper);
  $validation_messages = $obj_model_comment->getValMessagesCreateComment();
  $this->validate($request, $validation_rules, $validation_messages);
// $validator = Validator::make($request->all(), $validation_rules, $validation_messages);
//  $validated = $request->safe();

  $auth_user_id = Auth::user()->id;


  $coll_user_info = $obj_model_user->coll_get_user_wmui();
  $coll_more_user_info = $coll_user_info->more_user_info;

  $curr_comment_id = $request->session()->get('comment_id');
  $coll_comment = $obj_model_comment->coll_get_one_comment_by_id($curr_comment_id);

         
 // $coll_comment->user_id = $coll_user_info->id;
//  $coll_comment->str_title = $request->str_title;
  $coll_comment->str_comment = $request->str_comment;
//  $coll_comment->bool_soft_delete = 0;
  $coll_comment->save();

  $str_setup_response = "Your comment was successfully updated";
  $bool_bar_green = 1;
  $request->session()->flash('status', $str_setup_response);
  $request->session()->flash('bool_bar_green', $bool_bar_green);

  return view('comments.update_comment_result', 
  compact('coll_user_info', 'coll_more_user_info', 'coll_comment'));
}
// end post update comment

  

}
