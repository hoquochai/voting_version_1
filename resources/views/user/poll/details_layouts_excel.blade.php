<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
    <h4> {{ $poll->title }} </h4>
    <label> {{ trans('polls.poll_initiate') }} {{ $poll->user->name }}</label>
    <i>
        </span>
            {{ $poll->created_at->diffForHumans() }}
        </span>
    </i>
    <br>
    @if (! is_null($poll->location))
        <label> {{trans('polls.where')}}: </label>
        <span>{{ $poll->location }}</span>
        <br>
    @endif
    @if (! is_null($poll->description))
        <i> {{ trans('polls.label.description') }}:
            {{ $poll->description }}
        </i>
    @endif
    <br><br>
    @if ($votes->count())
    <table class="table table-bordered">
    <thead>
    <tr>
        <th><center>{{ $isRequiredEmail ? trans('polls.email') : trans('polls.name')}}</center></th>
        @foreach ($poll->options as $option)
            <th>
                <center>
                    {{ $option->name }}
                </center>
            </th>
        @endforeach
    </tr>
    </thead>
    <tbody>
        @foreach ($votes as $vote)
        <tr>
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
                            <center>
                                @if (isset($item->user_id))
                                    {{ $isRequiredEmail ? $item->user->email : $item->user->name }}
                                @else
                                    {{ $isRequiredEmail ? $item->participant->email : $item->participant->name }}
                                @endif
                            </center>
                        </td>
                        @php
                            $isShowVoteName = true;
                        @endphp
                    @endif
                    @if ($item->option_id == $option->id)
                        <td>
                            <center>x</center>
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
    <br><br>
    <table class="table table-bordered">
    <thead>
    <tr>
        <th>{{ trans('polls.option.name_vote') }}</th>
        <th>{{ trans('polls.option.count_vote') }}</th>
        <th>{{ trans('polls.option.rate_vote') }}</th>
    </tr>
    </thead>
    <tbody>
        @foreach ($optionRate as $option)
            <tr>
                <td><center>{{ $option['name'] }}</center></td>
                <td><center>{{ $option['count'] }}</center></td>
                <td>
                    <center>
                        {{ $option['rate'] }}
                        %
                    </td>
                    </center>
            </tr>
        @endforeach
    </tbody>
    </table>
    @else
        <center>
            <p>{{ trans('polls.vote_empty') }}</p>
        </center>
    @endif
</body>
</html>
