<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Classes\DateHelper;
use App\Classes\URLHelper;
use App\Classes\RegexHelper;

use App\Mail\NotifyAdminCPSetupComplete;
use App\Models\Blog;
use App\Models\More_user_info;
use App\Models\Post;
use App\Models\User;


class PostController extends Controller
{

  public function __construct(URLHelper $obj_url_helper)
  {
    $obj_url_helper->void_save_intended_url();
  }
  // start get functions


  public function get_choose_post(
    Blog $obj_model_blog,
    DateHelper $obj_date_helper,
    More_user_info $obj_model_more_user_info,
    Post $obj_model_post,
    User $obj_model_user
  ) {
    // this method of enforcing authenitication is used
    // instead of middleware for the following reasons
    // 1. code re-use - it is almost cut and paste
    // 2. allows method level authentication, as opposed to
    //      controller level authenticaiton
    // 3. this is more conducive the customized authenticaiton
    //      the autheitication shipped with Laravel works, 
    //      but is not flexible
    $bool_pass_val = $obj_model_blog->bool_pass_or_redirect(
    );

    $coll_user_info = $obj_model_user->coll_get_user_wmui();
    $coll_more_user_info = $coll_user_info->more_user_info;

    $coll_posts = $obj_model_post->coll_get_owned_posts($coll_user_info->id);
    $coll_posts = $obj_model_post->coll_get_formatted_date($coll_posts, $obj_date_helper);
    return view(
      'posts.choose_post',
      compact('coll_user_info', 'coll_more_user_info', 'coll_posts')
    );
  }
  // end get choose post


  // start get create post
  public function get_create_post(
    Blog $obj_model_blog,
    More_user_info $obj_model_more_user_info,
    User $obj_model_user
  ) {

    $bool_pass_val = $obj_model_blog->bool_pass_or_redirect();

    $coll_user_info = $obj_model_user->coll_get_user_wmui();
    $coll_more_user_info = $coll_user_info->more_user_info;

    return view(
      'posts.create_post',
      compact('coll_user_info', 'coll_more_user_info')
    );
  }
  // end get create post


  // start get delete post
  public function get_delete_post(
    Blog $obj_model_blog,
    More_user_info $obj_model_more_user_info,
    Post $obj_model_post,
    Request $request,
    User $obj_model_user
  ) {

    $bool_pass_val = $obj_model_blog->bool_pass_or_redirect();

    $coll_user_info = $obj_model_user->coll_get_user_wmui();
    $coll_more_user_info = $coll_user_info->more_user_info;
    $curr_post_id = $request->session()->get('post_id');
    $coll_post = $obj_model_post->coll_get_one_post_by_id($curr_post_id);

    return view(
      'posts.delete_post',
      compact('coll_user_info', 'coll_more_user_info', 'coll_post')
    );
  }
  // end get delete  post


  // start get update post
  public function get_update_post(
    Blog $obj_model_blog,
    More_user_info $obj_model_more_user_info,
    Post $obj_model_post,
    Request $request,
    User $obj_model_user
  ) {

    $bool_pass_val = $obj_model_blog->bool_pass_or_redirect();

    $coll_user_info = $obj_model_user->coll_get_user_wmui();
    $coll_more_user_info = $coll_user_info->more_user_info;
    $curr_post_id = $request->session()->get('post_id');

    $coll_post = $obj_model_post->coll_get_one_post_by_id($curr_post_id);

    return view(
      'posts.update_post',
      compact('coll_user_info', 'coll_more_user_info', 'coll_post')
    );
  }
  // end get update post

  // start get view your posts
  public function get_view_posts(
    Blog $obj_model_blog,
    DateHelper $obj_date_helper,
    More_user_info $obj_model_more_user_info,
    Post $obj_model_post,
    Request $request,
    User $obj_model_user
  ) {

    $bool_pass_val = $obj_model_blog->bool_pass_or_redirect();

    $coll_user_info = $obj_model_user->coll_get_user_wmui();
    $coll_more_user_info = $coll_user_info->more_user_info;
    //   $curr_post_id = $request->session()->get('post_id');
    $coll_posts = $obj_model_post->coll_get_owned_posts($coll_user_info->id);


    foreach ($coll_posts as &$coll_post) {
      $carbon_date = $obj_date_helper->carbon_date_get_date(
        $coll_post->created_at
      );
      $coll_post->str_date_formatted = $obj_date_helper->str_format_date_one(
        $carbon_date
      );
    }
    return view(
      'posts.view_posts',
      compact('coll_user_info', 'coll_more_user_info', 'coll_posts')
    );
  }
  // end get update post


  // end get functions


  // start post functions

