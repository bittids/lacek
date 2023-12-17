<!-- Stored in resources/views/cp/chat.blade.php -->
<!-- from https://pusher.com/tutorials/how-to-build-a-chat-app-with-vue-js-and-laravel/#9-creating-the-chat-app-view -->
@extends('layouts.layout_user')

@section('page_title')
<title>Update Post result</title>
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
        Update Post Result
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



@endsection