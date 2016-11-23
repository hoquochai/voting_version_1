@extends('layouts.app')
@section('title')
    {{ trans('polls.title') }}
@endsection
@section('content')
    {{--<div class="col-lg-12">--}}
        <div class="loader"></div>
        <div class="hide"
             data-poll="{{ $data['jsonData'] }}"
             data-route-email="{{ url('/check-email') }}"
             data-route-link="{{ route('link-poll.store') }}"
             data-token="{{ csrf_token() }}">
        </div>
        {{
           Form::open([
               'route' => 'user-poll.store',
               'method' => 'POST',
               'id' => 'form_create_poll',
               'enctype' => 'multipart/form-data',
               'role' => 'form',
           ])
        }}
            <div id="create_poll_wizard" class="col-lg-8 col-lg-offset-2 well wrap-poll animated fadeInLeft">
                @include('layouts.error')
                @include('layouts.message')
                <div class="progress">
                    <div class="progress-bar progress-bar-success progress-bar-striped bar" role="progressbar"
                         aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="background: darkcyan">
                    </div>
                </div>
                <div class="navbar panel">
                    <div class="navbar-inner board">
                        <div class="col-lg-10 col-lg-offset-1 panel-heading board-inner" style="padding: 5px">
                            <ul class="nav nav-tabs voting">
                                <div class="liner"></div>
                                <li>
                                    <a href="#info" data-toggle="tab" data-toggle="tooltip"  title="{{ trans('polls.label.step_1') }}" class="step">
                                        <span class="round-tabs one fa fa-info">
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#option" data-toggle="tab" data-toggle="tooltip" title="{{ trans('polls.label.step_2') }}" class="step">
                                        <span class="round-tabs two fa fa-question">
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#setting" data-toggle="tab" data-toggle="tooltip" title="{{ trans('polls.label.step_3') }}" class="step">
                                        <span class="round-tabs three fa fa-cog">
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#participant" data-toggle="tab" data-toggle="tooltip" class="step" title="{{ trans('polls.label.step_4') }}">
                                        <span class="round-tabs four fa fa-users">
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="tab-content">
                    <div class="tab-pane" id="info">
                        <div class="panel" style="margin: 0; border-radius: 0;border-color: darkcyan">
                            <div class="panel-heading" style="background: darkcyan; border-color: darkcyan; border-radius: 0; color: white">
                                {{ trans('polls.label.step_1') }}
                            </div>
                            <div class="panel-body">
                                @include('layouts.poll_info')
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="option">
                        <div class="panel" style="border-color: darkcyan; border-radius: 0">
                            <div class="panel-heading" style="background: darkcyan; color: white; border-radius: 0">
                                {{ trans('polls.label.step_2') }}
                            </div>
                            <div class="panel-body">
                                @include('layouts.poll_options')
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="setting">
                        <div class="panel" style="border-color: darkcyan; border-radius: 0">
                            <div class="panel-heading" style="background: darkcyan; color: white; border-radius: 0">
                                {{ trans('polls.label.step_3') }}
                            </div>
                            <div class="panel-body">
                                @include('layouts.poll_setting')
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="participant">
                        <div class="panel" style="border-color: darkcyan; border-radius: 0">
                            <div class="panel-heading" style="background: darkcyan; color: white; border-radius: 0">
                                {{ trans('polls.label.step_4') }}
                            </div>
                            <div class="panel-body">
                                @include('layouts.poll_participant')
                            </div>
                        </div>
                    </div>
                    <ul class="pager wizard">
                        <li class="previous"><a href="#" class="btn-change-step btn btn-darkcyan">{{ trans('polls.button.previous') }}</a></li>
                        <li class="next"><a href="#" class="btn-change-step btn btn-darkcyan">{{ trans('polls.button.continue') }}</a></li>
                        <li class="finish"><a href="#" class="btn btn-change-step btn-darkcyan btn-finish">{{ trans('polls.button.finish') }}</a></li>
                    </ul>
                </div>
            </div>
            {{--<div class="col-lg-2" style="padding: 0; margin-top: 20px; position: absolute; right: 0">--}}
                    {{--<div class="panel info-explain panel-default animated fadeInRight" style="border: none">--}}
                        {{--<div class="panel-body panel-body-explain">--}}
                            {{--{!! trans('polls.tooltip.info')  !!}--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="panel panel-default option-explain animated fadeInRight" style="border: none;">--}}
                        {{--<div class="panel-body panel-body-explain">--}}
                            {{--{!! trans('polls.tooltip.option')  !!}--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="panel panel-default panel-setting-explain animated fadeInRight" style="border: none;">--}}
                        {{--<div class="panel-body panel-body-explain">--}}
                            {{--{!! trans('polls.tooltip.setting')  !!}--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="panel panel-participant-explain panel-default animated fadeInRight" style="border: none;">--}}
                        {{--<div class="panel-body panel-body-explain">--}}
                            {{--{!! trans('polls.tooltip.participant') !!}--}}
                        {{--</div>--}}
                    {{--</div>--}}
            {{--</div>--}}
        {{ Form::close() }}
    {{--</div>--}}
@endsection
