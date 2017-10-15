<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link href="{{ asset('css/customstyles.css') }}" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.css" rel="stylesheet">
        <link href="{{ asset('toastr/toastr.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/jquery-ui.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/lightbox.min.css') }}" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <script type="text/javascript" src={{ asset('js/datepicker.js') }}></script>
        <script type="text/javascript" src="{{ asset('toastr/toastr.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/lightbox.min.js') }}"></script>

        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script type="text/javascript">
            $.ajaxSetup({
                headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
            });
        </script>
        <script type="text/javascript" src={{ asset('js/page_scripts.js') }}></script>
        <title>Laravel</title>
    </head>
    <body>
        @yield('navbar')

        <div class="col-lg-12">
            @include('layouts.includes._messages')
        </div>

        <div class="col-lg-12">
            @yield('content')
        </div>
    </body>
</html>
