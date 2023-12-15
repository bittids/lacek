  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

 
  <!-- Bootstrap  -->


<!-- Latest compiled and minified CSS -->
<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
-->
<!-- 230620 - upgrade from bootstrap 3 to 4 -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
  <!--
  <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.css?125')}}">
-->
  <!-- Font Awesome -->

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
 
 
  <!-- Ionicons -->
 
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

  <!-- DataTables -->
  <!--
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
-->

<!-- now import local sss style sheets -->
<!--
<link rel="stylesheet" href="{{ asset('css/w3.css') }}">
-->
<link rel="stylesheet" href="{{ asset('css/mystyle.css') }}">

<!-- 231112 this is to include the directives in resources/css/app.css for tailwind.css -->
<link href="{{ asset('css/app.css') }}" rel="stylesheet">

<!-- 231112 the next line was suggested in 
https://stackoverflow.com/questions/72921242/why-laravel-does-not-load-tailwind-css-styles-installed-with-laravel-breeze-star 
-->
<script defer src="{{asset('js/app.js')}}"></script>

<!-- 231112 the next line is for tailwind CDN, suggested in
https://laravel.io/articles/setting-up-tailwind-css-in-laravel
-->
<!-- 231112 until the NPM install works, this cvn install does work -->
<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">

<!-- this is for mobile websites -->
<!-- https://www.w3schools.com/w3css/w3css_mobile.asp -->
<!--<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3pro.css">-->
  <!--
  <link rel="stylesheet" href="{{ asset('plugins/datatables/dataTables.bootstrap.css') }}">
-->
 <!-- this is the CDN for vue.js -->
 <!-- see the vue.js tutorial in w3schools.com -->
<!-- but teh w3schools vue tutorial does not load it until after HTML is loaded -->
 <!--
 <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
-->

<!-- jquery -->
<!--
<script src="https://code.jquery.com/jquery-3.5.1.min.js">
  </script>
  -->
  <!--
  <script
  src="https://code.jquery.com/jquery-3.7.0.js"
  integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="
  crossorigin="anonymous"></script>-->
<!-- jquery from google CDN -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>

<!-- jquery UI start therme CSS -->
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/themes/start/jquery-ui.css">
<!-- jquiery UI CSS -->
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>

<!-- bootstrap js -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
