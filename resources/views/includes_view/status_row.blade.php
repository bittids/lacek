
@if (session('status'))
    <div class="row">
        <div class="col-sm-12">
            @if  (session('bool_bar_green'))
                <div class="alert alert-success">
            @else
                <div class="alert alert-danger">
            @endif
                {{ session('status') }}
            </div>
        </div><!-- end col -->
    </div><!-- end row dov-->
 @endif
