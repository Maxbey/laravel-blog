<div class="form-group">
    {!! Form::label('author', 'Author:') !!}

    @if(\Auth::check())

        {!! Form::text('author', Auth::user()->login, ['class' => 'form-control', 'readonly']) !!}

    @elseif(\Session::has('commentAuthor'))

        {!! Form::text('author', \Session::get('commentAuthor'), ['class' => 'form-control', 'readonly']) !!}

    @else

        {!! Form::text('author', null, ['class' => 'form-control']) !!}

    @endif
    </div>

<div class="form-group">
    {!! Form::label('body', 'Comment:') !!}
    {!! Form::textarea('body', null, ['class' => 'form-control', 'id' => 'comment-textarea']) !!}
</div>

<div class="form-group">
    {!! Form::submit($submitButton, ['class' => 'btn btn-primary form-control']) !!}
</div>