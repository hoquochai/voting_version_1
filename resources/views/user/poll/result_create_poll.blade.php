@extends('layouts.app')
@section('content')
    <div class="col-lg-6 col-lg-offset-3">
        <div class="hide"
            data-email-poll="{{ json_encode($poll->toArray()) }}"
            data-email-link="{{ json_encode($link) }}"
            data-email-password="{{ (isset($password) && $password) ? $password : "" }}"
            data-email-route="{{ url('/check-email') }}"
            data-email-token="{{ csrf_token() }}"
            data-email-message="{{ json_encode(trans('polls.message_client')) }}">
        </div>
        <div class="panel panel-default animated fadeInDown">
            <div class="panel-heading">
                {{ trans('polls.result_create.head') }}
            </div>
            <div class="panel-body">
                <div class=" col-lg-12">
                    <div class="message-send-mail col-lg-10 col-lg-offset-1">

                    </div>
                </div>
                <h3>{{ trans('polls.result_create.thank') }} {{ ($poll->user_id) ? $poll->user->name : $poll->name }}</h3>
                <h4>{{ trans('polls.result_create.create_success') }}</h4>
                <p>{{ trans('polls.result_create.send_mail', ['email' => ($poll->user_id) ? $poll->user->email : $poll->email]) }}</p>
                <p><a href="#" onclick="sendMailAgain()">{{ trans('polls.send_mail_again') }}</a></p>
                <p><i>{{ trans('polls.result_create.participant_link') }}</i></p>
                <p>{{ trans('polls.result_create.help_participant') }}</p>
                <a href="{{ $link['participant'] }}" target="_blank" id="linkVote">{{ $link['participant'] }}</a>
                <button class="btn btn-success btn-sm" onclick="copyToClipboard('#linkVote')">
                    <span class="glyphicon glyphicon-copy"></span> {{ trans('polls.copy_link') }}
                </button>
                @if (isset($password) && $password)
                    <p>{{ trans('label.password') }}: {{ $password }}</p>
                @endif
                <hr>
                <p><i>{{ trans('polls.result_create.link_admin') }}</i></p>
                <p>{{ trans('polls.result_create.help_admin') }}</p>
                <a href="{{ $link['administration'] }}" id="linkAdmin" target="_blank">{{ $link['administration'] }}</a>
                <button class="btn btn-success btn-sm" onclick="copyToClipboard('#linkAdmin')">
                    <span class="glyphicon glyphicon-copy"></span> {{ trans('polls.copy_link') }}
                </button>
            </div>
        </div>
    </div>
@endsection
