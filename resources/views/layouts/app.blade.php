<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    {!! Html::style('css/app.css') !!}

    {!! Html::style('css/user.css') !!}

    {!! Html::style('css/layout/mail_notification.css') !!}

    {!! Html::style('css/layout/master.css') !!}

    <!-- Bootstrap CSS -->
    {!! Html::style('bower/bootstrap/dist/css/bootstrap.min.css') !!}

    <!-- Bootstrap theme CSS -->
    {!! Html::style('bower/bootstrap/dist/css/bootstrap-theme.min.css') !!}

    <!-- Bootstrap datatable CSS -->
    {!! Html::style('bower/datatables.net-bs/css/dataTables.bootstrap.min.css') !!}

    <!-- Animate -->
    {!! Html::style('bower/animate.css/animate.min.css') !!}

    <!-- Social button -->
    {!! Html::style('bower/font-awesome/css/font-awesome.min.css') !!}
    {!! Html::style('bower/bootstrap-social/bootstrap-social.css') !!}

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-app navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menu">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{ asset("/") }}">
                        <b class="char-app">P</b>OLL
                    </a>
                </div>
                <div class="collapse navbar-collapse" id="menu">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="{{ asset("/") }}">{{ trans('label.home') }}</a></li>
                        <li><a href="{{ route('user-poll.create') }}">{{ trans('label.create_poll') }}</a></li>
                        @if (auth()->check())
                            <li>
                                <a href="{{ URL::action('User\PollController@index') }}">{{ trans('polls.poll_history') }}</a>
                            </li>
                        @endif
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        @if (Auth::guest())
                            <li>
                                <a href="{{ url('/login') }}">
                                    <span class="glyphicon glyphicon-log-in"></span> {{ trans('label.login') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('/register') }}">
                                    <span class="glyphicon glyphicon-registration-mark"></span> {{ trans('label.register') }}
                                </a>
                            </li>
                        @else
                            <li>
                                <a href="{{ URL::action('User\UsersController@index') }}">
                                <span class="glyphicon glyphicon-user">
                                    {{ str_limit(auth()->user()->name, 10) }}
                                </span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('/logout') }}"
                                   onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                                    <span class="glyphicon glyphicon-log-out">
                                        {{ trans('label.logout') }}
                                    </span>
                                </a>
                                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        @endif
                        <li>
                            <div data-route="{{ url('language') }}" class="multiple-lang">
                                {{ Form::select('lang', config('settings.language'),  Session::get('locale'), ['class' => 'form-control btn-multiple-language']) }}
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="content">
            @yield('content')
        </div>
    </div>

    <!-- jQuery -->
    {!! Html::script('/bower/jQuery/dist/jquery.min.js') !!}

    <!-- Google api -->
    <script type="text/javascript"
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCzfBLqeROyZ1xGhOWb_oG7zmdYcCQdaI8&v=3.exp&sensor=false&libraries=places">
    </script>

    {!! Html::script('js/shareSocial.js') !!}

    {!! Html::script('js/comment.js') !!}

    {!! Html::script('js/vote.js') !!}

    {!! Html::script('js/listPolls.js') !!}

    {!! Html::script('js/managePoll.js') !!}

    {!! Html::script('js/editLink.js') !!}

    {!! Html::script('js/multipleLanguage.js') !!}

    {!! Html::script('js/requiredPassword.js') !!}

    {!! Html::script('js/layout/master.js') !!}

    <!-- Scripts -->
    {!! Html::script('/js/app.js') !!}

    <!-- jQuery Datatable JavaScript -->
    {!! Html::script('/bower/datatables.net/js/jquery.dataTables.min.js') !!}

    <!-- Bootstrap Datatable JavaScript -->
    {!! Html::script('/bower/datatables.net-bs/js/dataTables.bootstrap.min.js') !!}
</body>
</html>
