<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Classes\DateHelper;
use App\Classes\URLHelper;
use App\Mail\NotifyAdminCPSetupComplete;
use App\Models\Blog;
use App\Models\Comment;
use App\Models\More_user_info;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class BlogController extends Controller
{

  public function get_show_blog(
    Blog $obj_model_blog,
    Comment $obj_model_comment,
    DateHelper $obj_date_helper,
    More_user_info $obj_model_more_user_info,
    Post $obj_model_post,
    URLHelper $obj_url_helper,
    User $obj_model_user
  ) {

    $coll_posts = $obj_model_post->coll_get_active_posts();



    foreach ($coll_posts as &$coll_post) {
      $carbon_date = $obj_date_helper->carbon_date_get_date(
        $coll_post->created_at
      );
      $coll_post->str_date_formatted = $obj_date_helper->str_format_date_one(
        $carbon_date
      );


      // this foreach loop is for comments for each post
      foreach ($coll_post->comments as &$coll_comment) {
        $carbon_date = $obj_date_helper->carbon_date_get_date(
          $coll_comment->created_at
        );
        $coll_comment->str_date_formatted = $obj_date_helper->str_format_date_one(
          $carbon_date
        );
      }
    }

    return view(
      'blog.show_blog',
      compact('coll_posts')
    );
  }
}
