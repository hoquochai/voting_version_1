@extends('layouts.app')

@section('content')
<div class="container">
    @if ($requiredPassword)
        <div class="modal-dialog-password">
            @include('message')
            <div class="modal-content-password">
                <div class="modal-header-password">
                    <center>
                        <h2 class="modal-title">{{ trans('polls.enter_password') }}</h2>
                    </center>
                </div>
                <br>
                <div class="modal-bodymodal-dialog-password">
                    <fieldset>
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-3">
                                <label class="col-md-2 control-label" for="labelInput">{{ trans('label.password') }}</label>
                                <label class="label label-danger message-required-password message-validate"></label>
                                <div class="col-md-6">
                                    {{ Form::text('password', null, ['class' => 'form-control password']) }}
                                    <p></p>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
    @endif
    <div id="voting_wizard" class="col-lg-6 col-lg-offset-3 well wrap-poll">
        <div class="navbar panel">
            <div class="navbar-inner">
                <div class="col-lg-8 col-lg-offset-2 panel-heading">
                    <ul>
                        <li><a href="#vote" data-toggle="tab">{{ trans('polls.nav_tab_edit.voting') }}</a></li>
                        <li><a href="#info" data-toggle="tab">{{ trans('polls.nav_tab_edit.info') }}</a></li>
                        <li><a href="#result" data-toggle="tab">{{ trans('polls.nav_tab_edit.result') }}</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="tab-content">
            <div class="tab-pane" id="vote">
                {!! Form::open(['route' => 'vote.store','id' => 'form-vote']) !!}
<!-- VOTE INFO -->
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="col-lg-12">
                                <div class="input-group">
                                    @if ((auth()->check() && ! $isUserVoted || !auth()->check() && ! $isParticipantVoted) && ! $isLimit && ! $poll->isClosed())
                                        {!! Form::hidden('poll_id', $poll->id) !!}
                                        {!! Form::hidden('isRequiredEmail', $isRequiredEmail) !!}
                                        @if (!$isRequiredEmail)
                                            <span class="input-group-addon" id="basic-addon1">
                                                <i class="fa fa-user" aria-hidden="true"></i>
                                            </span>
                                            {!! Form::text('input', auth()->check() ? auth()->user()->name : null, ['class' => 'form-control input', 'placeholder' => trans('polls.placeholder.enter_name')]) !!}
                                            <span class="input-group-btn" data-message-name="{{ trans('polls.message_name') }}">
                                                {{ Form::button(trans('polls.vote'), ['class' => 'btn btn-success btn-vote-name', !$isUserVoted ? 'disabled' : '' ]) }}
                                            </span>
                                        @else
                                            <span class="input-group-addon" id="basic-addon1">
                                                <i class="fa fa-user" aria-hidden="true"></i>
                                            </span>
                                            {!! Form::email('input', auth()->check() ? auth()->user()->email : null, ['class' => 'form-control input', 'placeholder' => trans('polls.placeholder.email')]) !!}
                                            <span class="input-group-btn" data-message-email="{{ trans('polls.message_email') }}" data-url="{{ url('/check-email') }}" data-message-exist-email="{{ trans('polls.message_exist_email') }}" data-message-validate-email="{{ trans('polls.message_validate_email') }}">
                                                {{ Form::button(trans('polls.vote'), ['class' => 'btn btn-success btn-vote-email', !$isUserVoted ? 'disabled' : '']) }}
                                            </span>
                                        @endif
                                    @endif
                                </div>
                                <label class="message-validation"></label>
                                @if ($isUserVoted)
                                    <label class="show-message">{{ trans('polls.voted_poll') }}</label>
                                @endif
                            </div>
                        </div>
                    </div>

<!-- VOTE OPTION -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <ul class="nav nav-pills">
                                <li class="active">
                                    <a data-toggle="tab" href="#vertical">
                                        <i class="fa fa-th" aria-hidden="true"></i>
                                    </a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#horizontal">
                                        <i class="fa fa-bars" aria-hidden="true"></i>
                                    </a>
                                </li>

                            </ul>
                        </div>
                        <div class="panel-body">
                            <div class="tab-content">
