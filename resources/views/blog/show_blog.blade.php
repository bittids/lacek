<!-- Stored in resources/views/cp/chat.blade.php -->
<!-- from https://pusher.com/tutorials/how-to-build-a-chat-app-with-vue-js-and-laravel/#9-creating-the-chat-app-view -->
@extends('layouts.layout_public')

@section('page_title')
<title>Blog display page</title>
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
        Blog Display Page
        </div>
    </div><!-- end col -->
</div><!-- end row dov-->

  
@foreach($coll_posts as $coll_post)
<div class="row">
    <div class="col-sm-12 lightyellow pad20">
        <div class="row">
            <div class="col-sm-3">
Date of post creation
            </div><!-- end col -->
            <div class="col-sm-9 lightaqua">
{{ $coll_post->str_date_formatted }}
            </div><!-- end col -->
        </div>

        <div class="row">
            <div class="col-sm-3">
Post creator
            </div><!-- end col -->
            <div class="col-sm-9 lightblue">
{{ $coll_post->user->more_user_info->str_first_name }} &nbsp; {{ $coll_post->user->more_user_info->str_last_name }}
            </div><!-- end col -->
        </div>


        <div class="row">
            <div class="col-sm-3">
Post title
            </div><!-- end col -->
 
            <div class="col-sm-9 lightskyblue">
{{ $coll_post->str_title }}
            </div><!-- end col -->
        </div>

        <div class="row">
            <div class="col-sm-3">
Post content
            </div><!-- end col -->
 
            <div class="col-sm-9 lightgreen">
{{ $coll_post->str_post }}
            </div><!-- end col -->

        </div><!-- end row dov-->

        <!-- start comments here -->

        @foreach($coll_post->comments as $coll_comment)
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
            comment creator
            </div><!-- end col -->
            <div class="col-sm-9 lightskyblue">
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
@endforeach
<br>

       <!-- end comments here -->

        <div class="row">
            <div class="col-sm-3">
&nbsp;
            </div><!-- end col -->
 
            <div class="col-sm-9 lightskyblue">
            <p><a href="{{ route('comments.get.create_comment', ['post_id' => $coll_post->id]) }}">Create a comment for this post</a></p>

            </div><!-- end col -->

        </div><!-- end row dov-->

    </div><!-- end col -->
</div><!-- end row dov-->
<br>
@endforeach


 

</div>  <!-- end container -->


@endsection