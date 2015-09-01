@if(Session::has('success-message'))
    <div class="alert alert-success">
        {{ Session::get('success-message') }}
    </div>

@elseif(Session::has('error-message'))
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{ Session::get('error-message') }}
    </div>
@else
    <div class="interface-message-container">
        <script id="interface-message" type="text/x-handlebars-template">
            @{{#if success}}
            <div class="alert alert-success">
                @{{message}}
            </div>
            @{{/if}}

            @{{#if error}}
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                @{{message}}
            </div>
            @{{/if}}
        </script>
    </div>
@endif

