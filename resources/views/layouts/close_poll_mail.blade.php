<!DOCTYPE html>
<html>
    <head>
        <style>
            h1 {
                text-align: center;
            }
        </style>
    </head>
    <body>
        <h1>{{ trans('label.mail.head') }}</h1>
        <hr>
        <h3>{{ trans('label.mail.close_poll') }}</h3> <a href="{{ $link }}" target="_blank">{{ $link }}</a>
    </body>
</html>
