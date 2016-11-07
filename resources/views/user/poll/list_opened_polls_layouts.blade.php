<table class="table table-bordered">
    <thead>
        <th>{{ trans('polls.subject') }}</th>
        <th>{{ trans('polls.participants') }}</th>
        <th>{{ trans('polls.latest_activity') }}</th>
        <th></th>
    </thead>
    <tbody>
    @foreach ($polls as $poll)
        <tr>
            <td>{{ $poll->title }}</td>
            <td>{{ $poll->countParticipants() }}</td>
            @if ($poll->activities->count())
                <td>{{ $poll->activities->sortBy('id')->last()->created_at->diffForHumans() }}</td>
            @else
                <td></td>
            @endif
            @if (Gate::allows('ownerPoll', $poll))
                <td>
                    <a class="btn btn-success" href="{{ URL::action('User\PollController@edit', ['id' => $poll->id]) }}">
                        {{ trans('polls.reopen_poll') }}
                    </a>
                </td>
            @endif
        </tr>
    @endforeach
    </tbody>
</table>
