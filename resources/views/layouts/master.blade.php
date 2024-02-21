<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <link href="{{ url('/') }}/assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="{{ url('/') }}/assets/css/light-bootstrap-dashboard.css?v=2.0.0 " rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="{{ url('/') }}/assets/css/demo.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    @yield('css')

</head>
<body>
    <div class="wrapper">

        @include('layouts.includes.menu')

        <div class="main-panel">
            @include('layouts.includes.header')

            <div class="content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
        </div>

    </div>
</body>
<!--   Core JS Files   -->
<script src="{{ url('/') }}/assets/js/core/jquery.3.2.1.min.js" type="text/javascript"></script>
<script src="{{ url('/') }}/assets/js/core/popper.min.js" type="text/javascript"></script>
<script src="{{ url('/') }}/assets/js/core/bootstrap.min.js" type="text/javascript"></script>
<!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
<script src="{{ url('/') }}/assets/js/plugins/bootstrap-switch.js"></script>
<!--  Notifications Plugin    -->
<script src="{{ url('/') }}/assets/js/plugins/bootstrap-notify.js"></script>
<!-- Control Center for Light Bootstrap Dashboard: scripts for the example pages etc -->
<script src="{{ url('/') }}/assets/js/light-bootstrap-dashboard.js?v=2.0.0 " type="text/javascript"></script>
<!-- Light Bootstrap Dashboard DEMO methods, don't include it in your project! -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script src="{{ url('/') }}/assets/js/demo.js"></script>

@yield('js')
<script>
    @if (Session::has('sukses'))
        toastr.success("{{ Session::get('sukses') }}", "Simpan")
    @endif
    @if (Session::has('delete'))
        toastr.error("{{ Session::get('delete') }}", "Delete")
    @endif
    @if (Session::has('update'))
        toastr.warning("{{ Session::get('update') }}", "Update")
    @endif
</script>

</html>
