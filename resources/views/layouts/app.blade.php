<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @yield('meta')

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('bower/ms-Dropdown/css/msdropdown/dd.css') }}" />

    <link rel="stylesheet" type="text/css" href="{{ asset('bower/ms-Dropdown/css/msdropdown/flags.css') }}" />

    <link href="{{ asset('bower/css3-animate-it/css/animations.css') }}" rel="stylesheet">

    {!! Html::style('bower/sweetalert/dist/sweetalert.css') !!}

    <!-- Styles -->
    {!! Html::style('css/app.css') !!}

    {!! Html::style('css/user.css') !!}

    <!-- Bootstrap CSS -->
    {!! Html::style('bower/bootstrap/dist/css/bootstrap.min.css') !!}

    <!-- Bootstrap theme CSS -->
    {!! Html::style('bower/bootstrap/dist/css/bootstrap-theme.min.css') !!}

{!! Html::style('css/layout/master.css') !!}

    <!-- Bootstrap datatable CSS -->
    {!! Html::style('bower/datatables.net-bs/css/dataTables.bootstrap.min.css') !!}

    <!-- Animate -->
    {!! Html::style('bower/animate.css/animate.min.css') !!}

    <!-- Social button -->
    {!! Html::style('bower/font-awesome/css/font-awesome.min.css') !!}
    {!! Html::style('bower/bootstrap-social/bootstrap-social.css') !!}

    <!-- Bootstrap Tag Input css -->
    <link href="{{ asset('bower/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}" rel="stylesheet">

    <!-- Bootstrap Switch css -->
    <link href="{{ asset('bower/bootstrap-switch/dist/css/bootstrap2/bootstrap-switch.min.css') }}" rel="stylesheet">

    <!-- Datetime picker -->
    <link href="{{ asset('bower/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">



    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>

    <!-- Google api -->
    @if (Session::get('locale') == 'ja')
        <script type="text/javascript"
                src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCzfBLqeROyZ1xGhOWb_oG7zmdYcCQdaI8&v=3.exp&libraries=places&language=ja">
        </script>
    @elseif(Session::get('locale') == 'vi')
        <script type="text/javascript"
                src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCzfBLqeROyZ1xGhOWb_oG7zmdYcCQdaI8&v=3.exp&libraries=places&language=vi">
        </script>
    @else
        <script type="text/javascript"
                src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCzfBLqeROyZ1xGhOWb_oG7zmdYcCQdaI8&v=3.exp&libraries=places&language=en">
        </script>
    @endif


