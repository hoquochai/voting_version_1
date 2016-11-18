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
                        <div class="col-lg-10 col-lg-offset-1 panel-heading board-inner" style="padding: 5px">
                            <ul class="nav nav-tabs voting">
                                <div class="liner"></div>
                                <li>
                                    <a href="#info" data-toggle="tab tooltip"  title="{{ trans('polls.label.step_1') }}" class="step">
                                        <span class="round-tabs one glyphicon glyphicon-info-sign">
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#option" data-toggle="tab tooltip" title="{{ trans('polls.label.step_2') }}" class="step">
                                        <span class="round-tabs two glyphicon glyphicon-option-horizontal">
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#setting" data-toggle="tab tooltip" title="{{ trans('polls.label.step_3') }}" class="step">
                                        <span class="round-tabs three glyphicon glyphicon-cog">
                                        </span>
                                    </a>
                                </li>
                                <li data-toggle="tooltip" title="{{ trans('polls.label.step_4') }}">
                                    <a href="#participant" data-toggle="tab tooltip" class="step">
                                        <span class="round-tabs four glyphicon glyphicon-user">
                                        </span>
                                    </a>
                                </li>
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
                                <div class="row">
                                    <div class="col-lg-3">
                                        {{ trans('polls.label.step_2') }}
                                    </div>
                                    <div class="col-lg-7">
                                        <!-- BUTTON ADD OPTION -->
                                        <div class="addAdvance" style="display: none">
                                            <div class="input-group">
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
                                    <div class="col-lg-2">
                                        <button class="btn btn-warning btn-xs btn-show-advance-add-option" type="button" id="show" style="float: right">
                                            <span class="glyphicon glyphicon-hand-left"></span>
                                        </button>
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
                        <li class="previous"><a href="#" class="btn-change-step btn btn-primary">{{ trans('polls.button.previous') }}</a></li>
                        <li class="next"><a href="#" class="btn-change-step btn btn-primary">{{ trans('polls.button.continue') }}</a></li>
                        <li class="finish"><a href="#" class="btn btn-change-step btn-primary btn-finish">{{ trans('polls.button.finish') }}</a></li>
                    </ul>
                </div>
            </div>
            {{--<div class="col-lg-2 col-lg-offset-1 animated fadeInRight explain" style="padding-right: 0; margin-top: 100px">--}}
                {{--<div class="row info-explain" style="margin-top: 20px;">--}}
                    {{--<div class="panel panel-default" style="border: none; position: fixed">--}}
                        {{--<div class="panel-body" style="background: black; color: white">--}}
                            {{--INFORMAITON Tooltips & popovers in button groups require special setting--}}
                            {{--When using tooltips or popovers on elements within a .btn-group, you'll have to specify the option container: 'body' to avoid unwanted side effects (such as the element growing wider and/or losing its rounded corners when the tooltip or popover is triggered).--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="row option-explain" style="margin-top: 20px; display: none">--}}
                    {{--<div class="panel panel-default" style="border: none; position: fixed">--}}
                        {{--<div class="panel-body" style="background: black; color: white">--}}
                            {{--OPTION Tooltips & popovers in button groups require special setting--}}
                            {{--When using tooltips or popovers on elements within a .btn-group, you'll have to specify the option container: 'body' to avoid unwanted side effects (such as the element growing wider and/or losing its rounded corners when the tooltip or popover is triggered).--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="row setting-explain" style="margin-top: 20px; display: none">--}}
                    {{--<div class="panel panel-default" style="border: none; position: fixed">--}}
                        {{--<div class="panel-body" style="background: black; color: white">--}}
                            {{--SETTING Tooltips & popovers in button groups require special setting--}}
                            {{--When using tooltips or popovers on elements within a .btn-group, you'll have to specify the option container: 'body' to avoid unwanted side effects (such as the element growing wider and/or losing its rounded corners when the tooltip or popover is triggered).--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="row participant-explain" style="margin-top: 20px; display: none">--}}
                    {{--<div class="panel panel-default" style="border: none; position: fixed">--}}
                        {{--<div class="panel-body" style="background: black; color: white">--}}
                            {{--PARTICIPANT Tooltips & popovers in button groups require special setting--}}
                            {{--When using tooltips or popovers on elements within a .btn-group, you'll have to specify the option container: 'body' to avoid unwanted side effects (such as the element growing wider and/or losing its rounded corners when the tooltip or popover is triggered).--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{ Form::close() }}
    </div>
@endsection
