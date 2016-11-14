@extends('layouts.app')

@section('content')
    <div id="create_poll_wizard" class="col-lg-6 col-lg-offset-3 well wrap-poll">
        <div class="navbar panel">
            <div class="navbar-inner">
                <div class="col-lg-10 col-lg-offset-1 panel-heading">
                    <ul>
                        <li><a href="#tab1" data-toggle="tab">{{ trans('polls.poll_info') }}</a></li>
                        <li><a href="#tab2" data-toggle="tab">{{ trans('polls.show_vote_details') }}</a></li>
                        <li><a href="#tab3" data-toggle="tab">{{ trans('polls.activity_poll') }}</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="tab-content">
            <div class="tab-pane" id="tab1">
                <h4>
                    <span class="label label-danger">
                       <i class="fa fa-times-circle" aria-hidden="true"></i> Closed
                    </span>
                    <a href="#" style="float: right">Link vote
                    </a>
                </h4>
{{--                @include('layouts.poll_info')--}}
            </div>
            <div class="tab-pane" id="tab2">
                <div class="row">
                    <div class="col-md-2">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <ul class="nav nav-pills nav-stacked">
                                    <li class="active"><a data-toggle="tab" href="#home">
                                            <i class="fa fa-calculator" aria-hidden="true"></i>
                                        </a></li>
                                    <li><a data-toggle="tab" href="#menu1">
                                            <i class="fa fa-table" aria-hidden="true"></i>
                                        </a></li>
                                    <li><a data-toggle="tab" href="#menu2">
                                            <i class="fa fa-bar-chart" aria-hidden="true"></i>
                                        </a></li>
                                    <li><a data-toggle="tab" href="#menu3">
                                            <i class="fa fa-pie-chart" aria-hidden="true"></i>
                                        </a></li>
                                </ul>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-10">
                        <div class="tab-content">
                            <div class="tab-pane fade in active" id="home">
                                <div class="panel panel-default animated fadeInRight">
                                    <div class="panel-heading">
                                        STATISTIC
                                    </div>
                                    <div class="panel-body">
                                        <h4>Tong luot binh chon <span class="badge">15</span></h4>
                                        <h4>Thoi gian binh chon dau tien <span class="label label-default">11-10-2016 11:10</span></h4>
                                        <h4>Thoi gian binh chon cuoi cung <span class="label label-default">11-11-2016 11:10</span></h4>
                                        <h4>Option co luot vote cao nhat
                                                <button type="button" class="btn btn-primary">Option 1 <span class="badge">7</span></button>
                                            </h4>
                                        <h4>Option co luot vote thap nhat <button type="button" class="btn btn-primary">Option 2 <span class="badge">5</span></button>
                                            </h4>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="menu1">
                                <div class="panel panel-default animated fadeInRight">
                                    <div class="panel-heading">
                                        TABLLE RESULT
                                        <button type="button" class="btn btn-danger" style="float: right; font-size: 10px">
                                            <i class="fa fa-list" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                    <div class="panel-body">
                                        <table class="table table-hover table-responsive">
                                            <thead>
                                            <tr>
                                                <th>STT</th>
                                                <th>Option</th>
                                                <th>Vote</th>
                                                <th>Date laste vote</th>
                                                <th>Detail</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>
                                                    1
                                                </td>
                                                <td>
                                                    <p style="word-wrap: break-word; width: 10em">dkasdkahsdashdhasjdkashkdhakjshdkjashdkjashdkas</p>
                                                </td>
                                                <td>
                                                    <span class="badge">13</span>
                                                </td>
                                                <td>
                                                    11-11-2016 11:50
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-primary btn-xs">
                                                        <i class="fa fa-asterisk" aria-hidden="true"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    2
                                                </td>
                                                <td>
                                                    <p style="word-wrap: break-word; width: 10em">dkasdkahsdashdhasjdkashkdhakjshdkjashdkjashdkasasdsadjashdjksahdkashdkjsahdjks</p>
                                                    <img src="{{ asset('uploads/images/polleverywhere1.png') }}" alt="" width="50px" height="50px">
                                                </td>
                                                <td>
                                                    <span class="badge">7</span>
                                                </td>
                                                <td>
                                                    11-11-2016 11:50
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-primary btn-xs">
                                                        <i class="fa fa-asterisk" aria-hidden="true"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    3
                                                </td>
                                                <td>
                                                    <img src="{{ asset('uploads/images/polleverywhere1.png') }}" alt="" width="50px" height="50px">
                                                </td>
                                                <td>
                                                    <span class="badge">5</span>
                                                </td>
                                                <td>
                                                    11-11-2016 11:50
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-primary btn-xs">
                                                        <i class="fa fa-asterisk" aria-hidden="true"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="menu2">
                                <div class="panel panel-default animated fadeInRight">
                                    <div class="panel-heading">
                                        BAR CHART
                                    </div>
                                    <div class="panel-body">

                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="menu3">
                                <div class="panel panel-default animated fadeInRight">
                                    <div class="panel-heading">
                                        PIE CHART
                                    </div>
                                    <div class="panel-body">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix visible-lg"></div>
                </div>
            </div>
            <div class="tab-pane" id="tab3">
                <div class="row">
                    <div class="col-lg-6">
                        <label>{{ url('/') . config('settings.email.link_vote') . 'asjdhkjashdksakd'  }}</label>
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon3">administrator</span>
                            <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                            <span class="input-group-btn">
                                <button class="btn btn-secondary" type="button">
                                    <i class="fa fa-check" aria-hidden="true"></i>
                                </button>
                            </span>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <label>{{ url('/') . config('settings.email.link_vote') . 'asjdhkjashdksakd'  }}</label>
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon3">vote</span>
                            <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                            <span class="input-group-btn">
                                <button class="btn btn-secondary" type="button">
                                    <i class="fa fa-check" aria-hidden="true"></i>
                                </button>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <hr style="border: 1px solid darkcyan">
                </div>
                <div class="row">
                    <div class="col-lg-4" style="text-align: center">
                        <h4><a href="#">View history of poll</a></h4>
                        <h4><a href="#">Edit this poll</a></h4>
                        <h4><a href="#">Duplicate poll</a></h4>
                        <h4><a href="#">Close poll</a></h4>
                    </div>
                    <div class="col-lg-4" style="text-align: center">
                        <h4><a href="#">Delete all participants</a></h4>
                        <h4><a href="#">Delete all comment</a></h4>
                        <h4><a href="#">Delete this poll</a></h4>
                    </div>
                    <div class="col-lg-4" style="text-align: center">
                        <h4><a href="#">Export result to PDF</a></h4>
                        <h4><a href="#">Export result to Excel</a></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
