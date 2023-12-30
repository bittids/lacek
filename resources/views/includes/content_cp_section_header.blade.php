
<!-- the w3 classes below are in resources / css / w3.css-->

    <div class="row">
        <div class="col-sm-3 lightaqua"> 
        Logged in as:<br>
        {{ $coll_more_user_info->str_first_name  }}&nbsp;
        {{ $coll_more_user_info->str_last_name  }}
        </div>
        <div class="col-sm-9 lightaqua"> 
        <div class="text-center">
        @include('includes.cp_navbar')
        </div>     
        </div>

   
    </div><!-- end row -->  