<!-- VOTE OPTION VERTICAL-->
                                <div id="vertical" class="tab-pane fade in active">
                                    <div class="col-lg-12">
                                        @foreach ($poll->options as $option)
                                            <div class="col-lg-4">
                                                <div class="panel panel-default" id="{{ $option->id }}">
                                                    <div class="panel-body">
                                                        <label style="word-wrap: break-word">{{ $option->name ? $option->name : " " }}</label>
                                                        <img class="img-responsive" src="{{ $option->showImage() }}" onclick="showModelImage('{{ $option->showImage() }}')">
                                                    </div>
                                                    <div class="panel-footer">
                                                        @if ((auth()->check() && ! $isUserVoted || !auth()->check() && ! $isParticipantVoted) && ! $isLimit && ! $poll->isClosed())
                                                            <center>
                                                                @if ($poll->multiple == trans('polls.label.multiple_choice'))
                                                                    {!! Form::checkbox('option[]', $option->id, false, ['class' => 'poll-option', 'onClick' => 'voted("' . $option->id  .'")', 'id' => 'option-' . $option->id]) !!}
                                                                @else
                                                                    {!! Form::radio('option[]', $option->id, false, ['class' => 'poll-option', 'onClick' => 'voted("' . $option->id  .'")', 'id' => 'option-' . $option->id]) !!}
                                                                @endif
                                                            </center>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
<!-- VOTE OPTION HORIZONTAL-->
                                <div id="horizontal" class="tab-pane fade">
                                    <div class="col-lg-12">
                                        @foreach ($poll->options as $option)
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <label>
                                                        @if ((auth()->check() && ! $isUserVoted || !auth()->check() && ! $isParticipantVoted) && ! $isLimit && ! $poll->isClosed())
                                                            <center>
                                                                @if ($poll->multiple == trans('polls.label.multiple_choice'))
                                                                    {!! Form::checkbox('option[]', $option->id, false, ['class' => 'poll-option', 'onClick' => 'voted("' . $option->id  .'")', 'id' => 'option-' . $option->id]) !!} {{ $option->name ? $option->name : " " }}
                                                                @else
                                                                    {!! Form::radio('option[]', $option->id, false, ['class' => 'poll-option', 'onClick' => 'voted("' . $option->id  .'")', 'id' => 'option-' . $option->id]) !!} {{ $option->name ? $option->name : " " }}
                                                                @endif
                                                            </center>
                                                        @endif
                                                    </label>
                                                    <button class="btn btn-success" type="button" style="float: right" onclick="showPanelImage('{{ $option->id }}')">
                                                        <i class="fa fa-picture-o" aria-hidden="true"></i>
                                                    </button>
                                                </div>
                                                <div class="panel-body" id="option_{{ $option->id }}" style="display: none">
                                                    <img class="img-responsive" src="{{ $option->showImage() }}" onclick="showModelImage('{{ $option->showImage() }}')">
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
<!-- MODAL VIEW IMAGE-->
                    <div id="modalImageOption" class="modal fade" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Image Preview</h4>
                                </div>
                                <div class="modal-body">
                                    <img src="#" id="imageOfOptionPreview">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>

                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
            <div class="tab-pane" id="info">
<!-- POLL INFO -->
                <div class="col-lg-12">
                    <label style="word-wrap: break-word">
                        {{ $poll->title }}
                        <span><a href="#" data-placement="right" data-toggle="tooltip" title="{{ $poll->description }}">
                                <i class="fa fa-info-circle" aria-hidden="true"></i></a>
                        </span>
                    </label>
                    <span>
                        <i class="fa fa-user" aria-hidden="true"></i>
                        @include('user.poll.user_details_layouts', ['user' => $poll->user])
                    </span>
                    <span style="float: right; cursor: pointer" data-placement="top" data-toggle="tooltip" title="{{ $poll->location }}">
                        <i class="fa fa-map-marker" aria-hidden="true"></i> {{ str_limit($poll->location, 20) }}
                    </span>
                </div>
                <div class="col-lg-12">
                    <hr style="border: 1px solid white">
                </div>
