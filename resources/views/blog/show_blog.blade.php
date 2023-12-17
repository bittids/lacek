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


 

</div>  <!-- end container -->


@endsection