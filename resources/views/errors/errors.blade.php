@if ($errors->any())
    <div class="col-lg-12">
        <ul class="col-lg-6 col-lg-offset-3 alert alert-danger alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            @foreach ($errors->all() as $message)
                <li>{{ $message }}</li>
            @endforeach
        </ul>
    </div>
@endif
