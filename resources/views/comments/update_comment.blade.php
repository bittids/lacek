<!-- Stored in resources/views/cp/chat.blade.php -->
<!-- from https://pusher.com/tutorials/how-to-build-a-chat-app-with-vue-js-and-laravel/#9-creating-the-chat-app-view -->
@extends('layouts.layout_user')

@section('page_title')
<title>Update comment</title>
@endsection

@section('header_local')
<meta name="csrf-token" content="{{ csrf_token() }}">


 
 @endsection


@section('scripts')

<script>

$(document).ready(function(){

    // the character counter code is from
    //https://stackoverflow.com/questions/5371089/count-characters-in-textarea
    // with significant customization that I did
    $("#div_chars_remaining").hide();
    $("#div_max_chars_exceeded").hide();
    $('#str_comment').on("input", function() {
        var maxLength = $(this).prop("maxLength");
        var currentLength = $(this).val().length;
        var int_chars_remaining = maxLength - currentLength;
       // alert("input received in str_mail message");
       // alert("maxLength = " + maxLength);
     //alert("int_chars_remaining = " + int_chars_remaining);
      //alert("currentLength = " + currentLength);
        $("#div_chars_remaining").show();

        $('#int_chars_remaining').text(int_chars_remaining)
        if (currentLength >= maxLength) 
        {
            $("#div_max_chars_exceeded").show();
            return console.log("You have reached the maximum number of characters.");
        }
        else
        {
            $("#div_max_chars_exceeded").hide();
        }

       // console.log(maxLength - currentLength + " chars left");
       // alert("jquery works");
    });
}); // end on doc ready function

 



</script>



@endsection


@section('content-header')
    

  
@endsection


@section('content')
    
<!--<div class="container-fluid">-->


<div class="row">
    <div class="col-sm-12">
        <div class="h4 text-center text-page-heading">
        Update Post
        <br><br>
        </div>
    </div><!-- end col -->
</div><!-- end row dov-->

 
@include('includes_view.status_row')
   
@include('includes_view.errors_row')

   
  <br>
<!-- this is from https://mdbootstrap.com/docs/standard/forms/overview/ -->

<form method="POST" id="update_comment_form" action="{{ route('comments.post.update_comment') }}" >
@csrf
<!--
<input type="hidden" id="str_id_name" name="str_id_name" value="{{-- $str_id_name --}}">
<input type="hidden" id="bool_cloaked" name="bool_cloaked" value="{{-- $bool_cloaked --}}">
<input type="hidden" id="str_id" name="str_id" value="{{-- $str_id --}}">
<input type="hidden" id="str_subject" name="str_subject" value="{{-- $str_subject --}}">
-->


 
 <!-- start str_comment -->
 <div class="form-outline mb-4">
  <div class="form-group {{ $errors->has('str_comment') ? 'has-error' : ''}}" 
            id="str_comment_group">
  <textarea 
        name="str_comment"
        id="str_comment" 
        rows="6"
        maxLength="999" 
 
        class="form-control "
        >{{-- old('str_content') --}}
        {{ old('str_comment',  $coll_comment->str_comment) }}
  </textarea>
 
  </div><!-- end form group -->
  </div><!-- end form outline -->
<!-- end str mail message -->   

<div id="div_chars_remaining">
<div class="row">
    <div class="col-sm-12">
        Your message has a limit of 1000 characters.  
        You have <span id="int_chars_remaining">1000</span> characters remaining.
        <br><br>
    </div><!-- end col -->
</div><!-- end row dov-->
</div><!-- end div chars remaining -->

<div id="div_max_chars_exceeded" class="alert alert-danger">
<div class="row">
    <div class="col-sm-12">
        Your message has a limit of 1000 characters.  You have exceeded the allowed length.
        <br><br>
    </div><!-- end col -->
</div><!-- end row dov-->
</div><!-- end div for max charsa exceeded -->



  <!-- Submit button -->
  <button type="submit" class="btn btn-primary btn-block mb-4">Update comment</button>

</form>
 

<!--</div>  <!-- end container -->


@endsection