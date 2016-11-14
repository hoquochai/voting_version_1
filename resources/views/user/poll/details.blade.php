@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading"><h3>{{ trans('polls.poll_details') }}</h3></div>
            <div class="hide-password" data-link-password="{{ url('user/set-password') }}" data-poll-id="{{ $poll->id }}" data-required-password="{{ $requiredPassword }}" data-message-required-password="{{ trans('polls.incorrect_password') }}"></div>
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

            <div class="panel-body details-poll">
                <div class="container">
                    <ul class="nav nav-pills">
                        <li class="active"><a data-toggle="tab" href="#home">{{ trans('polls.nav_tab_edit.voting') }}</a></li>
                        <li><a data-toggle="tab" href="#menu1">{{ trans('polls.nav_tab_edit.info') }}</a></li>
                        <li><a data-toggle="tab" href="#menu2">{{ trans('polls.nav_tab_edit.result') }}</a></li>
                    </ul>
                </div>
                <div class="panel panel-primary panel-content">
                    <div class="panel-heading">
                        <h4 class="title">{{ $poll->title }} {!! $poll->showStatus() !!} </h4>
                        @if ($isLimit)
                            Poll limit
                        @endif
                    </div>
                    <div class="panel-body">
                            <div class="row">
                                <div class="tab-content">
                                    <div id="home" class="tab-pane fade in active">

                                        <!-----------------------------------------------
                                          -                 VOTE                      -
                                          ----------------------------------------------->
                                        @include('message')
                                        <div class="col-md-2">
                                            @if (auth()->check() && ! $isUserVoted || ! auth()->check() && ! $isParticipantVoted)
                                                @if (count($optionCombobox) > 3)
                                                    <div class="form-group selection-option">
                                                        {{ Form::select('selection_option_combobox', $optionCombobox, null, ['class' => 'form-control', 'onChange' => 'selectOption(this)']) }}
                                                    </div>
                                                @endif
                                            @endif
                                        </div>
                                        <div class="col-md-8">
                                            {!! Form::open(['route' => 'vote.store','id' => 'form-vote']) !!}
                                            @foreach ($poll->options as $option)
                                                <div class="panel panel-default panel-poll" id="{{ $option->id }}">
                                                    <div class="panel-body">
                                                        <div class="row">
                                                            <div class="col-md-1">
                                                                <span class="badge">{{ $loop->index + 1 }}</span>
                                                            </div>
                                                            <div class="col-md-1">
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
                                                            <div class="col-md-10">
                                                                <div class="col-md-8">
                                                                    {!! Form::label('option_name', ($option->name ? $option->name : " "), ['class' => 'poll-option']) !!}
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <img class="poll-option img-option" src="{{ $option->showImage() }}" onclick="showModelImage('{{ $option->showImage() }}')">

                                                                </div>
                                                                <div class="col-md-1">
                                                                    @if (!$isHideResult || Gate::allows('administer', $poll))
                                                                        <h1><span class="label label-default dropbtn">{{ $option->countVotes() }}</span></h1>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach

                                            <!-- Modal -->
                                            <div id="modalImageOption" class="modal fade" role="dialog">
                                                <div class="modal-dialog">

                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                        <img src="#" id="imageOfOptionPreview">
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            @if ((auth()->check() && ! $isUserVoted || !auth()->check() && ! $isParticipantVoted) && ! $isLimit && ! $poll->isClosed())
                                                <div class="col-md-10" id="vote-info">
                                                    {!! Form::hidden('poll_id', $poll->id) !!}
                                                    {!! Form::hidden('isRequiredEmail', $isRequiredEmail) !!}
                                                    @if (!$isRequiredEmail)
                                                        <div class="col-md-10">
                                                            {!! Form::text('input', auth()->check() ? auth()->user()->name : null, ['class' => 'form-control input', 'placeholder' => trans('polls.placeholder.enter_name')]) !!}
                                                        </div>
                                                        <div class="col-md-2" data-message-name="{{ trans('polls.message_name') }}">
                                                            {{ Form::button(trans('polls.vote'), ['class' => 'btn btn-success btn-vote-name', !$isUserVoted ? 'disabled' : '' ]) }}
                                                        </div>
                                                    @else
                                                        <div class="col-md-10">
                                                            {!! Form::email('input', auth()->check() ? auth()->user()->email : null, ['class' => 'form-control input', 'placeholder' => trans('polls.placeholder.email')]) !!}
                                                        </div>
                                                        <div class="col-md-2" data-message-email="{{ trans('polls.message_email') }}" data-url="{{ url('/check-email') }}" data-message-exist-email="{{ trans('polls.message_exist_email') }}" data-message-validate-email="{{ trans('polls.message_validate_email') }}">
                                                            {{ Form::button(trans('polls.vote'), ['class' => 'btn btn-success btn-vote-email', !$isUserVoted ? 'disabled' : '']) }}
                                                        </div>
                                                    @endif
                                                    <div class="col-md-12">
                                                        @if ($isUserVoted)
                                                            <label class="show-message">{{ trans('polls.voted_poll') }}</label>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label class="message-validation"></label>
                                                    </div>
                                                </div>
                                            @endif
                                            {!! Form::close() !!}
                                        </div>
                                        <div class="col-lg-2">
                                            @if (auth()->check() && ! $isUserVoted || ! auth()->check() && ! $isParticipantVoted)
                                                @if (count($optionCombobox) > 3)
                                                    <div id="vote-layout">
                                                        <button class="btn btn-primary" onclick="goVoteInfor()"><span class="glyphicon glyphicon-stats"></span></button>
                                                        <button class="btn btn-primary" onclick="goComment()"><span class="glyphicon glyphicon-comment"></span></button>
                                                    </div>
                                                @endif
                                            @endif
                                        </div>

                                        <!-----------------------------------------------
                                          -                 COMMENT                      -
                                          ----------------------------------------------->
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
                                                                <div class="col-md-1">
                                                                    @if (isset($comment->user) && ($comment->name == $comment->user->name))
                                                                        <img class="img-comment" src="{{ $comment->user->getAvatarPath() }}">
                                                                    @else
                                                                        <img class="img-comment" src="{{ $comment->showDefaultAvatar() }}">
                                                                    @endif
                                                                </div>
                                                                <div class="col-md-11">
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
                                                        {!! Form::close() !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="menu1" class="tab-pane fade">
                                        <div class="col-lg-8 col-lg-offset-2">
                                            @if (isset($poll->user))
                                                <h4>
                                                    {{ trans('polls.poll_initiate') }}
                                                    @include('user.poll.user_details_layouts', ['user' => $poll->user])
                                                </h4>
                                            @endif
                                            <p class="poll-count">
                                                <span class="label label-primary glyphicon glyphicon-user poll-details">
                                                    {{ $mergedParticipantVotes->count() }}
                                                </span>
                                                    <span class="label label-info glyphicon glyphicon-comment poll-details">
                                                    <span class="comment-count">{{ $poll->countComments() }}</span>
                                                </span>
                                                    <span class="label label-success glyphicon glyphicon-time poll-details">
                                                    {{ $poll->created_at->diffForHumans() }}
                                                </span>
                                            </p>
                                            <div class="well well-lg"><i>{{ ($poll->description) ? $poll->description : trans('polls.description') }}</i></div>
                                            <h5> <i class="fa fa-map-marker"></i> {{ trans('polls.where') }}
                                                <span>{{ ($poll->location) ? $poll->location : trans('polls.location') }}</span></h5>

                                        </div>
                                        @if (Gate::allows('administer', $poll))
                                            <div class="col-lg-12">
                                                <div class="col-lg-4 col-lg-offset-4">
                                                    <a class="btn btn-primary btn-administration btn-block" href="{{ $poll->getAdminLink() }}">
                                                        <span class="glyphicon glyphicon-cog"></span>
                                                        {{ trans('polls.administration') }}
                                                    </a>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    <div id="menu2" class="tab-pane fade">
                                        @if (!$isHideResult || Gate::allows('administer', $poll))
                                            <div class="col-lg-12">
                                                <button type="button" class="btn btn-primary btn-model" data-toggle="modal" data-target="#myModal">
                                                    <span class="glyphicon glyphicon-eye-open"></span>
                                                    {{ trans('polls.show_vote_details') }}
                                                </button>
                                            </div>
                                            <div class="col-lg-12">
                                                <!-- bar chart -->
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
                                            <div class="col-lg-12">

                                                <!-- pie chart for this poll -->
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
                                                                <center>
                                                                    <p>{{ trans('polls.vote_empty') }}</p>
                                                                </center>
                                                            @endif
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('polls.close') }}</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @else
                                            <div class="col-lg-10 col-lg-offset-1 alert alert-danger">
                                                {{ trans('polls.hide_result_message') }}
                                            </div>
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
</div>
@endsection
