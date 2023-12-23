<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Blog extends Model
{
    use HasFactory;


    // this function tests for all filters necessary to access the cp pages
    // login, role,
    public function bool_pass_or_redirect(
        //     RoleHelper $obj_role_helper,
        // User $obj_model_user
      //  Request $request
    )
    {
       // save the intended page to return to intended URL
        session(['str_intended_url' =>  url()->current()]);

        if (Auth::guest()) {
            redirect()->route('auth.get.login-email')->send();
        }

        if (Auth::check()) {
            return 1;
        } else {
            redirect()->route('auth.get.login-email')->send();
        }

        // should never reach here, but
        return 0;
    }
}
