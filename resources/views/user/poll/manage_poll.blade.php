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
                    <div class="col-md-12">
                        {{ Form::open(['route' => ['poll.destroy', $poll->id], 'method' => 'delete']) }}
                            {{
                                Form::button('<span class="glyphicon glyphicon-remove-sign"></span>' . ' ' . trans('polls.close_poll'), [
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-administration',
                                    'onclick' => 'return confirm("' . trans('polls.confirm_close_poll') . '")'
                                ])
                            }}
                        {{ Form::close() }}
                        @if ($poll->countParticipants())
                            {!! Form::open(['route' => ['delete_all_participant', 'poll_id' => $poll->id]]) !!}
                                {{
                                    Form::button('<span class="glyphicon glyphicon-remove-sign"></span>' . ' ' . trans('polls.delete_all_participants'), [
                                        'type' => 'submit',
                                        'class' => 'btn btn-danger btn-administration',
                                        'onclick' => 'return confirm("' . trans('polls.confirm_delete_all_participant') . '")'
                                    ])
                                }}
                            {{ Form::close() }}
                        @else
                            <a class="btn btn-danger btn-administration disable-link">
                                <span class="glyphicon glyphicon-remove-sign"></span>
                                {{ trans('polls.delete_all_participants') }}
                            </a>
                        @endif
                        <a href="{{ URL::action('User\ActivityController@show', $poll->id) }}" class="btn btn-primary  btn-administration">
                            <span class="glyphicon glyphicon-star-empty"></span>
                            {{ trans('polls.view_history') }}
                        </a>
                         <button type="button" class="btn btn-primary btn-model btn-administration" data-toggle="modal" data-target="#myModal">
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
                        <br><br><br>
                        <div class="col-md-12">
                            <div class="col-md-2">
                            <a class="btn-link-user">
                                <i>{{ trans('polls.participation_link') }}</i>
                                <span class="glyphicon glyphicon-arrow-right "></span>
                            </a>
                            </div>
                            <div class="col-md-3">
                                {{ Form::text('participation_link', $tokenLinkUser, ['class' => 'form-control token-user', 'placeholder' => trans('polls.placeholder.token_link')]) }}
                            </div>
                            <div class="col-md-7" data-token-link-user="{{ $tokenLinkUser }}">
                                {{ Form::button(trans('polls.edit_link_user'), ['class' => 'btn btn-success edit-link-user']) }}
                                <label class="label label-default message-link-user"></label>
                            </div>
                        </div>
                        <br><br><br>
                        <div class="col-md-12">
                            <div class="col-md-2">
                                <a class="btn-link-admin">
                                    <i>{{ trans('polls.administer_link') }}</i>
                                    <span class="glyphicon glyphicon-arrow-right btn-link-admin"></span>
                                </a>
                            </div>
                            <div class="col-md-3">
                                {{ Form::text('administer_link', $tokenLinkAdmin, ['class' => 'form-control token-admin', 'placeholder' => trans('polls.placeholder.token_link')]) }}
                            </div>
                            <div class="col-md-7" data-token-link-admin="{{ $tokenLinkAdmin }}">
                                {{ Form::button(trans('polls.edit_link_admin'), ['class' => 'btn btn-success edit-link-admin']) }}
                                <label class="label label-default  message-link-admin"></label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
