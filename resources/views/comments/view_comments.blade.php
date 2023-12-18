<!-- Stored in resources/views/cp/chat.blade.php -->
<!-- from https://pusher.com/tutorials/how-to-build-a-chat-app-with-vue-js-and-laravel/#9-creating-the-chat-app-view -->
@extends('layouts.layout_user')

@section('page_title')
<title>View comments</title>
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
        View Your comments
        <br><br>
        </div>
    </div><!-- end col -->
</div><!-- end row dov-->

 
@include('includes_view.status_row')
   
   
  <br>

  @foreach($coll_comments as $coll_comment)
<div class="row">
    <div class="col-sm-12 lightyellow pad20">
        <div class="row">
            <div class="col-sm-3">
Date of comment creation
            </div><!-- end col -->
            <div class="col-sm-9 lightaqua">
{{ $coll_comment->str_date_formatted }}
            </div><!-- end col -->
        </div>

        <div class="row">
            <div class="col-sm-3">
Post creator
            </div><!-- end col -->
            <div class="col-sm-9 lightbrown">
{{ $coll_comment->user->more_user_info->str_first_name }} &nbsp; {{ $coll_comment->user->more_user_info->str_last_name }}
            </div><!-- end col -->
        </div>


        <div class="row">
            <div class="col-sm-3">
            comment content
            </div><!-- end col -->
 
            <div class="col-sm-9 lightgreen">
{{ $coll_comment->str_comment }}
            </div><!-- end col -->

        </div><!-- end row dov-->

    </div><!-- end col -->
</div><!-- end row dov-->
<br>
@endforeach

  <br>



@endsection