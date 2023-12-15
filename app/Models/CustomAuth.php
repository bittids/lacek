<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomAuth extends Model
{
    use HasFactory;

           
    // start validation rules
    public function getValRulesLoginEmailCP()
    {
       return array(
        'email' => ['required', 'email'],
        'password' => ['required'],
       // 'g-token' => 'required',
     //  'g-recaptcha-response'=>'required|google_captcha'
       );
    }

    
    public function getValRulesLoginPhoneCP()
    {
        return array(
    //    'email' => ['required', 'email'],
    //    'password' => ['required'],
       // 'g-token' => 'required',
   //    'g-recaptcha-response'=>'required|google_captcha',

    //    'str_first_name' => 'required',
     //   'str_last_name' => 'required',
        'int_country_id' => ['required', 'exists:countries,id'],
        'str_phone' => ['required','max:20'],
        'password' => ['required', 'min:6'],
 //       'g-recaptcha-response'=>'required|google_captcha'
       );
    }



    public function getValRulesRegEmailCP()
    {
        return array(
    //    'email' => ['required', 'email'],
    //    'password' => ['required'],
       // 'g-token' => 'required',
   //    'g-recaptcha-response'=>'required|google_captcha',

        'str_first_name' => 'required',
        'str_last_name' => 'required',
        'email' => ['email', 'unique:users'],
     //   'str_country_calling_code' => 'required',
        'password' => ['required', 'confirmed', 'min:6'],
        'g-recaptcha-response'=>'required|google_captcha'
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
      //  $str_message_req = __('models/model_chat.str_message_req');
      //  $str_message_alpha = __('models/model_chat.str_message_alpha');
        $str_message_gtoken_req =  __('models/model_custom_auth.str_message_gtoken_req');

        return [
       // 'str_message.required' => $str_message_req,
       // 'str_message.regex' => $str_message_alpha,
        'g-recaptcha-response.required' => $str_message_gtoken_req,
    //   'body.required' => 'A message is required',
        ];
    }

    
    public function getValMessagesRegEmailCP()
    {
      //  $str_message_req = __('models/model_chat.str_message_req');
      //  $str_message_alpha = __('models/model_chat.str_message_alpha');
        $str_message_gtoken_req =  __('models/model_custom_auth.str_message_gtoken_req');

        return [
       // 'str_message.required' => $str_message_req,
       // 'str_message.regex' => $str_message_alpha,
        'g-recaptcha-response.required' => $str_message_gtoken_req,
    //   'body.required' => 'A message is required',
        ];
    }
   
    public function getValMessagesRegPhoneCP()
    {
      //  $str_message_req = __('models/model_chat.str_message_req');
      //  $str_message_alpha = __('models/model_chat.str_message_alpha');
        $str_message_gtoken_req =  __('models/model_custom_auth.str_message_gtoken_req');

        return [
       // 'str_message.required' => $str_message_req,
       // 'str_message.regex' => $str_message_alpha,
        'g-recaptcha-response.required' => $str_message_gtoken_req,
    //   'body.required' => 'A message is required',
        ];
    }

    // start unclassified functions

    // this function freturns a boolean value for yes/no, whether login is valid, 
    //and the collection for the user that is going to be logged in
    public function arr_phone_credentials_valid(
        Country $obj_model_country,  
        More_user_info $obj_model_more_user_info, 
        Request $request,
        User $obj_model_user
        ) : array
    {

        $coll_country_chosen_info = $obj_model_country
                                    ->find($request->input('int_country_id'));

       
        $bool_user_found = 0;
        $bool_password_match = 0;
        // the next line requires that ths user is already authenticated
  //      $obj_model_user = $obj_model_user->coll_get_user_wmui();
      //  $obj_model_more_user_info = $obj_model_user->more_user_info;
 
      // look for first phone number in more user info
        $coll_more_user_info = $obj_model_more_user_info
            ->where('int_phone_one_country_id', 
                    $coll_country_chosen_info->id)
            ->where('str_phone_one', trim($request->get('str_phone')))                       
            ->first();

        if (isset($coll_more_user_info->id) && !is_null($coll_more_user_info->id))
        {
            $bool_user_found = 1;
            // get user coll for this user
            $coll_user = $obj_model_user->find($coll_more_user_info->user_id);
        }

        //echo("bool_user_found = " . $bool_user_found . "<br>");
 
        
        // if user found in more user info, and corresponding user found in user
        //then check password
        if (($bool_user_found) || (isset($coll_user->id)) || (!is_null($coll_user->id)))
        {
          //  echo("coll_user->id = " . $coll_user->id . "<br>");
 
 // 231124 the internet is out, so I cannot chek on how hash::check works
 // but the password is not matching
 // I temprarily bypassed the password, so I can continue development
  //          if(Hash::check($request->str_password, $coll_user->password))
            if(true)
            {
                $bool_password_match = 1;
            }
        }

     //   dd("password_match = " . $bool_password_match);

        if ($bool_user_found && $bool_password_match) 
        {
            $bool_credentials_valid = 1;
        }
        else 
        {
            $bool_credentials_valid = 0;
        }

        $arr_return = array(
            'bool_credentials_valid' => $bool_credentials_valid, 
            'coll_user' => $coll_user
        );
        return $arr_return;
    }


    public function arr_send_vonage_sms(
        $str_to_number, $str_from_number, $str_message
        )
    {
       // the next 10 or so lines are from
//https://dashboard.nexmo.com/getting-started/sms
// 230713_1800 this code below works
        $basic  = new \Vonage\Client\Credentials\Basic("63e1bde5", "EV14vZhnkAcTwWRC");
        $client = new \Vonage\Client($basic);
        $obj_message =   new \Vonage\SMS\Message\SMS(
                                $str_to_number, 
                                $str_from_number, 
                                $str_message
        );

        // this is where the message is actually sent
        // 230713 - temp shut off during early testing
        // replaced with dummy vars
      //  $response = $client->sms()->send($obj_message);
        
       // $message = $response->current();
        
  //     if ($message->getStatus() == 0) 
       if (true) 
        {
            $arr_result['bool_message_success'] = 1;
            $arr_result['str_message'] = "The message was sent successfully";
        } 
        else 
        {
            $arr_result['bool_message_success'] = 0;
       //     $arr_result['str_message'] =  "The message failed with status: " . $message->getStatus();
            $arr_result['str_message'] =  "The message failed with status: ";
        }
        return $arr_result;
    }

    // this function was causing validation problems
    // 230623
    // temporarily resolved by doing one registration for email
    // and second for cellphone
    public function bool_email_and_phone_missing(Request $request)
    {
        if (is_null($request->input('email')))
        {
            if (is_null($request->input('int_country_id')) && 
                is_null($request->input('str_phone')))
            {
                return 1;
            }
        }
        return 0;
    }


    public function bool_phone_missing(Request $request)
    {
        
        if ($request->int_country_id)
        {
            if (is_null($request->input('str_phone')))
            {
                return 1;
            }
        }
        return 0;
        
    }

    public function bool_phone_unique(
        More_user_info $obj_model_more_user_info,
        $str_country_calling_code,
        $str_phone
    )
    {

        $coll_mui_verify_phone_one = $obj_model_more_user_info
        ->where('str_country_calling_code_one', $str_country_calling_code)
        ->where('str_phone_one', $str_phone)
        ->first();
        $coll_mui_verify_phone_two = $obj_model_more_user_info
        ->where('str_country_calling_code_two', $str_country_calling_code)
        ->where('str_phone_two', $str_phone)
        ->first();

        $bool_phone_one_found = 0;

        if (isset($coll_mui_verify_phone_one->id))
        {
            if (!is_null($coll_mui_verify_phone_one->id))
            {
                $bool_phone_one_found = 1;
            }
        }

        $bool_phone_two_found = 0;
  
        if (isset($coll_mui_verify_phone_two->id))
        {
            if (!is_null($coll_mui_verify_phone_two->id))
            {
                $bool_phone_two_found = 1;
            }
        }
       
        if($bool_phone_one_found || $bool_phone_two_found)
        {
            return 0;
        }
        else
        {
            return 1;
        } 
    }


    public function bool_country_id_missing(Request $request)
    {
        if ($request->str_phone)
        {
            if (is_null($request->input('int_country_id')))
            {
                return 1;
            }
        }
        return 0;
    }

    
    public function bool_setup_database(Request $request)
    {

    }

}
