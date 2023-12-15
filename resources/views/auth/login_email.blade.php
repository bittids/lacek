<!-- Stored in resources/views/cp/chat.blade.php -->
<!-- from https://pusher.com/tutorials/how-to-build-a-chat-app-with-vue-js-and-laravel/#9-creating-the-chat-app-view -->
@extends('layouts.layout_public')

@section('page_title')
<title>Content Provider - login by email</title>
@endsection

@section('header_local')
<meta name="csrf-token" content="{{ csrf_token() }}">
 
<!-- bootstrap css is already in includes/header_main.php -->
 <!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
-->
 <script src="https://www.google.com/recaptcha/api.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
 @endsection


@section('scripts')
 

<script>

$(document).ready(function(){

 

}); // end on doc ready function


</script>
<script src="{{ asset('js/my_jquery_functions.js') }}"></script>

<script src="https://www.google.com/recaptcha/api.js"></script>

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
        Content Provider login by email
        </div>
    </div><!-- end col -->
</div><!-- end row dov-->

  
@include('includes_view.status_row')
   
@include('includes_view.errors_row')

<br>
<!-- this is from https://mdbootstrap.com/docs/standard/forms/overview/ -->


<div class="row">
    <div class="col-sm-12">
        <a href="{{ route('auth.get.register-email') }}">
            Don't have an account? Get an account here</a>
    </div><!-- end col -->
</div><!-- end row dov-->


<form method="POST" id="login_form" action="{{ route('auth.post.login-email') }}" >
    @csrf

 <!-- start rmsil -->
    <div class="form-outline mb-4">
        <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}" id="email_group">
            <input
            id="email"
            type="text"
            name="email"
            value="{{ old('email') }}"  
            class="form-control input-sm"
            placeholder="your email"
            />
            <label class="form-label" for="str_email">Your email</label>
        </div><!-- end form group -->
    </div><!-- end form outline -->
<!-- end email -->   



 <!-- start passwrod -->
    <div class="form-outline mb-4">
        <div class="form-group {{ $errors->has('password') ? 'has-error' : ''}}" id="passwrod_group">
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

<!-- password visibility button -->
    <button   type="button" 
        class="btn btn-primary btn-block mb-4"
        id="password-show-btn"    
            >Show password text
    </button>

   

<!-- Submit button -->
    <button type="submit" class="btn btn-primary btn-block mb-4">Login</button>

</form>
 
@endsection