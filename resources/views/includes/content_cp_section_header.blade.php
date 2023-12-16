
<!-- the w3 classes below are in resources / css / w3.css-->
<div class="lightaqua">
    <div class="row">
        <div class="col-sm-3"> 
        Logged in as:<br>
        {{ $coll_more_user_info->str_first_name  }}<br>
        {{ $coll_more_user_info->str_last_name  }}
        </div>
        <div class="col-sm-6"> 
        <div class="text-center">
             User section
        </div>     
        </div>

    
        <div class="col-sm-3"> 
            <a href="/">Links page</a> 
            <br>
            <a class="dropdown-item" href="{{ route('auth.get.logout') }}">
                Logout user </a>
<!--onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
    {{ __('Logout') }}
</a>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
-->
<!--<br>
<a class="dropdown-item" href="{{ url('/broadcasting/auth') }}" 
onclick="event.preventDefault(); document.getElementById('broadcast-auth-form').submit();">
    {{ __('broadcasting/auth') }}
</a>
-->

<!--<form id="broadcast-auth-form" action="{{ url('/broadcasting/auth') }}" 
        method="POST" style="display: none;">
    @csrf
</form>
-->
        </div><!-- end col 3 -->
    </div><!-- end row -->  
</div><!-- end w3-container and w3-red -->