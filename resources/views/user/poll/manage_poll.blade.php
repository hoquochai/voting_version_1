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
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">{{ trans('polls.show_vote_details') }}</a>
                                        </h4>
                                    </div>
                                    <div id="collapse1" class="panel-collapse collapse in">
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
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">{{ trans('polls.activity_poll') }}</a>
                                        </h4>
                                    </div>
                                    <div id="collapse2" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <div class="col-lg-12">
                                                <div class="col-lg-4">
                                                    <a href="{{ URL::action('User\ActivityController@show', $poll->id) }}" class="btn btn-warning btn-block btn-administration">
                                                        <span class="fa fa-history"></span>
                                                        {{ trans('polls.view_history') }}
                                                    </a>
                                                </div>
                                                <div class="col-lg-4">
                                                    @if ($poll->countParticipants())
                                                        {!! Form::open(['route' => ['delete_all_participant', 'poll_id' => $poll->id]]) !!}
                                                        {{
                                                            Form::button('<span class="fa fa-trash-o"></span>' . ' ' . trans('polls.delete_all_participants'), [
                                                                'type' => 'submit',
                                                                'class' => 'btn btn-danger btn-block btn-administration',
                                                                'onclick' => 'return confirm("' . trans('polls.confirm_delete_all_participant') . '")'
                                                            ])
                                                        }}
                                                        {{ Form::close() }}
                                                    @else
                                                        <a class="btn btn-danger btn-administration btn-block disable-link">
                                                            <span class="fa fa-trash-o"></span>
                                                            {{ trans('polls.delete_all_participants') }}
                                                        </a>
                                                    @endif
                                                </div>
                                                <div class="col-lg-4">
                                                    {{ Form::open(['route' => ['poll.destroy', $poll->id], 'method' => 'delete']) }}
                                                    {{
                                                        Form::button('<span class="fa fa-times-circle"></span>' . ' ' . trans('polls.close_poll'), [
                                                            'type' => 'submit',
                                                            'class' => 'btn btn-primary btn-block btn-administration',
                                                            'onclick' => 'return confirm("' . trans('polls.confirm_close_poll') . '")'
                                                        ])
                                                    }}
                                                    {{ Form::close() }}
                                                </div>
                                            </div>
                                            <br><hr>
                                            <div class="col-lg-12 well">
                                                <div class="col-lg-2">
                                                    <a class="btn-link-user">
                                                        <i>{{ trans('polls.participation_link') }}</i>
                                                        <span class="glyphicon glyphicon-arrow-right "></span>
                                                    </a>
                                                </div>
                                                <div class="col-lg-7">
                                                    {{ Form::text('participation_link', $tokenLinkUser, ['class' => 'form-control token-user', 'placeholder' => trans('polls.placeholder.token_link')]) }}
                                                </div>
                                                <div class="col-lg-3" data-token-link-user="{{ $tokenLinkUser }}">
                                                    {{ Form::button(trans('polls.edit_link_user'), ['class' => 'btn btn-success edit-link-user']) }}
                                                    <label class="label label-default message-link-user"></label>
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
                                                    {{ Form::text('administer_link', $tokenLinkAdmin, ['class' => 'form-control token-admin', 'placeholder' => trans('polls.placeholder.token_link')]) }}
                                                </div>
                                                <div class="col-lg-3" data-token-link-admin="{{ $tokenLinkAdmin }}">
                                                    {{ Form::button(trans('polls.edit_link_admin'), ['class' => 'btn btn-success edit-link-admin']) }}
                                                    <label class="label label-default  message-link-admin"></label>
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                {{
                                                    Form::open([
                                                        'route' => ['user-poll.store', $poll->id],
                                                        'method' => 'PUT',
                                                        'id' => 'create-poll',
                                                        'enctype' => 'multipart/form-data',
                                                        'role' => 'form',
                                                    ])
                                                }}
                                                <div class="panel panel-default">
                                                    <div class="panel-heading">
                                                        <h3>{{ strtoupper(trans('polls.label.step_1')) }}</h3>
                                                    </div>
                                                    <div class="panel-body">

                                                        <!-- STATUS -->
                                                        <div class="form-group" id="type">
                                                            {{ Form::label(trans('polls.label_for.status'), trans('polls.label.status')) }}
                                                            <label class="radio-inline">
                                                                {{ Form::radio('status', config('settings.status.open'), ($poll->status == trans('polls.label.poll_opening')) ? true : null) }}
                                                                {{ trans('polls.label.opening') }}
                                                            </label>
                                                            <label class="radio-inline">
                                                                {{ Form::radio('status', config('settings.status.close'), ($poll->status == trans('polls.label.poll_closed')) ? true : null) }}
                                                                {{ trans('polls.label.closed') }}
                                                            </label>
                                                        </div>

                                                        <!-- TITLE -->
                                                        <div class="form-group">
                                                            {{ Form::label(trans('polls.label_for.title'), trans('polls.label.title')) }}
                                                            {{
                                                                Form::text('title', $poll->title, [
                                                                    'class' => 'form-control',
                                                                    'id' => 'title',
                                                                    'placeholder' => trans('polls.placeholder.title'),
                                                                ])
                                                            }}
                                                        </div>

                                                        <!-- LOCATION -->
                                                        <div class="form-group">
                                                            {{ Form::label(trans('polls.label_for.location'), trans('polls.label.location')) }}
                                                            {{
                                                                Form::text('location', $poll->location, [
                                                                    'class' => 'form-control',
                                                                    'id' => 'location',
                                                                    'placeholder' => trans('polls.placeholder.location'),
                                                                ])
                                                            }}
                                                        </div>

                                                        <!-- DESCRIPTION -->
                                                        <div class="form-group">
                                                            {{ Form::label(trans('polls.label_for.description'), trans('polls.label.description')) }}
                                                            {{
                                                                Form::textarea('description', $poll->description, [
                                                                    'class' => 'form-control',
                                                                    'id' => 'description',
                                                                    'placeholder' => trans('polls.placeholder.description'),
                                                                ])
                                                            }}
                                                        </div>

                                                        <!-- NAME -->
                                                        <div class="form-group">
                                                            {{ Form::label(trans('polls.label_for.full_name'), trans('polls.label.full_name')) }}
                                                            {{
                                                                Form::text('name', $poll->user->name, [
                                                                    'class' => 'form-control',
                                                                    'id' => 'name',
                                                                    'placeholder' => trans('polls.placeholder.full_name'),
                                                                ])
                                                            }}
                                                        </div>

                                                        <!-- EMAIL -->
                                                        <div class="form-group">
                                                            {{ Form::label(trans('polls.label_for.email'), trans('polls.label.email')) }}
                                                            {{
                                                                Form::text('email', $poll->user->email, [
                                                                    'class' => 'form-control',
                                                                    'id' => 'email',
                                                                    'placeholder' => trans('polls.placeholder.email'),
                                                                ])
                                                            }}
                                                            <div class="email-error"></div>
                                                        </div>

                                                        <!-- CHATWORK -->
                                                        <div class="form-group">
                                                            {{ Form::label(trans('polls.label_for.chatwork'), trans('polls.label.chatwork')) }}
                                                            {{
                                                                Form::text('chatwork_id', $poll->user->chatwork_id, [
                                                                    'class' => 'form-control',
                                                                    'id' => 'chatwork',
                                                                    'placeholder' => trans('polls.placeholder.chatwork'),
                                                                ])
                                                            }}
                                                        </div>

                                                        <!-- TYPE -->
                                                        <div class="form-group" id="type">
                                                            {{ Form::label(trans('polls.label_for.type'), trans('polls.label.type')) }}
                                                            <label class="radio-inline">
                                                                {{ Form::radio('type', config('settings.type.single_choice'), ($poll->multiple == trans('polls.label.single_choice')) ? true : null) }}
                                                                {{ trans('polls.label.single_choice') }}
                                                            </label>
                                                            <label class="radio-inline">
                                                                {{ Form::radio('type', config('settings.type.multiple_choice'), ($poll->multiple == trans('polls.label.multiple_choice')) ? true : null) }}
                                                                {{ trans('polls.label.multiple_choice') }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <ul class="list-inline pull-right">
                                                    <li>
                                                        {{
                                                            Form::submit(trans('polls.button.save_info'), [
                                                                'class' => 'btn btn-success',
                                                                'name' => 'btn_edit',
                                                            ])
                                                        }}

                                                    </li>
                                                </ul>
                                                {{ Form::close() }}
                                            </div>


                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">Collapsible Group 3</a>
                                        </h4>
                                    </div>
                                    <div id="collapse3" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            {{ Form::open(['route' => ['exportPDF', 'poll_id' => $poll->id]]) }}
                                            {{
                                                Form::button('<span class="glyphicon glyphicon-export"></span>' . ' ' . trans('polls.export_pdf'), [
                                                    'type' => 'submit',
                                                    'class' => 'btn btn-primary btn-administration'
                                                ])
                                            }}
                                            {{ Form::close() }}

                                            {{ Form::open(['route' => ['exportExcel', 'poll_id' => $poll->id]]) }}
                                            {{
                                                Form::button('<span class="glyphicon glyphicon-export"></span>' . ' ' . trans('polls.export_excel'), [
                                                    'type' => 'submit',
                                                    'class' => 'btn btn-primary btn-administration'
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
@endsection
