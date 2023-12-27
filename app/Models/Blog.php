<?php

namespace App\Models;

use App\Classes\URLHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Blog extends Model
{
    use HasFactory;

    // this function tests for all filters necessary to access the page
    public function bool_pass_or_redirect()
    {
        // save the intended page to return to intended URL
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
