@extends('layouts.app')

@section('content')
    <div class="row">
        <div id="manager_poll_wizard" class="col-lg-6 col-lg-offset-3 well wrap-poll">
            <div class="navbar panel">
                <div class="navbar-inner">
                    <div class="col-lg-10 col-lg-offset-1 panel-heading">
                        <ul>
                            <li><a href="#info" data-toggle="tab">{{ trans('polls.poll_info') }}</a></li>
                            <li><a href="#vote_detail" data-toggle="tab">{{ trans('polls.show_vote_details') }}</a></li>
                            <li><a href="#activity" data-toggle="tab">{{ trans('polls.activity_poll') }}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="tab-content">
                <div class="tab-pane" id="info">
                    <h4>
                        {!! $poll->status !!}
                        <a href="{{ url('/') . config('settings.email.link_vote') . $tokenLinkUser }}" style="float: right">Link vote
                        </a>
                    </h4>
                    @include('layouts.poll_info')
                </div>
                <div class="tab-pane" id="vote_detail">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <ul class="nav nav-pills nav-stacked">
                                        <li class="active"><a data-toggle="tab" href="#home">
                                                <i class="fa fa-calculator" aria-hidden="true"></i>
                                            </a></li>
                                        <li><a data-toggle="tab" href="#menu1">
                                                <i class="fa fa-table" aria-hidden="true"></i>
                                            </a></li>
                                        <li><a data-toggle="tab" href="#menu2">
                                                <i class="fa fa-bar-chart" aria-hidden="true"></i>
                                            </a></li>
                                        <li><a data-toggle="tab" href="#menu3">
                                                <i class="fa fa-pie-chart" aria-hidden="true"></i>
                                            </a></li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-10">
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="home">
                                    <div class="panel panel-default animated fadeInRight">
                                        <div class="panel-heading">
                                            STATISTIC
                                        </div>
                                        <div class="panel-body">
                                            <h4>Tong luot binh chon <span class="badge">15</span></h4>
                                            <h4>Thoi gian binh chon dau tien <span class="label label-default">11-10-2016 11:10</span></h4>
                                            <h4>Thoi gian binh chon cuoi cung <span class="label label-default">11-11-2016 11:10</span></h4>
                                            <h4>Option co luot vote cao nhat
                                                <button type="button" class="btn btn-primary">Option 1 <span class="badge">7</span></button>
                                            </h4>
                                            <h4>Option co luot vote thap nhat <button type="button" class="btn btn-primary">Option 2 <span class="badge">5</span></button>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="menu1">
                                    <div class="panel panel-default animated fadeInRight">
                                        <div class="panel-heading">
                                            TABLLE RESULT
                                            <button type="button" class="btn btn-danger" style="float: right; font-size: 10px">
                                                <i class="fa fa-list" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                        <div class="panel-body">
                                            <table class="table table-hover table-responsive">
                                                <thead>
                                                <tr>
                                                    <th>STT</th>
                                                    <th>Option</th>
                                                    <th>Vote</th>
                                                    <th>Date laste vote</th>
                                                    <th>Detail</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td>
                                                        1
                                                    </td>
                                                    <td>
                                                        <p style="word-wrap: break-word; width: 10em">dkasdkahsdashdhasjdkashkdhakjshdkjashdkjashdkas</p>
                                                    </td>
                                                    <td>
                                                        <span class="badge">13</span>
                                                    </td>
                                                    <td>
                                                        11-11-2016 11:50
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-primary btn-xs">
                                                            <i class="fa fa-asterisk" aria-hidden="true"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        2
                                                    </td>
                                                    <td>
                                                        <p style="word-wrap: break-word; width: 10em">dkasdkahsdashdhasjdkashkdhakjshdkjashdkjashdkasasdsadjashdjksahdkashdkjsahdjks</p>
                                                        <img src="{{ asset('uploads/images/polleverywhere1.png') }}" alt="" width="50px" height="50px">
                                                    </td>
                                                    <td>
                                                        <span class="badge">7</span>
                                                    </td>
                                                    <td>
                                                        11-11-2016 11:50
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-primary btn-xs">
                                                            <i class="fa fa-asterisk" aria-hidden="true"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        3
                                                    </td>
                                                    <td>
                                                        <img src="{{ asset('uploads/images/polleverywhere1.png') }}" alt="" width="50px" height="50px">
                                                    </td>
                                                    <td>
                                                        <span class="badge">5</span>
                                                    </td>
                                                    <td>
                                                        11-11-2016 11:50
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-primary btn-xs">
                                                            <i class="fa fa-asterisk" aria-hidden="true"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="menu2">
                                    <div class="panel panel-default animated fadeInRight">
                                        <div class="panel-heading">
                                            BAR CHART
                                        </div>
                                        <div class="panel-body">

                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="menu3">
                                    <div class="panel panel-default animated fadeInRight">
                                        <div class="panel-heading">
                                            PIE CHART
                                        </div>
                                        <div class="panel-body">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix visible-lg"></div>
                    </div>
                </div>
                <div class="tab-pane" id="activity">
                    <div class="row">
                        <div class="col-lg-6">
                            <label>{{ url('/') . config('settings.email.link_vote') . 'asjdhkjashdksakd'  }}</label>
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon3">administrator</span>
                                <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                                <span class="input-group-btn">
                                <button class="btn btn-secondary" type="button">
                                    <i class="fa fa-check" aria-hidden="true"></i>
                                </button>
                            </span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label>{{ url('/') . config('settings.email.link_vote') . 'asjdhkjashdksakd'  }}</label>
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon3">vote</span>
                                <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                                <span class="input-group-btn">
                                <button class="btn btn-secondary" type="button">
                                    <i class="fa fa-check" aria-hidden="true"></i>
                                </button>
                            </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <hr style="border: 1px solid darkcyan">
                    </div>
                    <div class="row">
                        <div class="col-lg-4" style="text-align: center">
                            <h4><a href="#">View history of poll</a></h4>
                            <h4><a href="#">Edit this poll</a></h4>
                            <h4><a href="#">Duplicate poll</a></h4>
                            <h4><a href="#">Close poll</a></h4>
                        </div>
                        <div class="col-lg-4" style="text-align: center">
                            <h4><a href="#">Delete all participants</a></h4>
                            <h4><a href="#">Delete all comment</a></h4>
                            <h4><a href="#">Delete this poll</a></h4>
                        </div>
                        <div class="col-lg-4" style="text-align: center">
                            <h4><a href="#">Export result to PDF</a></h4>
                            <h4><a href="#">Export result to Excel</a></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{--<div class="row">--}}
            {{--<div class="col-md-12">--}}
                {{--<div class="panel panel-default">--}}
                    {{--<div class="panel-heading">{{ trans('polls.poll_details') }}</div>--}}
                    {{--<div class="panel-body">--}}
                        {{--<div class="hide" data-poll-id="{{ $poll->id }}" data-route="{{ url('user/poll') }}"--}}
                             {{--data-link-exist="{{ trans('polls.link_exist') }}" data-link-invalid="{{ trans('polls.link_invalid') }}"--}}
                             {{--data-edit-link-success="{{ trans('polls.edit_link_successfully') }}"--}}
                             {{--data-link="{{ url('link') }}">--}}
                        {{--</div>--}}
                        {{--<div class="col-lg-12">--}}
                            {{--<div class="panel-group" id="accordion">--}}
                                {{--<div class="panel panel-primary">--}}
                                    {{--<div class="panel-heading" data-toggle="collapse" data-target="#collapse1" data-parent="#accordion">--}}
                                        {{--<h4 class="panel-title">--}}
                                           {{--{{ trans('polls.poll_info') }}--}}
                                        {{--</h4>--}}
                                    {{--</div>--}}
                                    {{--<div id="collapse1" class="panel-collapse collapse in">--}}
                                        {{--<div class="panel-body">--}}
                                            {{--<div class="well well-lg">--}}
                                                {{--<h4>{{ trans('polls.table.thead.title') . " : " . $poll->title }}</h4>--}}
                                                {{--<h4>{{ trans('polls.table.thead.creator') . " : " . $poll->user->name . "-" . $poll->user->email }}</h4>--}}
                                                {{--<h4>{{ trans('polls.table.thead.created_at') . " : " . $poll->created_at }}</h4>--}}
                                            {{--</div>--}}
                                            {{--<div class="col-lg-12">--}}
                                                {{--<div class="col-lg-6">--}}
                                                    {{--<button class="btn btn-warning btn-block" id="show-option-detail" onclick="showOptionDetail()">--}}
                                                        {{--{{ trans('polls.nav_tab_edit.option') }}--}}
                                                    {{--</button>--}}
                                                    {{--<div class="well" id="option-detail">--}}
                                                        {{--@foreach ($poll->options as $option)--}}
                                                            {{--<div class="panel panel-default">--}}
                                                                {{--<div class="panel-heading">--}}
                                                                    {{--{{ $option->name }}--}}
                                                                {{--</div>--}}
                                                                {{--<div class="panel-body">--}}
                                                                    {{--<img src="{{ $option->showImage() }}" class="img-option">--}}
                                                                {{--</div>--}}
                                                            {{--</div>--}}
                                                        {{--@endforeach--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                                {{--<div class="col-lg-5 col-lg-offset-1">--}}
                                                    {{--<button class="btn btn-success btn-block" onclick="showSettingDetail()">--}}
                                                        {{--{{ trans('polls.nav_tab_edit.setting') }}--}}
                                                    {{--</button>--}}
                                                    {{--<div class="well" id="setting-detail">--}}
                                                        {{--@if (count($settingDetail))--}}
                                                            {{--@foreach ($settingDetail as $setting)--}}
                                                                {{--<div class="panel panel-default">--}}
                                                                    {{--<div class="panel-body">--}}
                                                                        {{--<p>--}}
                                                                            {{--{{ $setting['text'] . (($setting['value']) ? ": " . $setting['value'] : "") }}--}}
                                                                        {{--</p>--}}
                                                                    {{--</div>--}}
                                                                {{--</div>--}}
                                                            {{--@endforeach--}}
                                                        {{--@else--}}
                                                            {{--<div class="alert alert-info">--}}
                                                                {{--{{ trans('polls.message.no_setting') }}--}}
                                                            {{--</div>--}}
                                                        {{--@endif--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="panel panel-primary">--}}
                                    {{--<div class="panel-heading" data-toggle="collapse" data-target="#collapse2" data-parent="#accordion">--}}
                                        {{--<h4 class="panel-title">--}}
                                            {{--{{ trans('polls.show_vote_details') }}--}}
                                        {{--</h4>--}}
                                    {{--</div>--}}
                                    {{--<div id="collapse2" class="panel-collapse collapse scroll-result">--}}
                                        {{--<div class="panel-body">--}}
                                            {{--@if ($mergedParticipantVotes->count())--}}
                                                {{--<table class="table table-bordered">--}}
                                                    {{--<thead>--}}
                                                    {{--<th><center>{{ trans('polls.no') }}</center></th>--}}
                                                    {{--<th><center>{{ $isRequiredEmail ? trans('polls.email') : trans('polls.name')}}</center></th>--}}
                                                    {{--@foreach ($poll->options as $option)--}}
                                                        {{--<th>--}}
                                                            {{--<center>--}}
                                                                {{--<img class="img-option" src="{{ $option->showImage() }}">--}}
                                                                {{--<br>--}}
                                                                {{--{{ str_limit($option->name, 15)}}--}}
                                                            {{--</center>--}}
                                                        {{--</th>--}}
                                                    {{--@endforeach--}}
                                                    {{--</thead>--}}
                                                    {{--<tbody>--}}
                                                    {{--@foreach ($mergedParticipantVotes as $vote)--}}
                                                        {{--<tr>--}}
                                                            {{--<td><center>{{ ++$numberOfVote }}</center></td>--}}
                                                            {{--@php--}}
                                                                {{--$isShowVoteName = false;--}}
                                                            {{--@endphp--}}
                                                            {{--@foreach ($poll->options as $option)--}}
                                                                {{--@php--}}
                                                                    {{--$isShowOptionUserVote = false;--}}
                                                                {{--@endphp--}}
                                                                {{--@foreach ($vote as $item)--}}
                                                                    {{--@if (! $isShowVoteName)--}}
                                                                        {{--<td>--}}
                                                                            {{--@if (isset($item->user_id))--}}
                                                                                {{--{{ Form::open(['route' => ['vote.destroy', $item->user->id], 'method' => 'delete']) }}--}}
                                                                                {{--{{ $isRequiredEmail ? $item->user->email : $item->user->name }}--}}
                                                                            {{--@else--}}
                                                                                {{--{{ Form::open(['route' => ['vote.destroy', $item->participant->id], 'method' => 'delete']) }}--}}
                                                                                {{--{{ $isRequiredEmail ? $item->participant->email : $item->participant->name }}--}}
                                                                            {{--@endif--}}
                                                                            {{--@if (Gate::allows('administer', $poll))--}}
                                                                                {{--{{ Form::hidden('poll_id', $poll->id) }}--}}
                                                                            {{--@endif--}}
                                                                            {{--{{ Form::close() }}--}}
                                                                        {{--</td>--}}
                                                                        {{--@php--}}
                                                                            {{--$isShowVoteName = true;--}}
                                                                        {{--@endphp--}}
                                                                    {{--@endif--}}
                                                                    {{--@if ($item->option_id == $option->id)--}}
                                                                        {{--<td>--}}
                                                                            {{--<center><label class="label label-default"><span class="glyphicon glyphicon-ok"> </span></label></center>--}}
                                                                        {{--</td>--}}
                                                                        {{--@php--}}
                                                                            {{--$isShowOptionUserVote = true;--}}
                                                                        {{--@endphp--}}
                                                                    {{--@endif--}}
                                                                {{--@endforeach--}}
                                                                {{--@if (!$isShowOptionUserVote)--}}
                                                                    {{--<td></td>--}}
                                                                {{--@endif--}}
                                                            {{--@endforeach--}}
                                                        {{--</tr>--}}
                                                    {{--@endforeach--}}
                                                    {{--</tbody>--}}
                                                {{--</table>--}}
                                            {{--@else--}}
                                                {{--<center>--}}
                                                    {{--<p>{{ trans('polls.vote_empty') }}</p>--}}
                                                {{--</center>--}}
                                            {{--@endif--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="panel panel-primary">--}}
                                    {{--<div class="panel-heading">--}}
                                        {{--<h4 class="panel-title" data-toggle="collapse" data-target="#collapse3" data-parent="#accordion">--}}
                                            {{--{{ trans('polls.activity_poll') }}--}}
                                        {{--</h4>--}}
                                    {{--</div>--}}
                                    {{--<div id="collapse3" class="panel-collapse collapse">--}}
                                        {{--<div class="panel-body">--}}
                                            {{--<div class="col-lg-12 well">--}}
                                                {{--<div class="col-lg-2">--}}
                                                    {{--<a class="btn-link-user">--}}
{{--                                                        <i>{{ trans('polls.participation_link') }}</i>--}}
                                                        {{--<span class="glyphicon glyphicon-arrow-right "></span>--}}
                                                    {{--</a>--}}
                                                {{--</div>--}}
                                                {{--<div class="col-lg-7">--}}
                                                    {{--<div class="input-group">--}}
                                                        {{--<span class="input-group-addon" id="basic-addon3">{{ url('/') . config('settings.email.link_vote') }}</span>--}}
                                                        {{--{{ Form::text('participation_link', $tokenLinkUser, ['class' => 'form-control token-user', 'placeholder' => trans('polls.placeholder.token_link')]) }}--}}
                                                    {{--</div>--}}
                                                    {{--<label class="label label-info message-link-user"></label>--}}
                                                {{--</div>--}}
                                                {{--<div class="col-lg-3" data-token-link-user="{{ $tokenLinkUser }}">--}}
                                                    {{--{{ Form::button(trans('polls.edit_link_user'), ['class' => 'btn btn-success edit-link-user']) }}--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                            {{--<div class="col-lg-12 well">--}}
                                                {{--<div class="col-lg-2">--}}
                                                    {{--<a class="btn-link-admin">--}}
                                                        {{--<i>{{ trans('polls.administer_link') }}</i>--}}
                                                        {{--<span class="glyphicon glyphicon-arrow-right btn-link-admin"></span>--}}
                                                    {{--</a>--}}
                                                {{--</div>--}}
                                                {{--<div class="col-lg-7">--}}
                                                    {{--<div class="input-group">--}}
                                                        {{--<span class="input-group-addon" id="basic-addon3">{{ url('/') . config('settings.email.link_vote') }}</span>--}}
                                                        {{--{{ Form::text('administer_link', $tokenLinkAdmin, ['class' => 'form-control token-admin', 'placeholder' => trans('polls.placeholder.token_link')]) }}--}}
                                                    {{--</div>--}}
                                                    {{--<label class="label label-info message-link-admin"></label>--}}
                                                {{--</div>--}}
                                                {{--<div class="col-lg-3" data-token-link-admin="{{ $tokenLinkAdmin }}">--}}
                                                    {{--{{ Form::button(trans('polls.edit_link_admin'), ['class' => 'btn btn-success edit-link-admin']) }}--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                            {{--<div class="col-lg-12 alert alert-success">--}}
                                                {{--<div class="col-lg-3">--}}
                                                    {{--<div class="row activity-poll">--}}
                                                        {{--<a href="{{ URL::action('User\ActivityController@show', $poll->id) }}" class="btn btn-default btn-block btn-administration">--}}
                                                            {{--<span class="fa fa-history"></span>--}}
                                                            {{--{{ trans('polls.view_history') }}--}}
                                                        {{--</a>--}}
                                                    {{--</div>--}}
                                                    {{--<div class="row activity-poll">--}}
                                                        {{--<a href="{{ route('user-poll.edit', $poll->id) }}" class="btn btn-default btn btn-block btn-administration">--}}
                                                            {{--<span class="fa fa-pencil"></span> {{ trans('polls.tooltip.edit') }}--}}
                                                        {{--</a>--}}
                                                    {{--</div>--}}
                                                    {{--<div class="row activity-poll">--}}
                                                        {{--<a href="{{ route('duplicate.show', $poll->id) }}" class="btn btn-default btn btn-block btn-administration">--}}
                                                            {{--<span class="fa fa-files-o"></span> {{ trans('polls.tooltip.duplicate') }}--}}
                                                        {{--</a>--}}
                                                    {{--</div>--}}
                                                    {{--<div class="row activity-poll">--}}
                                                        {{--@if (! $poll->isClosed())--}}
                                                            {{--{{ Form::open(['route' => ['poll.destroy', $poll->id], 'method' => 'delete']) }}--}}
                                                            {{--{{--}}
                                                                {{--Form::button('<span class="fa fa-times-circle"></span>' . ' ' . trans('polls.close_poll'), [--}}
                                                                    {{--'type' => 'submit',--}}
                                                                    {{--'class' => 'btn btn-default btn-block btn-administration',--}}
                                                                    {{--'onclick' => 'return confirm("' . trans('polls.confirm_close_poll') . '")'--}}
                                                                {{--])--}}
                                                            {{--}}--}}
                                                            {{--{{ Form::close() }}--}}
                                                        {{--@endif--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                                {{--<div class="col-lg-4 col-lg-offset-1">--}}
                                                    {{--<div class="row activity-poll">--}}
                                                        {{--@if ($poll->countParticipants())--}}
                                                            {{--{!! Form::open(['route' => ['delete_all_participant', 'poll_id' => $poll->id]]) !!}--}}
                                                            {{--{{--}}
                                                                {{--Form::button('<span class="fa fa-trash-o"></span>' . ' ' . trans('polls.delete_all_participants'), [--}}
                                                                    {{--'type' => 'submit',--}}
                                                                    {{--'class' => 'btn btn-default btn-block btn-administration',--}}
                                                                    {{--'onclick' => 'return confirm("' . trans('polls.confirm_delete_all_participant') . '")'--}}
                                                                {{--])--}}
                                                            {{--}}--}}
                                                            {{--{{ Form::close() }}--}}
                                                        {{--@endif--}}
                                                    {{--</div>--}}
                                                    {{--<div class="row activity-poll">--}}
                                                        {{--<button class="btn btn-default btn-block">--}}
                                                            {{--<span class="fa fa-comments"></span> {{ trans('polls.tooltip.delete_comment') }}--}}
                                                        {{--</button>--}}
                                                    {{--</div>--}}
                                                    {{--<div class="row activity-poll">--}}
                                                        {{--<button class="btn btn-default btn-block">--}}
                                                            {{--<span class="fa fa-bar-chart"></span> {{ trans('polls.tooltip.delete') }}--}}
                                                        {{--</button>--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                                {{--<div class="col-lg-3 col-lg-offset-1">--}}
                                                    {{--<div class="row activity-poll">--}}
                                                        {{--{{ Form::open(['route' => ['exportPDF', 'poll_id' => $poll->id]]) }}--}}
                                                        {{--{{--}}
                                                            {{--Form::button('<span class="glyphicon glyphicon-export"></span>' . ' ' . trans('polls.export_pdf'), [--}}
                                                                {{--'type' => 'submit',--}}
                                                                {{--'class' => 'btn btn-default btn-block btn-administration'--}}
                                                            {{--])--}}
                                                        {{--}}--}}
                                                        {{--{{ Form::close() }}--}}
                                                    {{--</div>--}}
                                                    {{--<div class="row activity-poll">--}}
                                                        {{--{{ Form::open(['route' => ['exportExcel', 'poll_id' => $poll->id]]) }}--}}
                                                        {{--{{--}}
                                                            {{--Form::button('<span class="glyphicon glyphicon-export"></span>' . ' ' . trans('polls.export_excel'), [--}}
                                                                {{--'type' => 'submit',--}}
                                                                {{--'class' => 'btn btn-default btn-block btn-administration'--}}
                                                            {{--])--}}
                                                        {{--}}--}}
                                                        {{--{{ Form::close() }}--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}

                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    </div>
@endsection
