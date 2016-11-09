@if (Session::has('message'))
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2 alert alert-success alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {!! Session::get('message') !!}
        </div>
    </div>
@endif