  // start post choose post
  public function post_choose_post(
    Request $request,
    Blog $obj_model_blog,
    DateHelper $obj_date_helper,
    More_user_info $obj_model_more_user_info,
    Post $obj_model_post,
    User $obj_model_user,
    RegexHelper $obj_regex_helper
  ) {

    // authenitcate user and check for proper role authorization
    $bool_pass_val = $obj_model_blog->bool_pass_or_redirect();

    // validate all input     


    $validation_rules = $obj_model_post->getValRulesChoosePost($obj_regex_helper);
    $validation_messages = $obj_model_post->getValMessagesChoosePost();
    $this->validate($request, $validation_rules, $validation_messages);


    $auth_user_id = Auth::user()->id;


    $coll_user_info = $obj_model_user->coll_get_user_wmui();
    $coll_more_user_info = $coll_user_info->more_user_info;

    $coll_post = $coll_post = $obj_model_post->coll_get_one_post_by_id($request->post_id);
    $carbon_date = $obj_date_helper->carbon_date_get_date(
      $coll_post->created_at
    );
    $coll_post->str_date_formatted = $obj_date_helper->str_format_date_one(
      $carbon_date
    );

    $request->session()->put('post_id', $request->post_id);
    $carbon_date = $obj_date_helper->carbon_get_curr_date_time();
    $str_curr_date_formatted = $obj_date_helper->str_format_date_one($carbon_date);
    $request->session()->put('str_choose_post_date_formatted', $str_curr_date_formatted);

    return view(
      'posts.choose_post_result',
      compact('coll_user_info', 'coll_more_user_info', 'coll_post')
    );
  }
  // end post choose post



  // start post create post
  public function post_create_post(
    Request $request,
    Blog $obj_model_blog,
    More_user_info $obj_model_more_user_info,
    Post $obj_model_post,
    User $obj_model_user,
    RegexHelper $obj_regex_helper
  ) {

    // authenitcate user and check for proper role authorization
    $bool_pass_val = $obj_model_blog->bool_pass_or_redirect();

    // validate all input     


    $validation_rules = $obj_model_post->getValRulesCreatePost($obj_regex_helper);
    $validation_messages = $obj_model_post->getValMessagesCreatePost();
    $this->validate($request, $validation_rules, $validation_messages);

    $auth_user_id = Auth::user()->id;

    $coll_user_info = $obj_model_user->coll_get_user_wmui();
    $coll_more_user_info = $coll_user_info->more_user_info;

    $coll_post = $obj_model_post;

    $coll_post->user_id = $coll_user_info->id;
    $coll_post->str_title = $request->str_title;
    $coll_post->str_post = $request->str_post;
    $coll_post->bool_soft_delete = 0;
    $coll_post->save();

    $str_setup_response = "Your post was successfully saved";
    $bool_bar_green = 1;
    $request->session()->flash('status', $str_setup_response);
    $request->session()->flash('bool_bar_green', $bool_bar_green);

    return view(
      'posts.create_post_result',
      compact('coll_user_info', 'coll_more_user_info', 'coll_post')
    );
  }
  // end post create post



  // start post delete post
  public function post_delete_post(
    Request $request,
    Blog $obj_model_blog,
    More_user_info $obj_model_more_user_info,
    Post $obj_model_post,
    User $obj_model_user,
    RegexHelper $obj_regex_helper
  ) {

    // authenitcate user and check for proper role authorization
    $bool_pass_val = $obj_model_blog->bool_pass_or_redirect();

    // validate all input     

    // nothing to validate
    $coll_user_info = $obj_model_user->coll_get_user_wmui();
    $coll_more_user_info = $coll_user_info->more_user_info;

    $curr_post_id = $request->session()->get('post_id');
    $coll_post = $obj_model_post->coll_get_one_post_by_id($curr_post_id);

    $coll_post->bool_soft_delete = 1;
    $coll_post->save();

    $str_setup_response = "Your post was successfully deleted, or at least removed from the blog";
    $bool_bar_green = 1;
    $request->session()->flash('status', $str_setup_response);
    $request->session()->flash('bool_bar_green', $bool_bar_green);

    return view(
      'posts.delete_post_result',
      compact('coll_user_info', 'coll_more_user_info', 'coll_post')
    );
  }
  // end post delete post


  // start post update post
  public function post_update_post(
    Request $request,
    Blog $obj_model_blog,
    More_user_info $obj_model_more_user_info,
    Post $obj_model_post,
    User $obj_model_user,
    RegexHelper $obj_regex_helper
  ) {

    // authenitcate user and check for proper role authorization
    $bool_pass_val = $obj_model_blog->bool_pass_or_redirect();

    // validate all input     
    $validation_rules = $obj_model_post->getValRulesCreatePost($obj_regex_helper);
    $validation_messages = $obj_model_post->getValMessagesCreatePost();
    $this->validate($request, $validation_rules, $validation_messages);


    $auth_user_id = Auth::user()->id;


    $coll_user_info = $obj_model_user->coll_get_user_wmui();
    $coll_more_user_info = $coll_user_info->more_user_info;

    $curr_post_id = $request->session()->get('post_id');
    $coll_post = $obj_model_post->coll_get_one_post_by_id($curr_post_id);



    $coll_post->str_title = $request->str_title;
    $coll_post->str_post = $request->str_post;

    $coll_post->save();

    $str_setup_response = "Your post was successfully updated";
    $bool_bar_green = 1;
    $request->session()->flash('status', $str_setup_response);
    $request->session()->flash('bool_bar_green', $bool_bar_green);

    return view(
      'posts.update_post_result',
      compact('coll_user_info', 'coll_more_user_info', 'coll_post')
    );
  }
  // end post update post
}
