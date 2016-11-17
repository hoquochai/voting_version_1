@extends('layouts.app')
@section('title')
    {{ trans('polls.title') }}
@endsection
@section('content')
    <div class="col-lg-12">
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
            <div id="create_poll_wizard" class="col-lg-6 col-lg-offset-3 well wrap-poll animated fadeInLeft">
                <div class="progress">
                    <div class="progress-bar progress-bar-success progress-bar-striped bar" role="progressbar"
                         aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:40%">
                    </div>
                </div>
                <div class="navbar panel">
                    <div class="navbar-inner board">
                        <div class="col-lg-10 col-lg-offset-1 panel-heading board-inner">
                            <ul class="nav nav-tabs">
                                <div class="liner"></div>
                                <li>
                                    <a href="#info" data-toggle="tab" class="step">
                                        <span class="round-tabs one glyphicon glyphicon-info-sign">
                                        </span>
                                    </a>
                                </li>
                                <li><a href="#option" data-toggle="tab" class="step">
                                        <span class="round-tabs two glyphicon glyphicon-option-horizontal">
                                        </span>
                                    </a></li>
                                <li><a href="#setting" data-toggle="tab" class="step">
                                        <span class="round-tabs three glyphicon glyphicon-cog">
                                        </span>
                                    </a></li>
                                <li><a href="#participant" data-toggle="tab" class="step">
                                        <span class="round-tabs four glyphicon glyphicon-user">
                                        </span>
                                    </a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                @include('layouts.error')
                @include('layouts.message')
                <div class="tab-content">
                    <div class="tab-pane" id="info">
                        <div class="panel">
                            <div class="panel-heading" style="background: darkcyan; color: white">
                                {{ trans('polls.label.step_1') }}
                            </div>
                            <div class="panel-body">
                                @include('layouts.poll_info')
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="option">
                        <div class="panel">
                            <div class="panel-heading" style="background: darkcyan; color: white">
                                {{ trans('polls.label.step_2') }}
                                <button class="btn btn-warning btn-xs btn-show-advance-add-option" type="button" id="show" style="float: right">
                                    <span class="glyphicon glyphicon-download"></span>
                                </button>
                                <!-- BUTTON ADD OPTION -->
                                <div class="addAdvance" style="display: none">
                                    <div class="input-group col-lg-4 col-lg-offset-8">
                                            {{
                                                Form::number('number', null, [
                                                    'class' => 'form-control',
                                                    'placeholder' => trans('polls.placeholder.number_add'),
                                                    'id' => 'number',
                                                    'min' => 1,
                                                    'max' => 99,
                                                    'oninput' => "validity.valid||(value='1');",
                                                ])
                                            }}
                                        <span class="input-group-btn">
                                        {{
                                            Form::button('<span class="glyphicon glyphicon-plus"></span>', [
                                                'class' => 'btn btn-default',
                                                'onclick' => 'addOption(' . $data['jsonData'] . ')'
                                            ])
                                        }}
                                    </span>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                @include('layouts.poll_options')
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="setting">
                        <div class="panel">
                            <div class="panel-heading" style="background: darkcyan; color: white">
                                {{ trans('polls.label.step_3') }}
                            </div>
                            <div class="panel-body">
                                @include('layouts.poll_setting')
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="participant">
                        <div class="panel">
                            <div class="panel-heading" style="background: darkcyan; color: white">
                                {{ trans('polls.label.step_3') }}
                            </div>
                            <div class="panel-body">
                                @include('layouts.poll_participant')
                            </div>
                        </div>
                    </div>
                    <ul class="pager wizard">
                        <li class="next"><a href="#" class="btn-change-step btn btn-primary">Next</a></li>
                        <li class="finish"><a href="#" class="btn btn-change-step btn-primary btn-finish">Finish</a></li>
                    </ul>
                </div>
            </div>
        {{ Form::close() }}
    </div>
@endsection
