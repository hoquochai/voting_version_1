@if ($errors->any())
    <div class="col-lg-12">
        <ul class="col-lg-8 col-lg-offset-2 alert alert-danger">
            @foreach ($errors->all() as $message)
                <li>{{ $message }}</li>
            @endforeach
        </ul>
    </div>
@endif
