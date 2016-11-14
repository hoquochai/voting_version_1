@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2 animated fadeInUp login">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('label.login') }}</div>
                <div class="panel-body">
                    <div class="row btn-social-login">
                        <div class="col-md-4">
                            <a class="btn btn-social btn-facebook" href="{{ url('redirect/facebook') }}">
                                <span class="fa fa-facebook"></span>
                                {{ trans('auth.facebook_login') }}
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a class="btn btn-social btn-google" href="{{ url('redirect/google') }}">
                                <span class="fa fa-google"></span>
                                {{ trans('auth.google_login') }}
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a class="btn btn-social btn-twitter" href="{{ url('redirect/twitter') }}">
                                <span class="fa fa-twitter"></span>
                                {{ trans('auth.twitter_login') }}
                            </a>
                        </div>
                    </div>
                    <hr>
                    @include('errors.errors')
                    {{ Form::open(['route' => 'user-login', 'class' => 'form-horizontal']) }}
                        <div class="form-group">
                            {{ Form::label('email', trans('label.email'), ['class' => 'col-md-3 control-label']) }}
                            <div class="col-md-9">
                                {{ Form::email('email', old('email'), ['class' => 'form-control']) }}
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label('password', trans('label.password'), ['class' => 'col-md-3 control-label']) }}
                            <div class="col-md-9">
                                {{ Form::password('password', ['id' => 'password', 'class' => 'form-control']) }}
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-9 col-md-offset-3">
                                <div class="checkbox">
                                    <label>
                                        {{ Form::checkbox('remember') }}
                                        {{ trans('label.remember') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-10 col-md-offset-1">
                                    {{ Form::button('<span class="glyphicon glyphicon-log-in"></span> ' . trans('label.login'), ['type' => 'submit', 'class' => 'btn btn-success btn-block btn-login']) }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <a class="btn btn-link" href="{{ url('/password/reset') }}">
                                        {{ trans('label.forgot_password') }}
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <a class="btn btn-link register-text" href="{{ url('/register') }}">
                                        {{ trans('label.register') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
