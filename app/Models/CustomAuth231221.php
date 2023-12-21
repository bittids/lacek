<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomAuth231221 extends Model
{
    use HasFactory;

           
    // start validation rules
    public function getValRulesLoginEmailCP()
    {
       return array(
        'email' => ['required', 'email'],
        'password' => ['required'],
       );
    }



    public function getValRulesRegEmailCP($obj_regex_helper)
    {
        $str_regex = $obj_regex_helper->str_val_safe_chars();
        return array(
    //    'email' => ['required', 'email'],
    //    'password' => ['required'],
       // 'g-token' => 'required',
   //    'g-recaptcha-response'=>'required|google_captcha',

        'str_first_name' => ['required', $str_regex],
        'str_last_name' => ['required', $str_regex],
        'email' => ['email', 'unique:users'],
     //   'str_country_calling_code' => 'required',
        'password' => ['required', 'confirmed', 'min:6'],
    //    'g-recaptcha-response'=>'required|google_captcha'
       );
    }

    public function getValRulesRegPhoneCP()
    {
        return array(
    //    'email' => ['required', 'email'],
    //    'password' => ['required'],
       // 'g-token' => 'required',
   //    'g-recaptcha-response'=>'required|google_captcha',

        'str_first_name' => 'required',
        'str_last_name' => 'required',
        'int_country_id' => ['required', 'exists:countries,id'],
        'str_phone' => ['required','max:20'],
        'password' => ['required', 'confirmed', 'min:6'],
      //  'g-recaptcha-response'=>'required|google_captcha'
       );
    }



    // begin validation messages

    public function getValMessagesLoginEmailCP()
    {
       $str_message_req = __('models/model_chat.str_message_req');
        $str_message_alpha = __('models/model_chat.str_message_alpha');
       // $str_message_gtoken_req =  __('models/model_custom_auth.str_message_gtoken_req');

        return [
       // 'str_message.required' => $str_message_req,
       // 'str_message.regex' => $str_message_alpha,
    //    'g-recaptcha-response.required' => $str_message_gtoken_req,
    //   'body.required' => 'A message is required',
        ];
    }

    
    public function getValMessagesRegEmailCP()
    {
        $str_message_req = __('models/model_chat.str_message_req');
        $str_message_alpha = __('models/model_chat.str_message_alpha');
    //    $str_message_gtoken_req =  __('models/model_custom_auth.str_message_gtoken_req');

        return [
        'str_message.required' => $str_message_req,
        'str_message.regex' => $str_message_alpha,
      //  'g-recaptcha-response.required' => $str_message_gtoken_req,
    //   'body.required' => 'A message is required',
        ];
    }
   
  

    // start unclassified functions


}