<!-- COMMENT -->
                <div class="col-md-12" id="panel-comment">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4> <span class="comment-count">{{ $poll->countComments() }} </span> {{ trans('polls.comments') }}
                                <span data-label-show-comment = "{{ trans('polls.show_comments') }}" data-label-hide="{{ trans('polls.hide') }}">
                                    <button class="btn btn-warning show" id="show-hide-list-comment">{{ trans('polls.hide') }}</button>
                                </span>
                            </h4>
                        </div>
                        <div class="panel-body">
                            <div class="hide" data-route="{{ url('user/comment') }}" data-confirm-remove="{{ trans('polls.confirmRemove') }}">
                            </div>
                            <div class="comments">
                                @foreach ($poll->comments as $comment)
                                    <div class="col-md-12" id="{{ $comment->id }}">
                                        <br>
                                        <div class="col-md-2">
                                            @if (isset($comment->user) && ($comment->name == $comment->user->name))
                                                <img class="img-comment" src="{{ $comment->user->getAvatarPath() }}">
                                            @else
                                                <img class="img-comment" src="{{ $comment->showDefaultAvatar() }}">
                                            @endif
                                        </div>
                                        <div class="col-md-10">
                                            <label data-comment-id="{{ $comment->id }}" data-poll-id="{{ $poll->id }}">
                                                <label class="user-comment">{{ $comment->name }}</label>
                                                {{ $comment->created_at->diffForHumans() }}
                                                @if (Gate::allows('ownerPoll', $poll))
                                                    <span class="glyphicon glyphicon-trash delete-comment"></span>
                                                @endif
                                            </label>
                                            <br>
                                            {{ $comment->content }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="col-lg-12">
                                <hr style="border: 1px solid darkcyan">
                            </div>
                            <div class="col-lg-12 comment" data-label-add-comment = "{{ trans('polls.add_comment') }}" data-label-hide="{{ trans('polls.hide') }}">
                                <button class="btn btn-warning show" id="add-comment">{{ trans('polls.hide') }}</button>
                                {!! Form::open(['route' => 'comment.store', 'class' => 'form-horizontal', 'id' => 'form-comment']) !!}
                                <div class="col-md-4 comment">
                                    {!! Form::text('name', auth()->check() ? auth()->user()->name : null, ['class' => 'form-control', 'id' => 'name' . $poll->id, 'placeholder' => trans('polls.placeholder.full_name')]) !!}
                                </div>
                                <div class="col-md-10 comment" data-poll-id="{{ $poll->id }}" data-user="{{ auth()->check() ? auth()->user()->name : '' }}" data-comment-name="{{ trans('polls.comment_name') }}" data-comment-content="{{ trans('polls.comment_content') }}">
                                    {!! Form::textarea('content', null, ['class' => 'form-control', 'rows' => config('settings.poll.comment_row'), 'placeholder' => trans('polls.placeholder.comment'), 'id' => 'content' . $poll->id]) !!}
                                    <div>
                                        <label class="message-validate comment-name-validate"> </label>
                                    </div>
                                    <div>
                                        <label class="message-validate comment-content-validate"></label>
                                    </div>
                                    {{ Form::button(trans('polls.save_comment'), ['type' => 'submit', 'class' => 'btn btn-primary addComment']) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<!-- POLL RESULT -->
            <div class="tab-pane" id="result">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <ul class="nav nav-pills">
                            <li class="active">
                                <a data-toggle="tab" href="#table">
                                    <i class="fa fa-table" aria-hidden="true"></i>
                                </a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#barChart">
                                    <i class="fa fa-bar-chart" aria-hidden="true"></i>
                                </a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#pieChart">
                                    <i class="fa fa-pie-chart" aria-hidden="true"></i>
                                </a>
                            </li>

                        </ul>
                    </div>
                    <div class="panel-body">
                        <div class="tab-content">
<!-- TABLE RESULT -->
                            <div id="table" class="tab-pane fade in active">
                                <table class="table table-hover table-responsive">
                                    <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Option</th>
                                        <th>Vote</th>
                                        <th>Date laste vote</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($dataTableResult as $key => $data)
                                        <tr>
                                            <td>{{ $key }}</td>
                                            <td>
                                                {{ $data['name'] }}
                                                <img src="{{ asset($data['image']) }}" width="50px" height="50px">
                                            </td>
                                            <td>{{ $data['numberOfVote'] }}</td>
                                            <td>{{ $data['lastVoteDate'] }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
<!-- BAR CHART RESULT -->
                            <div id="barChart" class="tab-pane fade in active">
                                <div class="col-lg-12">
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
                                                var optionCharts = {
                                                    width: 1000, height: 500, is3D: true
                                                };
                                                chart.draw(dataTable, optionCharts);
                                            }
                                        </script>
                                        <div id="chart"></div>
                                    @endif
                                </div>
                            </div>
<!-- PIE CHART RESULT -->
                            <div id="pieChart" class="tab-pane fade in active">
                                <div class="col-lg-12">
                                    @if (collect($optionRatePieChart)->count())
                                        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                                        <script>
                                            google.charts.load("current", {packages:["corechart"]});
                                            google.charts.setOnLoadCallback(drawChart);

                                            function drawChart() {
                                                var record={!! json_encode($optionRatePieChart) !!};

                                                // Create our data table.
                                                var data = new google.visualization.DataTable();
                                                data.addColumn('string', 'Source');
                                                data.addColumn('number', 'Total_Signup');

                                                for(var k in record){
                                                    var v = record[k];

                                                    data.addRow([k,v]);
                                                }

                                                var optionPies = {
                                                    width: 1000,
                                                    height: 500,
                                                    is3D: true,
                                                };
                                                var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
                                                chart.draw(data, optionPies);
                                            }
                                        </script>
                                        <div id="piechart_3d"></div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
