<!DOCTYPE html>
<html>
<head>
    @yield('page_title')
    @include('includes.header_main')
    @yield('header_local')
    @yield('styles')
</head>
<!--<body class="hold-transition skin-blue sidebar-mini"> -->
<body class="">
<div class="app">
<div class="container-fluid">
@include('includes.content_main_header')

@include('includes.content_public_section_header')

<!-- Content Wrapper. Contains page content -->
    <div class="pageContentWrapper">
    	
        @yield('content-header')
        @yield('content')
    </div>

<!--include('users.partials.footer')
include('admin.partials.control_sidebar') -->
<!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
</div>
@include('includes.footer')
</div><!-- end container-fluid -->

 <!-- this is the CDN for vue.js -->
 <!-- see the vue.js tutorial in w3schools.com -->
<!-- but teh w3schools vue tutorial does not load it until after HTML is loaded -->
 
 <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>

@yield('scripts')
</body>
</html>