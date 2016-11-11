@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ trans('polls.poll_details') }}</div>
                    <div class="panel-body">
                        <div class="hide" data-poll-id="{{ $poll->id }}" data-route="{{ url('user/poll') }}"
                             data-link-exist="{{ trans('polls.link_exist') }}" data-link-invalid="{{ trans('polls.link_invalid') }}"
                             data-edit-link-success="{{ trans('polls.edit_link_successfully') }}"
                             data-link="{{ url('link') }}">
                        </div>
                        <div class="col-lg-12">
                            <div class="panel-group" id="accordion">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">Poll information</a>
                                        </h4>
                                    </div>
                                    <div id="collapse1" class="panel-collapse collapse in">
                                        <div class="panel-body">
                                            <div class="well well-lg">
                                                <h4>Title: {{ $poll->title }}</h4>
                                                <h4>User create: {{ $poll->user->name }} - {{ $poll->user->email }}</h4>
                                                <h4>Create at: {{ $poll->created_at }}</h4>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="col-lg-6">
                                                    <button class="btn btn-warning btn-block" id="show-option-detail" onclick="showOptionDetail()">OPTION</button>
                                                    <div class="well" id="option-detail">
                                                        @foreach ($poll->options as $option)
                                                            <div class="panel panel-default">
                                                                <div class="panel-heading">
                                                                    {{ str_limit($option->name, 15) }}
                                                                </div>
                                                                <div class="panel-body">
                                                                    <img src="{{ $option->showImage() }}" class="img-option">
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <div class="col-lg-5 col-lg-offset-1">
                                                    <button class="btn btn-success btn-block" onclick="showSettingDetail()">SETTING</button>
                                                    <div class="well" id="setting-detail">
                                                        @if (count($settingDetail))
                                                            @foreach ($settingDetail as $setting)
                                                                <div class="panel panel-default">
                                                                    <div class="panel-body">
                                                                        <p>
                                                                            {{ $setting['text'] . (($setting['value']) ? ": " . $setting['value'] : "") }}
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        @else
                                                            <div class="alert alert-info">
                                                                Haven't any setting with this poll.
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">{{ trans('polls.show_vote_details') }}</a>
                                        </h4>
                                    </div>
                                    <div id="collapse2" class="panel-collapse collapse">
                                        <div class="panel-body">
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
                                                                {{ str_limit($option->name, 15)}}
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
                                    </div>
                                </div>
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">{{ trans('polls.activity_poll') }}</a>
                                        </h4>
                                    </div>
                                    <div id="collapse3" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <div class="col-lg-12 well">
                                                <div class="col-lg-2">
                                                    <a class="btn-link-user">
                                                        <i>{{ trans('polls.participation_link') }}</i>
                                                        <span class="glyphicon glyphicon-arrow-right "></span>
                                                    </a>
                                                </div>
                                                <div class="col-lg-7">
                                                    <div class="input-group">
                                                        <span class="input-group-addon" id="basic-addon3">{{ url('/') . config('settings.email.link_vote') }}</span>
                                                        {{ Form::text('participation_link', $tokenLinkUser, ['class' => 'form-control token-user', 'placeholder' => trans('polls.placeholder.token_link')]) }}
                                                    </div>
                                                    <label class="label label-info message-link-user"></label>
                                                </div>
                                                <div class="col-lg-3" data-token-link-user="{{ $tokenLinkUser }}">
                                                    {{ Form::button(trans('polls.edit_link_user'), ['class' => 'btn btn-success edit-link-user']) }}
                                                </div>
                                            </div>
                                            <div class="col-lg-12 well">
                                                <div class="col-lg-2">
                                                    <a class="btn-link-admin">
                                                        <i>{{ trans('polls.administer_link') }}</i>
                                                        <span class="glyphicon glyphicon-arrow-right btn-link-admin"></span>
                                                    </a>
                                                </div>
                                                <div class="col-lg-7">
                                                    <div class="input-group">
                                                        <span class="input-group-addon" id="basic-addon3">{{ url('/') . config('settings.email.link_vote') }}</span>
                                                        {{ Form::text('administer_link', $tokenLinkAdmin, ['class' => 'form-control token-admin', 'placeholder' => trans('polls.placeholder.token_link')]) }}
                                                    </div>
                                                    <label class="label label-info message-link-admin"></label>
                                                </div>
                                                <div class="col-lg-3" data-token-link-admin="{{ $tokenLinkAdmin }}">
                                                    {{ Form::button(trans('polls.edit_link_admin'), ['class' => 'btn btn-success edit-link-admin']) }}
                                                </div>
                                            </div>
                                            <div class="col-lg-12 alert alert-success">
                                                <div class="col-lg-3">
                                                    <div class="row activity-poll">
                                                        <a href="{{ URL::action('User\ActivityController@show', $poll->id) }}" class="btn btn-default btn-block btn-administration">
                                                            <span class="fa fa-history"></span>
                                                            {{ trans('polls.view_history') }}
                                                        </a>
                                                    </div>
                                                    <div class="row activity-poll">
                                                        <button class="btn btn-default btn btn-block btn-administration">
                                                            <span class="fa fa-pencil"></span> Edit poll
                                                        </button>
                                                    </div>
                                                    <div class="row activity-poll">
                                                        <a href="{{ route('duplicate.show', $poll->id) }}">
                                                            <button class="btn btn-default btn btn-block btn-administration">
                                                                <span class="fa fa-files-o"></span> Duplication
                                                            </button>
                                                        </a>
                                                    </div>
                                                    <div class="row activity-poll">
                                                        {{ Form::open(['route' => ['poll.destroy', $poll->id], 'method' => 'delete']) }}
                                                        {{
                                                            Form::button('<span class="fa fa-times-circle"></span>' . ' ' . trans('polls.close_poll'), [
                                                                'type' => 'submit',
                                                                'class' => 'btn btn-default btn-block btn-administration',
                                                                'onclick' => 'return confirm("' . trans('polls.confirm_close_poll') . '")'
                                                            ])
                                                        }}
                                                        {{ Form::close() }}
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-lg-offset-1">
                                                    <div class="row activity-poll">
                                                        @if ($poll->countParticipants())
                                                            {!! Form::open(['route' => ['delete_all_participant', 'poll_id' => $poll->id]]) !!}
                                                            {{
                                                                Form::button('<span class="fa fa-trash-o"></span>' . ' ' . trans('polls.delete_all_participants'), [
                                                                    'type' => 'submit',
                                                                    'class' => 'btn btn-default btn-block btn-administration',
                                                                    'onclick' => 'return confirm("' . trans('polls.confirm_delete_all_participant') . '")'
                                                                ])
                                                            }}
                                                            {{ Form::close() }}
                                                        @else
                                                            <a class="btn btn-default btn-administration btn-block disable-link">
                                                                <span class="fa fa-trash-o"></span>
                                                                {{ trans('polls.delete_all_participants') }}
                                                            </a>
                                                        @endif
                                                    </div>
                                                    <div class="row activity-poll">
                                                        <button class="btn btn-default btn-block">
                                                            <span class="fa fa-comments"></span> Delete all comments
                                                        </button>
                                                    </div>
                                                    <div class="row activity-poll">
                                                        <button class="btn btn-default btn-block">
                                                            <span class="fa fa-bar-chart"></span> Delete this poll
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-lg-offset-1">
                                                    <div class="row activity-poll">
                                                        {{ Form::open(['route' => ['exportPDF', 'poll_id' => $poll->id]]) }}
                                                        {{
                                                            Form::button('<span class="glyphicon glyphicon-export"></span>' . ' ' . trans('polls.export_pdf'), [
                                                                'type' => 'submit',
                                                                'class' => 'btn btn-default btn-block btn-administration'
                                                            ])
                                                        }}
                                                        {{ Form::close() }}
                                                    </div>
                                                    <div class="row activity-poll">
                                                        {{ Form::open(['route' => ['exportExcel', 'poll_id' => $poll->id]]) }}
                                                        {{
                                                            Form::button('<span class="glyphicon glyphicon-export"></span>' . ' ' . trans('polls.export_excel'), [
                                                                'type' => 'submit',
                                                                'class' => 'btn btn-default btn-block btn-administration'
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
