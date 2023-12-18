<!-- Stored in resources/views/cp/chat.blade.php -->
<!-- from https://pusher.com/tutorials/how-to-build-a-chat-app-with-vue-js-and-laravel/#9-creating-the-chat-app-view -->
@extends('layouts.layout_user')

@section('page_title')
<title>Choose a comment</title>
@endsection

@section('header_local')
<meta name="csrf-token" content="{{ csrf_token() }}">
 
 <!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
-->
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
    
<div class="container-fluid">


<div class="row">
    <div class="col-sm-12">
        <div class="h4 text-center">
        Choose a comment
        </div>
    </div><!-- end col -->
</div><!-- end row dov-->

  
@include('includes_view.status_row')
   
@include('includes_view.errors_row')

  <br>

 <!-- 
<div class="row">
    <div class="col-sm-12">
    <p><a href="{{-- route('cp.get.choose-main-page') --}}">Choose a post</a></p>
    </div><!-- end col -->
<!--</div><!-- end row dov-->


 
 


<form method="POST" id="choose_comment_form" action="{{ route('comments.post.choose_comment') }}" >
@csrf

 
<br><br>

 <!-- start choose page -->
 <div class="form-outline mb-4">
   <div class="form-group {{ $errors->has('comment_id') ? 'has-error' : ''}}" 
                id="comment_id_group">
    
                <select name="comment_id"
                        class="form-control"  
                        id="comment_id">

@foreach($coll_comments as $coll_comment)

<option value="{{ $coll_comment->id }}" 
{{ (old('comment_id') == $coll_comment->id) ? 'selected="selected"' : '' }}>
{{ $coll_comment->str_comment }} &nbsp; 
{{ $coll_comment->str_created_at_formatted }}
</option>
@endforeach

 </select>



    <label class="form-label" for="form2Example1">Choose a comment </label>
  </div><!-- end form group -->
  </div><!-- end form outline -->
<!-- end choose page -->   

  <!-- Submit button -->
  <button type="submit" class="btn btn-primary btn-block mb-4">Choose this comment</button>

</form>
 

</div>  <!-- end container -->


@endsection