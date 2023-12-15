
<div class="row">
    <div class="col-sm-12">
    @if (count($errors) > 0)    
        <div class="alert alert-danger">
            <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        </div><!-- end alert danger -->
        @endif
    </div><!-- end col -->
</div><!-- end row dov-->
