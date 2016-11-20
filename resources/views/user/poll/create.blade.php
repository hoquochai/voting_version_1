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
            <div id="create_poll_wizard" class="col-lg-8 col-lg-offset-2 well wrap-poll animated fadeInLeft">
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
                @include('layouts.error')
                @include('layouts.message')
                <div class="tab-content">
                    <div class="tab-pane" id="info">
                        <div class="panel" style="margin: 0; border-radius: 0;border-color: darkcyan">
                            <div class="panel-heading" style="background: darkcyan; border-color: darkcyan; border-radius: 0; color: white">
                                {{ strtoupper(trans('polls.label.step_1')) }}
                            </div>
                            <div class="panel-body">
                                @include('layouts.poll_info')
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="option">
                        <div class="panel" style="border-color: darkcyan; border-radius: 0">
                            <div class="panel-heading" style="background: darkcyan; color: white; border-radius: 0">
                                <div class="row">
                                    <div class="col-lg-4">
                                        {{ strtoupper(trans('polls.label.step_2')) }}
                                    </div>
                                    <div class="col-lg-2 col-lg-offset-6">
                                        <!-- BUTTON ADD OPTION -->
                                        <div class="addAdvance">
                                            <div class="input-group input-group-sm">
                                                {{
                                                    Form::number('number', null, [
                                                        'class' => 'form-control',
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
                                </div>



                            </div>
                            <div class="panel-body">
                                @include('layouts.poll_options')
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="setting">
                        <div class="panel" style="border-color: darkcyan; border-radius: 0">
                            <div class="panel-heading" style="background: darkcyan; color: white; border-radius: 0">
                                {{ strtoupper(trans('polls.label.step_3')) }}
                            </div>
                            <div class="panel-body">
                                @include('layouts.poll_setting')
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="participant">
                        <div class="panel" style="border-color: darkcyan; border-radius: 0">
                            <div class="panel-heading" style="background: darkcyan; color: white; border-radius: 0">
                                {{ strtoupper(trans('polls.label.step_4')) }}
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
            <div class="col-lg-2 " style="padding-right: 0; margin-top: 100px">
                    <div class="panel info-explain panel-default animated fadeInUp" style="border: none; position: fixed">
                        <div class="panel-body" style="background: black; color: white">
                            INFORMAITON Tooltips & popovers in button groups require special setting
                            When using tooltips or popovers on elements within a .btn-group, you'll have to specify the option container: 'body' to avoid unwanted side effects (such as the element growing wider and/or losing its rounded corners when the tooltip or popover is triggered).
                        </div>
                    </div>
                    <div class="panel panel-default option-explain animated fadeInUp" style="border: none; position: fixed">
                        <div class="panel-body" style="background: black; color: white">
                            OPTION Tooltips & popovers in button groups require special setting
                            When using tooltips or popovers on elements within a .btn-group, you'll have to specify the option container: 'body' to avoid unwanted side effects (such as the element growing wider and/or losing its rounded corners when the tooltip or popover is triggered).
                        </div>
                    </div>
                    <div class="panel panel-default setting-explain animated fadeInUp" style="border: none; position: fixed">
                        <div class="panel-body" style="background: black; color: white">
                            SETTING Tooltips & popovers in button groups require special setting
                            When using tooltips or popovers on elements within a .btn-group, you'll have to specify the option container: 'body' to avoid unwanted side effects (such as the element growing wider and/or losing its rounded corners when the tooltip or popover is triggered).
                        </div>
                    </div>
                    <div class="panel  participant-explain panel-default animated fadeInUp" style="border: none; position: fixed">
                        <div class="panel-body" style="background: black; color: white">
                            PARTICIPANT Tooltips & popovers in button groups require special setting
                            When using tooltips or popovers on elements within a .btn-group, you'll have to specify the option container: 'body' to avoid unwanted side effects (such as the element growing wider and/or losing its rounded corners when the tooltip or popover is triggered).
                        </div>
                    </div>
            </div>
        {{ Form::close() }}
    </div>
@endsection
