<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
//use App\Mail\CPVerifyEmail;
//use App\Models\Country;
use App\Models\CustomAuth;
use App\Models\More_user_info;
use App\Models\User;
//use App\Models\User_verify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Session;

class CustAuthGetController extends Controller
{

    public function index()
    {
        return view('auth.login');
    }


    public function get_login_email()
    {
        return view('auth.login_email');
    }



    public function get_logout(Request $request)
    {
        $request->session()->flush();
        Auth::logout();

        return Redirect(route('auth.get.login-email'));
    }


    public function get_register_email()
    {
        return view('auth.register-email');
    }
}
