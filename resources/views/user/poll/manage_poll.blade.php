@extends('layouts.app')

@section('content')
    <div class="hide"
        data-poll="{{ $data['jsonData'] }}"
        data-poll-id="{{ $poll->id }}" data-route="{{ url('user/poll') }}"
        data-link-exist="{{ trans('polls.link_exist') }}" data-link-invalid="{{ trans('polls.link_invalid') }}"
        data-edit-link-success="{{ trans('polls.edit_link_successfully') }}"
        data-link="{{ url('link') }}">
    </div>
    <div class="row">
        <div id="manager_poll_wizard" class="col-md-10 col-md-offset-1 well wrap-poll">
            <div class="navbar panel">
                <div class="navbar-inner">
                    <div class="col-md-10 col-md-offset-1 col-lg-12 panel-heading">
                        <ul>
                            <li><a href="#info" data-toggle="tab">{{ trans('polls.poll_info') }}</a></li>
                            <li><a href="#vote_detail" data-toggle="tab">{{ trans('polls.show_vote_details') }}</a></li>
                            <li><a href="#activity" data-toggle="tab">{{ trans('polls.activity_poll') }}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="tab-content">
                @include('layouts.message')
                <div class="tab-pane" id="info">
                    <h4>
                        {!! $poll->status !!}
                        <a href="{{ url('/') . config('settings.email.link_vote') . $tokenLinkUser }}" target="_blank" style="float: right">Link vote
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
                                            <h4>Tong luot binh chon <span class="badge">{{ $statistic['total'] }}</span></h4>
                                            <h4>Thoi gian binh chon dau tien <span class="label label-default">{{ $statistic['firstTime'] }}</span></h4>
                                            <h4>Thoi gian binh chon cuoi cung <span class="label label-default">{{ $statistic['lastTime'] }}</span></h4>
                                            <h4>Option co luot vote cao nhat
                                                @if (! empty($statistic['largestVote']['option']))
                                                    <button type="button" class="btn btn-primary">{{ $statistic['largestVote']['option']->name }}
                                                        <span class="badge">{{ $statistic['largestVote']['number'] }}</span>
                                                    </button>
                                                @endif
                                            </h4>
                                            <h4>Option co luot vote thap nhat
                                                @if (! empty($statistic['leastVote']['option']))
                                                    <button type="button" class="btn btn-primary">{{ $statistic['leastVote']['option']->name }}
                                                        <span class="badge">{{ $statistic['leastVote']['number'] }}</span>
                                                    </button>
                                                @endif
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="menu1">
                                    <div class="panel panel-default animated fadeInRight">
                                        <div class="panel-heading">
                                            TABLLE RESULT
                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal" style="float: right; font-size: 10px">
                                                <i class="fa fa-list" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                        <div class="panel-body">
                                            <table class="table table-hover table-responsive">
                                                <thead>
                                                    <tr>
                                                        <th>{{ trans('polls.no') }}</th>
                                                        <th>{{ trans('polls.label.option') }}</th>
                                                        <th>{{ trans('polls.number_vote') }}</th>
                                                        <th>{{ trans('polls.date_last_vote') }}</th>
                                                        <th>{{ trans('polls.poll_details') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($dataTableResult as $key => $data)
                                                        <tr>
                                                            <td>{{ $key }}</td>
                                                            <td>
                                                                <img src="{{ asset($data['image']) }}" width="50px" height="50px">
                                                                {{ $data['name'] }}
                                                            </td>
                                                            <td><span class="badge">{{ $data['numberOfVote'] }}</span></td>
                                                            <td>{{ $data['lastVoteDate'] }}</td>
                                                            <td>
                                                                <button type="button" class="btn btn-primary btn-xs">
                                                                    <i class="fa fa-asterisk" aria-hidden="true"></i>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="modal fade" id="myModal" role="dialog">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-body scroll-result">
                                                        @if ($mergedParticipantVotes->count())
                                                            <table class="table table-bordered">
                                                                <thead>
                                                                <th><center>{{ trans('polls.no') }}</center></th>
                                                                <th><center>{{ $isRequiredEmail ? trans('polls.email') : trans('polls.name')}}</center></th>
                                                                @foreach ($poll->options as $option)
                                                                    <th>
                                                                        <center>
                                                                            <img class="img-option" src="{{ $option->showImage() }}">
                                                                            <br>
                                                                            {{ $option->name }}
                                                                        </center>
                                                                    </th>
                                                                @endforeach
                                                                </thead>
                                                                <tbody>
                                                                @foreach ($mergedParticipantVotes as $vote)
                                                                    <tr>
                                                                        <td><center>{{ ++$numberOfVote }}</center></td>
                                                                        @php
                                                                            $isShowVoteName = false;
                                                                        @endphp
                                                                        @foreach ($poll->options as $option)
                                                                            @php
                                                                                $isShowOptionUserVote = false;
                                                                            @endphp
                                                                            @foreach ($vote as $item)
                                                                                @if (! $isShowVoteName)
                                                                                    <td>
                                                                                        @if (isset($item->user_id))
                                                                                            {{ Form::open(['route' => ['vote.destroy', $item->user->id], 'method' => 'delete']) }}
                                                                                            {{ $isRequiredEmail ? $item->user->email : $item->user->name }}
                                                                                        @else
                                                                                            {{ Form::open(['route' => ['vote.destroy', $item->participant->id], 'method' => 'delete']) }}
                                                                                            {{ $isRequiredEmail ? $item->participant->email : $item->participant->name }}
                                                                                        @endif
                                                                                        @if (Gate::allows('administer', $poll))
                                                                                            {{ Form::hidden('poll_id', $poll->id) }}
                                                                                        @endif
                                                                                        {{ Form::close() }}
                                                                                    </td>
                                                                                    @php
                                                                                        $isShowVoteName = true;
                                                                                    @endphp
                                                                                @endif
                                                                                @if ($item->option_id == $option->id)
                                                                                    <td>
                                                                                        <center><label class="label label-default"><span class="glyphicon glyphicon-ok"> </span></label></center>
                                                                                    </td>
                                                                                    @php
                                                                                        $isShowOptionUserVote = true;
                                                                                    @endphp
                                                                                @endif
                                                                            @endforeach
                                                                            @if (!$isShowOptionUserVote)
                                                                                <td></td>
                                                                            @endif
                                                                        @endforeach
                                                                    </tr>
                                                                @endforeach
                                                                </tbody>
                                                            </table>
                                                        @else
                                                            <div class="alert alert-info">
                                                                <p>{{ trans('polls.vote_empty') }}</p>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('polls.close') }}</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="menu2">
                                    <div class="panel panel-default animated fadeInRight">
                                        <div class="panel-heading">
                                            BAR CHART
                                        </div>
                                        <div class="panel-body">
                                            @if (collect($optionRateBarChart)->count())
                                                <script type="text/javascript" src="http://www.google.com/jsapi"></script>
                                                <script type="text/javascript">
                                                    google.load('visualization', '1', {'packages': ['columnchart']});
                                                    google.setOnLoadCallback (createChart);
                                                    function createChart() {
                                                        var dataTable = new google.visualization.DataTable();
                                                        dataTable.addColumn('string','Quarters 2009');
                                                        dataTable.addColumn('number', 'Earnings');
                                                        var optionRateBarChart = {!! $optionRateBarChart !!};
                                                        dataTable.addRows(optionRateBarChart);
                                                        var chart = new google.visualization.ColumnChart (document.getElementById('chart'));
                                                        var options = {width: 300, height: 440, is3D: false};
                                                        chart.draw(dataTable, options);
                                                    }
                                                </script>
                                                <div id="chart"></div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="menu3">
                                    <div class="panel panel-default animated fadeInRight">
                                        <div class="panel-heading">
                                            PIE CHART
                                        </div>
                                        <div class="panel-body">
                                            <!-- pie chart -->
                                            @if (collect($optionRateBarChart)->count())
                                                <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                                                <script type="text/javascript">
                                                    google.charts.load('current', {'packages':['corechart']});
                                                    google.charts.setOnLoadCallback(drawChart);
                                                    function drawChart() {
                                                        // Create the data table.
                                                        var data = new google.visualization.DataTable();
                                                        data.addColumn('string', 'Topping');
                                                        data.addColumn('number', 'Slices');
                                                        var optionRateBarChart = {!! $optionRateBarChart !!};
                                                        data.addRows(optionRateBarChart);
                                                        var options = {'width': 400, 'height': 400};
                                                        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
                                                        chart.draw(data, options);
                                                    }
                                                </script>
                                                <div id="chart_div"></div>
                                            @endif
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
                            <label id="label_link_admin">{{ url('/') . config('settings.email.link_vote') . $tokenLinkAdmin  }}</label>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon3">administrator</span>
                                    <input type="text" name="administer_link" class="form-control token-admin" value="{{ $tokenLinkAdmin }}" id="link_admin" onkeyup="changeLinkAdmin()">
                                    <span class="input-group-btn" data-token-link-admin="{{ $tokenLinkAdmin }}">
                                        {{ Form::button('<i class="fa fa-check" aria-hidden="true"></i>', ['class' => 'btn btn-success edit-link-admin']) }}
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="error_link_admin"></div>
                            </div>
                            <div class="form-group">
                                <label class="label label-info message-link-admin"></label>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label id="label_link_user">{{ url('/') . config('settings.email.link_vote') . $tokenLinkUser  }}</label>
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon3">vote</span>
                                <input type="text" name="participation_link" class="form-control token-user" value="{{ $tokenLinkUser }}" id="link_user"onkeyup="changeLinkUser()">
                                <span class="input-group-btn" data-token-link-user="{{ $tokenLinkUser }}">
                                    <button class="btn btn-success edit-link-user" type="button">
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
                        <div class="col-lg-6" style="float: left">
                            <p>
                                <a href="{{ URL::action('User\ActivityController@show', $poll->id) }}" class="btn btn-administration">
                                    <span class="fa fa-history"></span>
                                    {{ trans('polls.view_history') }}
                                </a>
                            </p>

                            @if (! $statistic['total'])
                                <p><a href="{{ route('user-poll.edit', $poll->id) }}" class="btn btn-administration">
                                        <span class="fa fa-pencil"></span> {{ trans('polls.tooltip.edit') }}
                                    </a></p>
                            @endif
                            <p>
                                <a href="{{ route('duplicate.show', $poll->id) }}" class="btn btn-administration">
                                    <span class="fa fa-files-o"></span> {{ trans('polls.tooltip.duplicate') }}
                                </a>
                            </p>

                            @if (! $poll->isClosed())
                                <p>
                                    {{ Form::open(['route' => ['poll.destroy', $poll->id], 'method' => 'delete']) }}
                                    {{
                                        Form::button('<span class="fa fa-times-circle"></span>' . ' ' . trans('polls.close_poll'), [
                                            'type' => 'submit',
                                            'class' => 'btn btn-administration',
                                            'onclick' => 'return confirm("' . trans('polls.confirm_close_poll') . '")'
                                        ])
                                    }}
                                    {{ Form::close() }}
                                </p>
                            @endif

                            @if ($poll->countParticipants())
                                <p>
                                    {!! Form::open(['route' => ['delete_all_participant', 'poll_id' => $poll->id]]) !!}
                                    {{
                                        Form::button('<span class="fa fa-trash-o"></span>' . ' ' . trans('polls.delete_all_participants'), [
                                            'type' => 'submit',
                                            'class' => 'btn btn-administration',
                                            'onclick' => 'return confirm("' . trans('polls.confirm_delete_all_participant') . '")'
                                        ])
                                    }}
                                    {{ Form::close() }}
                                </p>

                            @endif
                        </div>
                        <div class="col-lg-6">
                            <div class="btn-right">
                                {{ Form::open(['route' => ['exportPDF', 'poll_id' => $poll->id]]) }}
                                {{
                                    Form::button('<span class="glyphicon glyphicon-export"></span>' . ' ' . trans('polls.export_pdf'), [
                                        'type' => 'submit',
                                        'class' => 'btn btn-administration btn-right'
                                    ])
                                }}
                                {{ Form::close() }}
                            <p style="clear: both">
                            </p>
                                {{ Form::open(['route' => ['exportExcel', 'poll_id' => $poll->id]]) }}
                                {{
                                    Form::button('<span class="glyphicon glyphicon-export"></span>' . ' ' . trans('polls.export_excel'), [
                                        'type' => 'submit',
                                        'class' => 'btn btn-administration btn-right'
                                    ])
                                }}
                                {{ Form::close() }}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
