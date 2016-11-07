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
                <td>
                    <a href="{{ $poll->getUserLink() }}">
                        {{ $poll->title }}
                    </a>
                </td>
                <td>{{ $poll->countParticipants() }}</td>
                @if ($poll->activities->count())
                    <td>{{ $poll->activities->sortBy('id')->last()->created_at->diffForHumans() }}</td>
                @else
                    <td>{{ trans('polls.not_activity') }}</td>
                @endif
                @if (Gate::allows('ownerPoll', $poll))
                    <td>
                        <a href="{{ $poll->getAdminLink() }}">
                            {{ trans('polls.administer') }}
                        </a>
                    </td>
                @else
                    <td></td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>
