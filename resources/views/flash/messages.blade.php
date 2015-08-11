@if(Session::has('success-message'))
    <div class="alert alert-success">
        {{ Session::get('success-message') }}
    </div>
@endif

@if(Session::has('error-message'))
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{ Session::get('error-message') }}
    </div>
@endif