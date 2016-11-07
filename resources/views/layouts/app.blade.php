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


    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/home') }}">
                        <h3>{{ config('app.name', 'Laravel') }}</h3>
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        <ul class="nav navbar-nav">
                            <li>
                                <a href="{{ route('user-poll.create') }}">{{ trans('label.create_poll') }}</a>
                            </li>
                        </ul>
                    </ul>
                    <ul class="nav navbar-nav">
                        @if (auth()->check())
                            <ul class="nav navbar-nav">
                                <li>
                                    <a href="{{ URL::action('User\PollController@index') }}">
                                        {{ trans('polls.poll_history') }}
                                    </a>
                                </li>
                            </ul>
                        @endif
                    </ul>
                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <div data-route="{{ url('language') }}">
                            {{ Form::select('lang', config('settings.language'),  Session::get('locale'), ['class' => 'form-control btn-multiple-language']) }}
                        </div>
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ url('/login') }}">{{ trans('label.login') }}</a></li>
                            <li><a href="{{ url('/register') }}">{{ trans('label.register') }}</a></li>
                        @else
                        <li>
                            <a href="{{ URL::action('User\UsersController@index') }}">
                                <span class="glyphicon glyphicon-user">
                                    {{ auth()->user()->name }}
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
                            </a>
                        </li>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    {!! Html::script('/js/app.js') !!}

    <!-- jQuery -->
    {!! Html::script('/bower/jquery/dist/jquery.min.js') !!}

    <!-- Google api -->
    @if (Session::get('locale') == 'ja')
        <script type="text/javascript"
                src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCzfBLqeROyZ1xGhOWb_oG7zmdYcCQdaI8&v=3.exp&sensor=false&libraries=places&language=ja&region=JP">
        </script>
    @endif

    @if (Session::get('locale') == 'en')
        <script type="text/javascript"
                src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCzfBLqeROyZ1xGhOWb_oG7zmdYcCQdaI8&v=3.exp&sensor=false&libraries=places&language=en&region=EN">
        </script>
    @endif

    @if (Session::get('locale') == 'vi')
        <script type="text/javascript"
                src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCzfBLqeROyZ1xGhOWb_oG7zmdYcCQdaI8&v=3.exp&sensor=false&libraries=places&language=vi&region=VI">
        </script>
    @endif

    {!! Html::script('js/shareSocial.js') !!}

    {!! Html::script('js/comment.js') !!}

    {!! Html::script('js/vote.js') !!}

    {!! Html::script('js/listPolls.js') !!}

    {!! Html::script('js/managePoll.js') !!}

    {!! Html::script('js/editLink.js') !!}

    {!! Html::script('js/multipleLanguage.js') !!}

    {!! Html::script('js/requiredPassword.js') !!}

    {!! Html::script('js/layout/master.js') !!}

    <!-- Bootstrap Core JavaScript -->
    {!! Html::script('/bower/bootstrap/dist/js/bootstrap.min.js') !!}

    <!-- jQuery Datatable JavaScript -->
    {!! Html::script('/bower/datatables.net/js/jquery.dataTables.min.js') !!}

    <!-- Bootstrap Datatable JavaScript -->
    {!! Html::script('/bower/datatables.net-bs/js/dataTables.bootstrap.min.js') !!}
</body>
</html>