</head>
<body>
        <nav class="navbar navbar-default  animated fadeInDown">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menu">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{ asset("/") }}">
                        <b class="char-app">F</b>POLL
                    </a>
                </div>
                <div class="collapse navbar-collapse" id="menu">
                    <ul class="nav-menu nav navbar-nav">
                        <li {!! Request::is('/') ? 'class="active"' : '' !!}>
                            <a href="{{ asset("/") }}"><span class="glyphicon glyphicon-home"></span> {{ trans('label.home') }}</a>
                        </li>
                        @if (auth()->check())
                            <li {!! Request::is('user/poll') ? 'class="active"' : '' !!}>
                                <a href="{{ URL::action('User\PollController@index') }}">
                                    <i class="fa fa-history" aria-hidden="true"></i> {{ trans('polls.poll_history') }}
                                </a>
                            </li>
                        @endif
                    </ul>
                    <ul class="nav-menu nav navbar-nav navbar-right">
                        @if (Auth::guest())
                            <li {!! Request::is('login') ? 'class="active"' : '' !!}>
                                <a href="{{ url('/login') }}">
                                    <span class="glyphicon glyphicon-log-in"></span> {{ trans('label.login') }}
                                </a>
                            </li>
                            <li {!! Request::is('register') ? 'class="active"' : '' !!}>
                                <a href="{{ url('/register') }}">
                                    <span class="glyphicon glyphicon-registration-mark"></span> {{ trans('label.register') }}
                                </a>
                            </li>
                        @else
                            <li {!! Request::is('user/profile') ? 'class="active"' : '' !!}>
                                <a href="{{ URL::action('User\UsersController@index') }}">
                                    <span>
                                        <img class="img-circle img-profile-header" src="{{ auth()->user()->getAvatarPath() }}">
                                        {{ str_limit(auth()->user()->name, 10) }}
                                    </span>
                                </a>
                            </li>
                            <li {!! Request::is('/logout') ? 'class="active"' : '' !!}>
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
                            <div class="hide_language" data-route="{{ url('language') }}"></div>
                            <div class="multiple-lang">
                                <select name="lang" id="countries" class="form-control btn-multiple-language" style="min-width: 120px;">
                                    <option value='en' {{ Session::get('locale') == 'en' ? 'selected' : '' }} data-image="{{ asset('bower/ms-Dropdown/images/msdropdown/icons/blank.gif') }} " data-imagecss="flag england" data-title="English">English</option>
                                    <option value='vi' {{ Session::get('locale') == 'vi' ? 'selected' : '' }} data-image="{{ asset('bower/ms-Dropdown/images/msdropdown/icons/blank.gif') }}" data-imagecss="flag vn" data-title="Tiếng Việt">Tiếng Việt</option>
                                    <option value='ja' {{ Session::get('locale') == 'ja' ? 'selected' : '' }} data-image="{{ asset('bower/ms-Dropdown/images/msdropdown/icons/blank.gif') }}" data-imagecss="flag jp" data-title="日本語">日本語</option>
                                </select>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container-fluid">
                @yield('content')
                <script src="//code.jquery.com/jquery.js"></script>
                @include('flashy::message')
                <a href="javascript:void(0);" id="scroll" style="display: none;">Top<span></span></a>
        </div>
        <div class="container-fluid animatedParent" style="background: #f3f4f4">
            <div class="col-lg-8 col-lg-offset-2 animated growIn slowest">
                <h2 style="text-align: center">{{ trans('label.feature') }}</h2>
                <img src="https://cdn.elegantthemes.com/blog/wp-content/uploads/2015/12/poll-plugins-thumbnail.jpg" style="width: 100px; height: 100px; border-radius: 50%">
                <img src="https://cdn.elegantthemes.com/blog/wp-content/uploads/2015/12/poll-plugins-thumbnail.jpg" style="width: 100px; height: 100px; border-radius: 50%">
                <img src="https://cdn.elegantthemes.com/blog/wp-content/uploads/2015/12/poll-plugins-thumbnail.jpg" style="width: 100px; height: 100px; border-radius: 50%">
                <img src="https://cdn.elegantthemes.com/blog/wp-content/uploads/2015/12/poll-plugins-thumbnail.jpg" style="width: 100px; height: 100px; border-radius: 50%">
            </div>
        </div>
        {{--<div class="col-lg-12 animatedParent" style="background: #f3f4f4">--}}
            {{--<div class="col-lg-4  animated fadeInRight slowest">--}}
                {{--<h2 style="text-align: center">{{ trans('label.feature') }}</h2>--}}

            {{--</div>--}}
            {{--<div class="col-lg-4">--}}
                {{--<h2 style="text-align: center">{{ trans('label.accessible') }}</h2>--}}
                {{--<img class="img-responsive animated fadeInUp" src="http://brolik.com/blog/wp-content/uploads/2013/05/BRO_ResponsiveDesign_Main2.png" style="height: 200px; display: block; margin: 0 auto;">--}}
            {{--</div>--}}
            {{--<div class="col-lg-4">--}}
                {{--<h2 style="text-align: center">{{ trans('label.security') }}</h2>--}}
                {{--<img class="animated fadeInRight img-responsive" src="http://standardsinsight.com/wp-content/uploads/2015/07/internet-security.jpg" height="200px" style="display: block; margin: 0 auto; width: 200px; height: 200px; border-radius: 50%">--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="col-lg-12" style="background: antiquewhite">--}}
            {{--<div class="col-lg-6 animated fadeInLeft">--}}
                {{--<h2 style="text-align: center">{{ trans('label.introduction') }}</h2>--}}
                {{--<p>--}}
                    {{--Website Fpoll là một website tạo bình chọn--}}
                {{--</p>--}}
            {{--</div>--}}
            {{--<div class="col-lg-6 animated fadeInRight" style="max-width: 600px; overflow-x: scroll; overflow-y: hidden">--}}
                {{--<h2>{{ trans('label.tutorial') }}</h2>--}}
                {{--<iframe width="560" height="315" src="https://www.youtube.com/embed/5jOGtIqBtdw" frameborder="0" allowfullscreen></iframe>--}}
            {{--</div>--}}
        {{--</div>--}}
        <footer style="background: black; color: white; position: absolute; bottom: 0; height: 140px; width: 100%">
            {{--<div class="container">--}}
                <div class="col-lg-3">
                    <p><b class="char-app">F</b><label>poll</label></p>
                    <p>
                        <img src="{{ asset('uploads/images/logo.png') }}" style="width: 30px; height: 30px;">
                        {{ trans('label.footer.copyright') }}
                    </p>
                </div>
                <div class="col-lg-5" style="padding: 15px">
                    <div class="col-lg-12">
                        <p><i class="fa fa-map-marker" aria-hidden="true"></i> {{ trans('label.footer.location') }}</p>
                    </div>
                    <div class="col-lg-12">
                        <p><i class="fa fa-phone" aria-hidden="true"></i> {{ trans('label.footer.phone') }}</p>
                    </div>
                    <div class="col-lg-12">
                        <p><i class="fa fa-envelope" aria-hidden="true"></i> {{ trans('label.footer.email') }}</p>
                    </div>
                </div>
                <div class="col-lg-4" style="padding: 15px">
                    <p>{{ trans('label.footer.about') }}</p>
                    <p style="word-wrap: break-word">{{ trans('label.footer.description_website') }}</p>
                    <button class="btn btn-primary">
                        <span><i class="fa fa-facebook" aria-hidden="true"></i></span>
                    </button>
                    <button class="btn btn-success">
                        <span><i class="fa fa-twitter" aria-hidden="true"></i></span>
                    </button>
                    <button class="btn btn-warning">
                        <span><i class="fa fa-github" aria-hidden="true"></i></span>
                    </button>
                    <button class="btn btn-default">
                        <span><i class="fa fa-linkedin" aria-hidden="true"></i></span>
                    </button>
                </div>
            {{--</div>--}}

        </footer>

    <!-- jQuery -->
    {!! Html::script('bower/jquery/dist/jquery.min.js') !!}
    {!! Html::script('bower/jquery-validation/dist/jquery.validate.min.js') !!}

    <!-- Bootstrap -->
    {!! Html::script('bower/bootstrap/dist/js/bootstrap.min.js') !!}

    <!-- winzard -->
    {!! Html::script('bower/twitter-bootstrap-wizard/jquery.bootstrap.wizard.js') !!}

    <!-- Scripts -->
    {{--{!! Html::script('/js/app.js') !!}--}}

    {!! Html::script('js/shareSocial.js') !!}

    {!! Html::script('js/comment.js') !!}

    {!! Html::script('js/vote.js') !!}

    {!! Html::script('js/listPolls.js') !!}

    {!! Html::script('js/managePoll.js') !!}

    {!! Html::script('js/editLink.js') !!}

    {!! Html::script('js/multipleLanguage.js') !!}

    {!! Html::script('js/layout/master.js') !!}

    <!-- jQuery Datatable JavaScript -->
    {!! Html::script('/bower/datatables.net/js/jquery.dataTables.min.js') !!}

    <!-- Bootstrap Datatable JavaScript -->
    {!! Html::script('/bower/datatables.net-bs/js/dataTables.bootstrap.min.js') !!}

    <!-- Tag Input -->
    {!! Html::script('/bower/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') !!}

    <!-- Datetime picker -->
    <script src="{{ asset('bower/moment/min/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('bower/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}" type="text/javascript"></script>

    <!-- Bootstrap switch -->
    {!! Html::script('bower/bootstrap-switch/dist/js/bootstrap-switch.min.js') !!}

    {!! Html::script('bower/sweetalert/dist/sweetalert.min.js') !!}

    <script src="{{ asset('bower/ms-Dropdown/js/msdropdown/jquery.dd.min.js') }}"></script>

    <script src="{{ asset('bower/css3-animate-it/js/css3-animate-it.js') }}"></script>

</body>
</html>
