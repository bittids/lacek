<!-- Stored in resources/views/cp/chat.blade.php -->
<!-- from https://pusher.com/tutorials/how-to-build-a-chat-app-with-vue-js-and-laravel/#9-creating-the-chat-app-view -->
@extends('layouts.layout_user')

@section('page_title')
<title>Delete comment</title>
@endsection

@section('header_local')
<meta name="csrf-token" content="{{ csrf_token() }}">


 
 @endsection


@section('scripts')

<script>

$(document).ready(function(){

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
        Delete comment
        <br><br>
        </div>
    </div><!-- end col -->
</div><!-- end row dov-->

 
@include('includes_view.status_row')
   
   
  <br>

<div class="row">
  <div class="col-sm-12">
     The content of your comment is 
      <br><br>
     {{ $coll_comment->str_comment  }}
  </div><!-- end col -->
</div><!-- end row dov-->


<div class="row">
  <div class="col-sm-12">
    <br>
  <p>If you do not want to delete this comment, click on cancel delete, below.  </p>
  <p><a href="{{ route('public.get.index') }}">Cancel this delete</a></p>
  <br>
     <p>If you are sure that you would like to delete this comment, click on confirm delete, below.  
     This will remove the comment from the blog, but not actually delete the comment.  
     If for some reason you need to access this comment in the future, we still have this comment in our records. </p>
  </div><!-- end col -->
</div><!-- end row dov-->

  <br>
<!-- this is from https://mdbootstrap.com/docs/standard/forms/overview/ -->

<form method="POST" id="delete_comment_form" action="{{ route('comments.post.delete_comment') }}" >
@csrf
<!--
<input type="hidden" id="str_id_name" name="str_id_name" value="{{-- $str_id_name --}}">
<input type="hidden" id="bool_cloaked" name="bool_cloaked" value="{{-- $bool_cloaked --}}">
<input type="hidden" id="str_id" name="str_id" value="{{-- $str_id --}}">
<input type="hidden" id="str_subject" name="str_subject" value="{{-- $str_subject --}}">
-->




  <!-- Submit button -->
  <button type="submit" class="btn btn-primary btn-block mb-4">Confirm delete for this comment</button>

</form>
 

<!--</div>  <!-- end container -->


@endsection