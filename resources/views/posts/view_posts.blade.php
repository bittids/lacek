<!-- Stored in resources/views/cp/chat.blade.php -->
<!-- from https://pusher.com/tutorials/how-to-build-a-chat-app-with-vue-js-and-laravel/#9-creating-the-chat-app-view -->
@extends('layouts.layout_user')

@section('page_title')
<title>View Posts</title>
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
        View Your Posts
        <br><br>
        </div>
    </div><!-- end col -->
</div><!-- end row dov-->

 
@include('includes_view.status_row')
   
   
  <br>

  @foreach($coll_posts as $coll_post)
<div class="row">
    <div class="col-sm-12 lightyellow pad20">
        <div class="row">
            <div class="col-sm-12 lightaqua">
{{ $coll_post->str_date_formatted }}
            </div><!-- end col -->
            <div class="col-sm-12 lightskyblue">
{{ $coll_post->str_title }}
            </div><!-- end col -->
            <div class="col-sm-12 lightgreen">
{{ $coll_post->str_post }}
            </div><!-- end col -->

        </div><!-- end row dov-->

    </div><!-- end col -->
</div><!-- end row dov-->
<br>
@endforeach

  <br>



@endsection