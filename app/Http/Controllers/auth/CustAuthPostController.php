<?php

namespace App\Http\Controllers\auth;


//use App\Http\Controllers\Controller;
use App\Classes\CloakedIDHelper;
use App\Classes\DateHelper;
use App\Mail\AdminNotifyCPReg;

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
    
    // start post functions


    public function post_login_email(
                    Request $request, 
                    CustomAuth $obj_model_custom_auth,
                    Login $obj_model_login
                    )
    {

       // validate all input   
       // the validation for teh google recaptcha is from 
       //   https://stackoverflow.com/questions/66720254/google-recaptcha-with-laravel
        $validation_rules = $obj_model_custom_auth->getValRulesLoginEmailCP();
        $validation_messages = $obj_model_custom_auth->getValMessagesLoginEmailCP();
        $this->validate($request, $validation_rules, $validation_messages);
  
        // delete seasion status, as setting a flash sessionn var 
        // in cp controller construct was not workign
        $str_session_status = ($request->session()->get('status')) ?? 'null';
        $request->session()->forget('status');
    
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user_id = Auth::user()->id;
            $obj_model_login->user_id = $user_id;
                
            $obj_model_login_ip_address = $request->ip();
        
            $obj_model_login->str_location = "temp disabled - see custPostAuthContoller, line 231";
           
            $obj_model_login->str_browser_info = $request->userAgent();
            $obj_model_login->save();
       
            $request->session()->put('login_id', $obj_model_login->id);
           
           
            return redirect()->intended('cp/')
                        ->withSuccess('Signed in');
        
        }
 
        $str_login_error = "Your login information is not valid";
        $request->session()->flash('status', $str_login_error);
  
        return redirect()->route("auth.get.login-email");
    }
 
    
    public function post_register_email(
                    Request $request,
                 //   CloakedIDHelper $cloaked_id_helper,
                 //   Content_provider $obj_model_cp,
                    CustomAuth $obj_model_custom_auth,
                    DateHelper $obj_date_helper,
                    More_user_info $obj_model_more_user_info,
                  //  Photo $obj_model_photo,
               //     Role_user $obj_model_role_user,
                //    Role $obj_model_role,
                    User $obj_model_user
                 //   User_verify $obj_model_user_verify
                    )
    {  
      
        $validation_rules = $obj_model_custom_auth->getValRulesRegEmailCP();
        $validation_messages = $obj_model_custom_auth->getValMessagesRegEmailCP();
       
        $validator = Validator::make(
                            $request->all(), 
                            $validation_rules, 
                            $validation_messages);
                           

         // this function was causing validation problems
    // 230623
    // temporarily resolved by doing one registration for email
    // and second for cellphone   - see customAuthcontroller230623customValidation                
        // login to effectuate need for either email or cellphone - bothis OK
 
 // the validate method at teh end causes automatic rediction upon validation failure
        $validator->validate();

        $coll_user = $obj_model_user;
        $coll_more_user_info = $obj_model_more_user_info;
        $coll_users_verify = $obj_model_user_verify;

        $coll_user->name = $request->str_first_name . " " . $request->str_last_name;
        $coll_user->email = $request->email;
        $coll_user->password = Hash::make($request->password);
      //  $coll_user->str_cloaked_id = $cloaked_id_helper->str_get_unique_id(
     //                                                   $obj_model_user, 5);
        $coll_user->save();

        // get the ID for the content provider role
      //  $coll_role = $obj_model_role
       // ->where('name', 'content_provider')
       // ->first();

        
        $coll_more_user_info->user_id = $coll_user->id;
        $coll_more_user_info->str_first_name = $request->str_first_name;
        $coll_more_user_info->str_last_name = $request->str_last_name;
      //  $coll_more_user_info->str_cloaked_id = $cloaked_id_helper->str_get_unique_id(
      //                                              $obj_model_user->more_user_info, 5);
      //  $coll_more_user_info->user_type_id = $coll_role->id;

        $coll_more_user_info->save();



        $ip_user_ip = $request->ip();
        //https://github.com/stevebauman/location - 230714 install later
        $str_location = "temp disabled - see custPostAuthContoller, line 231";
        // 
        $str_user_agent = $request->userAgent();

        // send email verification email
        $arr_email_params = array();
        $arr_email_params = [
      //      'str_user_cloaked_id' => $coll_user->str_cloaked_id,
      //      'str_token' => $coll_users_verify->str_token,
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
            // 230714 user agent is from 
            // https://stackoverflow.com/questions/37293444/php-laravel-how-to-get-client-browser-device
            'str_user_agent' => $str_user_agent,

        ];

        Mail::to(config('mail.mail_admin'))->send(new AdminNotifyCPReg($arr_email_params));
     
        // set the content provider role
        $obj_model_role_user->add_role_by_name($obj_model_role, $coll_user->id, "content_provider");
        //do register event
        event(new Registered($coll_user));

        $str_register_response = "Thank you for registering.  Please login.";
        $bool_bar_green = 1;
        $request->session()->flash('status', $str_register_response);
        $request->session()->flash('bool_bar_green', $bool_bar_green);
     
      // get user coll from db for registered event
      
        return redirect()->route("auth.get.login-email-cp");
    }

 
}
