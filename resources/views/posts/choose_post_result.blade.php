<!-- Stored in resources/views/cp/chat.blade.php -->
<!-- from https://pusher.com/tutorials/how-to-build-a-chat-app-with-vue-js-and-laravel/#9-creating-the-chat-app-view -->
@extends('layouts.layout_user')

@section('page_title')
<title>Choose Post result</title>
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
        Choose Post Result
        <br><br>
        </div>
    </div><!-- end col -->
</div><!-- end row dov-->

 
@include('includes_view.status_row')
 
   
  <br>

  <div class="row">
    <div class="col-sm-12">
       The title of your post is 
        <br><br>
       {{ $coll_post->str_title  }}
    </div><!-- end col -->
</div><!-- end row dov-->

<div class="row">
    <div class="col-sm-12">
       The content of your post is 
        <br><br>
       {{ $coll_post->str_post  }}
    </div><!-- end col -->
</div><!-- end row dov-->

<div class="row">
    <div class="col-sm-12">
    <p><a href="{{ route('posts.get.update_post') }}">Update the post you chose</a></p>
    <p><a href="{{ route('posts.get.delete_post') }}">Delete the post you chose</a></p>
    <p><a href="{{ route('comments.get.choose_comment') }}">Choose a comment</a></p>

    </div><!-- end col -->
</div><!-- end row dov-->



@endsection