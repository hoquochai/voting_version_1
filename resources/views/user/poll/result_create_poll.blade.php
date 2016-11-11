@extends('layouts.app')
@section('content')
    <div class="col-lg-6 col-lg-offset-3">
        <div class="panel panel-default">
            <div class="panel-heading animated fadeInDown">
            {{ trans('polls.result_create.head') }}
            </div>
            <div class="panel-body">
                <h3>{{ trans('polls.result_create.thank') }} {{ $poll->user->name }}</h3>
                <h4>{{ trans('polls.result_create.create_success') }}</h4>
                <p>{{ trans('polls.result_create.send_mail', ['email' => $poll->email]) }}</p>
                <p><i>{{ trans('polls.result_create.participant_link') }}</i></p>
                <p>{{ trans('polls.result_create.help_participant') }}</p>
                <a href="{{ $link['participant'] }}" target="_blank">{{ $link['participant'] }}</a>
                <hr>
                <p><i>{{ trans('polls.result_create.link_admin') }}</i></p>
                <p>{{ trans('polls.result_create.help_admin') }}</p>
                <a href="{{ $link['administration'] }}" target="_blank">{{ $link['administration'] }}</a>
            </div>
        </div>
    </div>
@endsection
