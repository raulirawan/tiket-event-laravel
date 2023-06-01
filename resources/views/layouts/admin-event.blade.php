<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="csrf-token" content="{{csrf_token()}}">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>@yield('title')</title>
        @stack('up-style')
        <link href="{{ url('backend/css/styles.css') }}" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.21/datatables.min.css"/>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="{{ url('backend/css/jquery.datetimepicker.css') }}">
        @stack('down-style')
    </head>
    <body class="sb-nav-fixed">
        @include('includes.admin-event.navbar')
        <div id="layoutSidenav">
            @include('includes.admin-event.sidebar')
            <div id="layoutSidenav_content">
                @yield('content')

                @include('includes.admin-event.footer')
            </div>
        </div>
        @stack('up-script')
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{ url('backend/js/scripts.js') }}"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.21/datatables.min.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="{{ url('backend/js/jquery.datetimepicker.full.js') }}"></script>
        @stack('down-script')
        @include('sweetalert::alert')
    </body>
</html>
