<!DOCTYPE html>
<html lang="en">
<head>
    @yield('page_title')
    @include('includes.header_main')
    @yield('header_local')
    @yield('styles')
</head>
<body class="hold-transition skin-blue sidebar-mini">



<div class="container-fluid"> 
@include('includes.content_main_header')

@include('includes.content_cp_section_header')




<!-- Content Wrapper. Contains page content -->
    <div class="pageContentWrapper">
    	
        @yield('content-header')
        @yield('content')
    </div>

<!--include('users.partials.footer')
include('admin.partials.control_sidebar') -->
<!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
   <!-- <div class="control-sidebar-bg"></div>-->
@include('includes.footer')
<!--</div> date-230627 the only think I see is class app that needs to be closed -->

</div><!-- end class container-fluid -->

 <!-- this is the CDN for vue.js -->
 <!-- see the vue.js tutorial in w3schools.com -->
<!-- but teh w3schools vue tutorial does not load it until after HTML is loaded -->
 <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>

@yield('scripts')
</body>
</html>