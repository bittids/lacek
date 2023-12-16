<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Classes\DateHelper;
use App\Mail\NotifyAdminCPSetupComplete;
use App\Models\Blog; 
use App\Models\More_user_info;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class BlogController extends Controller
{
    
    public function get_show_blog(
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
      
        return view('blog.show_blog', 
            compact('coll_user_info', 'coll_more_user_info'));

    }

  
}
