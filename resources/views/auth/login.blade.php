@extends('layout')

@section('title', 'Sing in')
@stop

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>Sign In</h3>
                </div>
                <div class="panel-body">
                    @include('errors.list')

                    {!! Form::open(['action' => 'Auth\AuthController@postLogin', 'class' => 'form-horizontal']) !!}
                        <div class="form-group">
                            {!! Form::label('login', 'Login:', ['class' => 'col-md-4 control-label']) !!}

                            <div class="col-md-6">
                                {!! Form::text('login', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('password', 'Password:', ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::password('password', ['class' => 'form-control']) !!}
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                {!! Form::submit('Sign In', ['class' => 'btn btn-primary form-control']) !!}
                            </div>
                        </div>

                            {!! Form::close() !!}
                        </div>
            </div>
        </div>
    </div>
@stop