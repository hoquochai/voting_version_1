<!DOCTYPE html>
<html>
<head>
    <title>{{ trans('label.mail.create_poll.title') }}</title>
    <style>
        .content {
            background: darkcyan;
            padding: 50px;
        }
        .vote {
            display: block;
            margin: 50px auto;
            background: white;
            max-width: 500px;
            padding: 15px;
            box-shadow: 5px 5px 2px black;
        }
        .vote .heding {
            text-align: center;
        }
        .vote .body {
            padding:15px;
        }
        .link-invite {
            background: green;
            color: white;
            display: block;
            width: 200px;
            text-align: center;
            margin: 0 auto;

        }
        .hr-heading-body {
            width: 200px;
            border: 1px solid black;
        }
        .password {
            background: darkcyan;
            color: white;
            padding: 5px;
        }
        .box-info {
            border-width: 5px;
            border-style: double;
            padding: 10px;
        }
        .box-info .head {
            text-align: center;
        }
        .end {
            text-align: center;
        }
    </style>
</head>
<body>
<div class="content">
    <div class="vote">
        <div class="heding">
            <h2><b>{{ trans('label.mail.create_poll.head') }}</b></h2>
        </div>
        <hr class="hr-heading-body">
        <div class="body">
            <p>{{ trans('label.mail.participant_vote.invite') }}</p>
            <p>
                <i class="link-invite">{{ trans('label.mail.create_poll.link_vote') }}</i><br>
                <span>{{ trans('label.mail.create_poll.description_link_vote') }}</span>
                <a href="{{ $linkVote }}" target="_blank">{{ $linkVote }}</a>
            </p>
            @if ($password)
                <p>{{ trans('label.mail.create_poll.password') }} <span class="password">{{ $password }}</span></p>
            @endif
            <div class="box-info">
                <h4 class="head">{{ trans('polls.nav_tab_edit.info') }}</h4>
                <p><b>{{ trans('polls.table.thead.creator') }}: </b> {{ $poll->user->name }}</p>
                <p><b>{{ trans('polls.label.title') }}: </b> {{ $poll->title }}</p>
                <p><b>{{ trans('polls.label.description') }}: </b> {{ ($poll->description) ? $poll->description : trans('polls.label.no_data') }}</p>
                <p><b>{{ trans('polls.label.type') }}: </b> {{ $poll->multiple }}</p>
                <p><b>{{ trans('polls.label.location') }}: </b> {{ ($poll->location) ? $poll->location : trans('polls.label.no_data') }}</p>
                <p><b>{{ trans('polls.label.time_close') }}: </b> {{ ($poll->date_close) ? $poll->date_close : trans('polls.label.no_data') }}</p>
                <p><b>{{ trans('polls.label.created_at') }}: </b> {{ ($poll->created_at) ? $poll->created_at : trans('polls.label.no_data') }}</p>
            </div>
        </div>
        <p class="end">{{ trans('label.mail.create_poll.end') }}</p>
    </div>
</div>
</body>
</html>
