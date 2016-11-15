@extends('layouts.app')

@section('content')
    <div id="voting_wizard" class="col-lg-6 col-lg-offset-3 well wrap-poll">
        <div class="navbar panel">
            <div class="navbar-inner">
                <div class="col-lg-8 col-lg-offset-2 panel-heading">
                    <ul>
                        <li><a href="#tab1" data-toggle="tab">{{ trans('polls.nav_tab_edit.voting') }}</a></li>
                        <li><a href="#tab2" data-toggle="tab">{{ trans('polls.nav_tab_edit.info') }}</a></li>
                        <li><a href="#tab3" data-toggle="tab">{{ trans('polls.nav_tab_edit.result') }}</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="tab-content">
            <div class="tab-pane" id="tab1">
                <div class="row">
                    @for ($index = 0; $index < 7; $index++)
                        <div class="col-lg-4">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <label style="word-wrap: break-word">Option 11111111111111111111111sfoisdjsaldjlaskdlaskdlas</label>
                                    <img src="{{ asset('uploads/images/Required_mail.png') }}" alt=""
                                         class="img-responsive">
                                </div>
                                <div class="panel-footer">
                                    <input type="checkbox" value="">
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>

                <div class="row">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <label><input type="checkbox" value=""> Option 1</label>
                            <button class="btn btn-success" style="float: right">
                                <i class="fa fa-picture-o" aria-hidden="true"></i>
                            </button>
                        </div>
                        <div class="panel-body" style="display: none">
                            <img src="{{ asset('uploads/images/Required_mail.png') }}" alt=""
                                 class="img-responsive">
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <label style="word-wrap: break-word"><input type="checkbox" value=""> Option 1haskdhaslkdaslkdhaslkdhashdkashdkjashdkjashdjkhaskdhasjkhdksahdkhaskdhksahdkasdksahdkasdkashdjkashdkhaskdjsahkdhsakjd</label>
                        </div>
                        <div class="panel-body" style="display: none">
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <label><input type="checkbox" value=""></label>
                        </div>
                        <div class="panel-body">
                            <img src="{{ asset('uploads/images/polleverywhere1.png') }}" alt=""
                                 class="img-responsive">
                        </div>
                    </div>
                </div>

            </div>
            <div class="tab-pane" id="tab2">
                <div class="col-lg-12">
                    <label style="word-wrap: break-word">
                        Titletiel 1assadsadjasjdhs adasdksafdkjasldkasj dldjasldasdja sdjslksdasdsadasdsaasjakhdkaskkkkkkkjsssssssssssssssssssssssssssssssssssssssssskkdasdaskd
                        <span><a href="#" data-placement="right" data-toggle="tooltip" title="sadksahdkjashdkjsahdjashdjs sadasdsadas asdasdas ssss adjsahkdsadkhskjhsajkdhasjkd!"> <i class="fa fa-info-circle" aria-hidden="true"></i></a></span>
                    </label>
                    <span>
                        <i class="fa fa-user" aria-hidden="true"></i> Ho Quoc Hai
                    </span>
                    <span style="float: right">
                        <i class="fa fa-map-marker" aria-hidden="true"></i> Da Nang Viet Nam
                    --- <i class="fa fa-calendar" aria-hidden="true"></i> 13-11-2016
                    </span>
                </div>
                <div class="col-lg-12">
                    <hr style="border: 1px solid white">
                </div>

                <div class="col-lg-12">
                    <p>
                        <img src="{{ asset('uploads/avatar/default.jpg') }}" width="40px" height="40px" class="img-circle">
                        <span>
                            sadjsaldjsaldkla;skd;laskdaskd;asldlasdlkasjdlksajkld
                        </span>
                        <span><button class="btn btn-xs btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button></span>
                    </p>
                    <p>
                        <img src="{{ asset('uploads/avatar/default.jpg') }}" width="40px" height="40px" class="img-circle">
                        <span>
                            sadjsaldjsaldkla;skd;laskdaskd;asldlasdlkasjdlksajkld
                        </span>
                        <span><button class="btn btn-xs btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button></span>
                    </p>
                    <p>
                        <img src="{{ asset('uploads/avatar/default.jpg') }}" width="40px" height="40px" class="img-circle">
                        <span>
                            sadjsaldjsaldkla;skd;laskdaskd;asldlasdlkasjdlksajkld
                        </span>
                        <span><button class="btn btn-xs btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button></span>
                    </p>
                </div>
                <div class="col-lg-12">
                    <hr style="border: 1px solid darkcyan">
                </div>
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Comment
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-5 form-group">
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 form-group">
                                    <textarea class="form-control" rows="2" id="comment"></textarea>
                                </div>
                            </div>
                            <button class="btn btn-primary">Comment</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="tab3">
               <table class="table table-hover table-responsive">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Option</th>
                            <th>Vote</th>
                            <th>Date laste vote</th>
                        </tr>
                    </thead>
                   <tbody>
                       <tr>
                           <td>
                               1
                           </td>
                           <td>
                               <p style="word-wrap: break-word; width: 20em">dkasdkahsdashdhasjdkashkdhakjshdkjashdkjashdkas</p>
                           </td>
                            <td>
                                <span class="badge">13</span>
                            </td>
                           <td>
                               11-11-2016 11:50
                           </td>
                        </tr>
                       <tr>
                           <td>
                               2
                           </td>
                           <td>
                               <p style="word-wrap: break-word; width: 20em">dkasdkahsdashdhasjdkashkdhakjshdkjashdkjashdkasasdsadjashdjksahdkashdkjsahdjks</p>
                               <img src="{{ asset('uploads/images/polleverywhere1.png') }}" alt="" width="50px" height="50px">
                           </td>
                           <td>
                               <span class="badge">7</span>
                           </td>
                           <td>
                               11-11-2016 11:50
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
                       </tr>
                   </tbody>
               </table>
            </div>
        </div>
    </div>
@endsection
