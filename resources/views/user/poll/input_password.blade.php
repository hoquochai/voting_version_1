@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @include('message')
        @include('errors.errors')
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('label.password') }}</div>
                <div class="modal-dialog-password">
                    <div class="modal-content-password">
                        <div class="modal-bodymodal-dialog-password">
                            <fieldset class="required-password">
                                <div class="form-group">
                                    <div class="col-md-10 col-md-offset-2">
                                        {{ Form::open(['route' => 'set-password.store']) }}
                                        <div class="col-md-6">
                                            {{ Form::password('password', ['id' => 'password', 'class' => 'form-control', 'placeholder' => trans('polls.placeholder.password_poll')]) }}
                                            {{ Form::hidden('poll_id', $poll->id) }}
                                            {{ Form::hidden('token', $token) }}
                                        </div>
                                        <div class="col-md-4">
                                            {{ Form::button('<i class="glyphicon glyphicon-ok"></i>'
                                                . ' ' . trans('polls.check'), ['type' => 'submit', 'class' => 'btn btn-primary'])
                                            }}
                                        </div>
                                        {{ Form::close() }}
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                     </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
