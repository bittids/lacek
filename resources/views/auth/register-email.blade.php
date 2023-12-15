<!-- Stored in resources/views/auth/register-email.blade.php -->
<!-- from https://pusher.com/tutorials/how-to-build-a-chat-app-with-vue-js-and-laravel/#9-creating-the-chat-app-view -->
@extends('layouts.layout_public')

@section('page_title')
<title>Content Provider - registration with email</title>
@endsection

@section('header_local')
<meta name="csrf-token" content="{{ csrf_token() }}">
 
<!-- bootstrap css is already in includes/header_main.php -->
 <!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
-->
<!-- this is the vue.js package -->
<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>

 <script src="https://www.google.com/recaptcha/api.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
 @endsection


@section('scripts')

<!-- this is vue.js code -->
<!-- {{ old('email') }} -->
<script>
  const app = Vue.createApp({
    data () {
      return {
        emailmsg: '',
       email: "{{ old('email') }}",
       textColorClass: ''
        
      }
    }, 
    watch: {
      email(value) {
        // binding this to the data value in the email input
      //  alert("email value changed");
      //  console.log('email value changed');
        this.email = value;
        this.validateEmail(value);
      }
    },
    methods: {
      validateEmail(value){
        if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(value))
    {
        this.textColorClass ="text-green-500";
        this.emailmsg = 'this is a valid email';
    } else
    {
        this.textColorClass ="text-red-500";
       this.emailmsg = 'Please enter a valid email address';
    } 
      }
    }
  })
 app.mount('#app')
</script>


<script>

$(document).ready(function(){

 
//alert("in jquery, line 63, javascript works")
}); // end on doc ready function


</script>



<script src="{{ asset('js/my_jquery_functions.js') }}"></script>

<!--script src="https://www.google.com/recaptcha/api.js"></script-->

<script>
    // this is for google recaptcha
    // see https://shouts.dev/articles/laravel-9-how-to-integrate-google-recaptcha-in-laravel-application
    function onSubmit(token) {
        document.getElementById("recaptchaToken").value = token;
    }
</script>

@endsection


@section('content-header')
    

  
@endsection


@section('content')
    



<div class="row">
    <div class="col-sm-12">
        <div class="h4 text-center">
        Content Provider registration with email
        </div>
    </div><!-- end col -->
</div><!-- end row dov-->

  
@include('includes_view.status_row')
   
@include('includes_view.errors_row')

<br>
<!-- this is from https://mdbootstrap.com/docs/standard/forms/overview/ -->

<div class="row">
    <div class="col-sm-12">
        <a href="{{ route('auth.get.login-email') }}">
            Already have an account? Login here</a>
    </div><!-- end col -->
</div><!-- end row dov-->


<br>


<form method="POST" id="register_form" action="{{ route('auth.post.register-email') }}" >
    @csrf

 <!-- start first name -->
 <div class="form-outline mb-4">
        <div class="form-group {{ $errors->has('str_first_name') ? 'has-error' : ''}}" 
        id="str_first_name_group">
            <input
            id="str_first_name"
            type="text"
            name="str_first_name"
            value="{{ old('str_first_name') }}"  
            class="form-control input-sm"
            placeholder="your first name"
            />
            <label class="form-label" for="str_first_name">Your first name</label>
        </div><!-- end form group -->
    </div><!-- end form outline -->
<!-- end first name -->   

 <!-- start last name -->
    <div class="form-outline mb-4">
        <div class="form-group {{ $errors->has('str_last_name') ? 'has-error' : ''}}" 
        id="str_last_name_group">
            <input
            id="str_last_name"
            type="text"
            name="str_last_name"
            value="{{ old('str_last_name') }}"  
            class="form-control input-sm"
            placeholder="your last name"
            />
            <label class="form-label" for="str_last_name">Your last name</label>
        </div><!-- end form group -->
    </div><!-- end form outline -->
<!-- end last name -->   


 <!-- start email -->
 <div class="form-outline mb-4">
        <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}" id="email_group">
            <div id="app">
            <input
            id="email"
            type="text"
            name="email"
          
            class="form-control input-sm"
            placeholder="your email" 
            v-model="email"
            />
            <label class="form-label" for="str_email">Your email</label>
            <br>
            <div v-bind:class="textColorClass">
                 @{{ emailmsg }}
            </div><!-- end div v-bind class -->
            </div><!-- end div id- app -->
            
        </div><!-- end form group -->
    </div><!-- end form outline -->
<!-- end email -->   

<br>


    <!-- the at sign in front of the double curly brackets makes paravel ignore the curly brackets, 
    so that vue.js can read them -->

<br>




 <!-- start passwrod -->
    <div class="form-outline mb-4">
        <div class="form-group {{ $errors->has('password') ? 'has-error' : ''}}" 
                    id="password_group">
            <input
            id="password"
            type="password"
            name="password"
            value=""  
            class="form-control input-sm"
            placeholder="your password"
            />
            <label class="form-label" for="str_password">Your password</label>
        </div><!-- end form group -->
    </div><!-- end form outline -->
<!-- end password -->   

 <!-- start passwrod confirm-->
 <div class="form-outline mb-4">
        <div class="form-group {{ $errors->has('password') ? 'has-error' : ''}}" 
                        id="password_confirmation_group">
            <input
            id="password_confirmation"
            type="password"
            name="password_confirmation"
            value=""  
            class="form-control input-sm"
            placeholder="confirm your password"
            />
            <label class="form-label" for="password_confirmation">confirm your password</label>
        </div><!-- end form group -->
    </div><!-- end form outline -->
<!-- end password confirm-->   

<!-- password visibility button -->
    <button   type="button" 
        class="btn btn-primary btn-block mb-4"
        id="password-show-btn"    
            >Show password text
    </button>

<!-- 230619 i used a tutorial from 
https://stackoverflow.com/questions/66720254/google-recaptcha-with-laravel
-->



<!-- Submit button -->
    <button type="submit" class="btn btn-primary btn-block mb-4">Register as a user</button>

</form>
 
@endsection