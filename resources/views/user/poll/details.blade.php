@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('polls.poll_details') }}</div>
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
                @include('message')
                    <h4> {{ $poll->title }} </h4>
                    @if (isset($poll->user))
                        {{ trans('polls.poll_initiate') }}
                        @include('user.poll.user_details_layouts', ['user' => $poll->user])
                    @endif
                    <p>
                        <i>
                            <span class="label label-primary glyphicon glyphicon-user poll-details">
                                {{ $mergedParticipantVotes->count() }}
                            </span>
                            <span class="label label-info glyphicon glyphicon-comment poll-details">
                                <span class="comment-count">{{ $poll->countComments() }}</span>
                            </span>
                            <span class="label label-success glyphicon glyphicon-time poll-details">
                                {{ $poll->created_at->diffForHumans() }}
                            </span>
                        </i>
                    </p>
                    <label> {{trans('polls.where')}} </label>
                    <span>{{ $poll->location }}</span>
                    <br>
                    <i> {{ $poll->description }} </i>
                    <br><br>
                    @if (Gate::allows('administer', $poll))
                        <a class="btn btn-primary btn-administration" href="{{ $poll->getAdminLink() }}">
                            <span class="glyphicon glyphicon-cog"></span>
                            {{ trans('polls.administration') }}
                        </a>
                    @endif
                    @if (auth()->check())
                        <a class="btn btn-primary btn-administration" href="{{ URL::action('User\ActivityController@show', $poll->id) }}">
                            <span class="glyphicon glyphicon-star-empty"></span>
                            {{ trans('polls.view_history') }}
                        </a>
                    @endif
                    <a class="btn btn-primary btn-administration" href="{{ URL::action('PollController@edit', $poll->id) }}">
                        <span class="glyphicon glyphicon-copy"></span>
                            {{ trans('polls.create_duplicate_poll') }}
                    </a>
                    @if (!$isHideResult || Gate::allows('administer', $poll))
                    <button type="button" class="btn btn-primary btn-model" data-toggle="modal" data-target="#myModal">
                        <span class="glyphicon glyphicon-eye-open"></span>
                        {{ trans('polls.show_vote_details') }}
                    </button>
                        <div class="modal fade" id="myModal" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-body">
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
                    @endif
                    <div class="col-md-12">
                        {!! Form::open(['route' => 'vote.store']) !!}
                            @foreach ($poll->options as $option)
                                <div class="col-md-1">
                                    @if (auth()->check() && ! $isUserVoted || ! auth()->check() && ! $isParticipantVoted)
                                        <center>
                                            @if ($poll->multiple)
                                                {!! Form::checkbox('option[]', $option->id, false, ['class' => 'poll-option']) !!}
                                            @else
                                                {!! Form::radio('option[]', $option->id, false, ['class' => 'poll-option']) !!}
                                            @endif
                                        </center>
                                    @endif
                                </div>
                                <div class="col-md-11">
                                    <div class="col-md-9">
                                        {!! Form::label('option_name', $option->name, ['class' => 'poll-option']) !!}
                                    </div>
                                    <div class="col-md-2">
                                        <img class="poll-option img-option" src="{{ $option->showImage() }}">
                                    </div>
                                    <div class="col-md-1">
                                        @if (!$isHideResult || Gate::allows('administer', $poll))
                                            <h1><span class="label label-default dropbtn">{{ $option->countVotes() }}</span></h1>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                            <br>
                            @if (auth()->check() && ! $isUserVoted || !auth()->check() && ! $isParticipantVoted)
                                <div class="col-md-10">
                                    <div class="col-md-8">
                                        <div class="col-md-12">
                                            <label class="message-validate"> </label>
                                        </div>
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
                                            <div class="col-md-2" data-message-email="{{ trans('polls.message_email') }}" data-message-validate-email="{{ trans('polls.message_validate_email') }}">
                                                {{ Form::button(trans('polls.vote'), ['class' => 'btn btn-success btn-vote-email', !$isUserVoted ? 'disabled' : '']) }}
                                            </div>
                                        @endif
                                        <div class="col-md-12">
                                            @if ($isUserVoted)
                                                <label class="show-message">{{ trans('polls.voted_poll') }}</label>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif
                        {!! Form::close() !!}
                    </div>
                    <div class="col-md-12">
                        <h4> <span class="comment-count">{{ $poll->countComments() }} </span> {{ trans('polls.comments') }} </h4>
                        <div class="col-md-12" data-label-show-comment = "{{ trans('polls.show_comments') }}" data-label-hide="{{ trans('polls.hide') }}">
                            <button class="btn btn-warning show" id="show-hide-list-comment">{{ trans('polls.hide') }}</button>
                        </div>
                        <br><br>
                        <div class="hide" data-route="{{ url('user/comment') }}" data-confirm-remove="{{ trans('polls.confirmRemove') }}">
                        </div>
                        <div class="comments">
                            @foreach ($poll->comments as $comment)
                                <div class="col-md-12" id="{{ $comment->id }}">
                                    <br>
                                    <div class="col-md-1">
                                        @if ($comment->name == $comment->user->name)
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
                        <div class="col-md-12 comment" data-label-add-comment = "{{ trans('polls.add_comment') }}" data-label-hide="{{ trans('polls.hide') }}">
                            <div class="col-md-12">
                                <div>
                                    <label class="message-validate comment-name-validate"> </label>
                                </div>
                                <div>
                                    <label class="message-validate comment-content-validate"></label>
                                </div>
                            </div>
                            <button class="btn btn-warning show" id="add-comment">{{ trans('polls.hide') }}</button>
                            {!! Form::open(['route' => 'comment.store', 'class' => 'form-horizontal', 'id' => 'form-comment']) !!}
                                <div class="col-md-4 comment">
                                {!! Form::text('name', auth()->check() ? auth()->user()->name : null, ['class' => 'form-control', 'id' => 'name' . $poll->id, 'placeholder' => trans('polls.placeholder.full_name')]) !!}
                                </div>
                                <div class="col-md-10 comment" data-poll-id="{{ $poll->id }}" data-user="{{ auth()->check() ? auth()->user()->name : '' }}" data-comment-name="{{ trans('polls.comment_name') }}" data-comment-content="{{ trans('polls.comment_content') }}">
                                    {!! Form::textarea('content', null, ['class' => 'form-control', 'rows' => config('settings.poll.comment_row'), 'placeholder' => trans('polls.placeholder.comment'), 'id' => 'content' . $poll->id]) !!}
                                    {{ Form::button(trans('polls.save_comment'), ['type' => 'submit', 'class' => 'btn btn-primary addComment']) }}
                                </div>
                            {!! Form::close() !!}
                        </div>
                    </div>

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

                                    var options = {width: 300, height: 440, is3D: false};

                                    chart.draw(dataTable, options);
                                }
                            </script>
                            <div id="chart"></div>
                        @endif



                       <!-- pie chart for this poll -->
                        @if (collect($optionRatePieChart)->count())
                            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                            <script>
                                google.charts.load("current", {packages:["corechart"]});
                                google.charts.setOnLoadCallback(drawChart);

                                function drawChart() {
                                var record={!! json_encode($optionRatePieChart) !!};
                                console.log(record);

                                // Create our data table.
                                var data = new google.visualization.DataTable();
                                data.addColumn('string', 'Source');
                                data.addColumn('number', 'Total_Signup');

                                for(var k in record){
                                    var v = record[k];

                                    data.addRow([k,v]);
                                    console.log(v);
                                }

                                var options = {
                                  is3D: true,
                                };
                                var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
                                chart.draw(data, options);
                                }
                            </script>
                                <div id="piechart_3d"></div>
                        @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
