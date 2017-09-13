<div class="col-sm-6 col-sm-offset-3">
    @if(Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif
</div>