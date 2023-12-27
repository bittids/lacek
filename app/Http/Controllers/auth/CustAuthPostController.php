<?php

namespace App\Http\Controllers\auth;


use App\Http\Controllers\Controller;

use App\Classes\DateHelper;
use App\Classes\RegexHelper;
use App\Classes\URLHelper;

use App\Mail\AdminNotifyRegister;

use App\Mail\UserRegister;
use App\Models\CustomAuth;
use App\Models\More_user_info;
use App\Models\Login;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Session;

class CustAuthPostController extends Controller
{
    

    public function post_login_email(
                    Request $request, 
                    CustomAuth $obj_model_custom_auth,
                    Login $obj_model_login,
                    URLHelper $obj_url_helper
                    )
    {

       // validate all input   
      
        $validation_rules = $obj_model_custom_auth->getValRulesLoginEmailCP();
        $validation_messages = $obj_model_custom_auth->getValMessagesLoginEmailCP();
        $this->validate($request, $validation_rules, $validation_messages);
  
        // delete seasion status, as setting a flash sessionn var 
        // in cp controller construct was not workign
        $str_session_status = ($request->session()->get('status')) ?? 'null';
        $request->session()->forget('status');
    
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
          // get intended URL from session var
 
          $str_intended_url = $obj_url_helper->str_get_intended_url($request);
          $request->session()->regenerate();
            $user_id = Auth::user()->id;
       
       
            $request->session()->put('login_id', $obj_model_login->id);
           
           
            return redirect($str_intended_url);
        
        }
 
        $str_login_error = "Your login information is not valid";
        $request->session()->flash('status', $str_login_error);
  
        return redirect()->route("auth.get.login-email");
    }
 
    
    public function post_register_email(
                    Request $request,   
                    CustomAuth $obj_model_custom_auth,
                    DateHelper $obj_date_helper,
                    More_user_info $obj_model_more_user_info,
                    RegexHelper $obj_regex_helper,           
                    User $obj_model_user
                    )
    {  
      
        $validation_rules = $obj_model_custom_auth->getValRulesRegEmailCP($obj_regex_helper);
        $validation_messages = $obj_model_custom_auth->getValMessagesRegEmailCP();
       
        $validator = Validator::make(
                            $request->all(), 
                            $validation_rules, 
                            $validation_messages);
                           
 // the validate method at the end causes automatic rediction upon validation failure
        $validator->validate();

        $coll_user = $obj_model_user;
        $coll_more_user_info = $obj_model_more_user_info;

        $coll_user->name = $request->str_first_name . " " . $request->str_last_name;
        $coll_user->email = $request->email;
        $coll_user->password = Hash::make($request->password);
    //                                                 $obj_model_user, 5);
        $coll_user->save();
     
        $coll_more_user_info->user_id = $coll_user->id;
        $coll_more_user_info->str_first_name = $request->str_first_name;
        $coll_more_user_info->str_last_name = $request->str_last_name;

        $coll_more_user_info->save();

        $ip_user_ip = $request->ip();
      
        $str_location = "temp disabled - see custPostAuthContoller, line 231";
        // 
        $str_user_agent = $request->userAgent();

        // send email verification email
        $arr_email_params = array();
        $arr_email_params = [
            'str_first_name' => $coll_more_user_info->str_first_name,
            'str_last_name' => $coll_more_user_info->str_last_name,
         ];

        Mail::to($coll_user->email)->send(new UserRegister($arr_email_params));
 
        $arr_email_params = [
            'user_id' => $coll_user->id,
            'str_user_cloaked_id' => $coll_user->str_cloaked_id,
      
            'str_first_name' => $coll_more_user_info->str_first_name,
            'str_last_name' => $coll_more_user_info->str_last_name,
            // send time of registration
            'str_reg_date_time_formatted' => $obj_date_helper->str_format_date_one($coll_user->created_at),
            'ip_user_ip' => $ip_user_ip,
            'str_location' => $str_location,
           
            'str_user_agent' => $str_user_agent,

        ];

        Mail::to(config('mail.mail_admin'))->send(new AdminNotifyRegister($arr_email_params));
     
        //do register event
        event(new Registered($coll_user));

        $str_register_response = "Thank you for registering.  Please login.";
        $bool_bar_green = 1;
        $request->session()->flash('status', $str_register_response);
        $request->session()->flash('bool_bar_green', $bool_bar_green);
      
        return redirect()->route("auth.get.login-email");
    }
}
