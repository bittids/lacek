<!-- Stored in resources/views/public/index.blade.php -->
@extends('layouts.layout_public')

@section('page_title')
<title>Links page</title>
@endsection

@section('header_local')
<meta name="csrf-token" content="{{ csrf_token() }}">
 
 @endsection


@section('scripts')

<script>

$(document).ready(function(){

}); // end on doc ready function



</script>


<script>



</script>

@endsection


@section('content-header')
    

  
@endsection


@section('content')
    


<div class="row">
    <div class="col-sm-12">
        <div class="h4 text-center text-page-heading">
        Links page
        <br><br>
        </div>
    </div><!-- end col -->
</div><!-- end row dov-->



<div class="row">
    <div class="col-sm-12">
    <p><a href="{{ route('blog.get.show_blog') }}">Show the blog</a></p>
    <p><a href="{{ route('posts.get.create_post') }}">Create a post</a></p>
    <p><a href="{{ route('posts.get.choose_post') }}">Choose a post - update, delete, choose comment</a></p>
    <p><a href="{{ route('posts.get.view_posts') }}">View all your posts</a></p>
    
 
        <br><br>
    </div><!-- end col -->
</div><!-- end row dov-->


@endsection