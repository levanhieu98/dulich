<!DOCTYPE html>
<html lang="{{Illuminate\Support\Facades\App::currentLocale()}}">

<head>
    <meta charset="utf-8">
    <!-- <title>@yield('title')</title> -->
    <title>Hiệp hội du lịch Thanh Hóa</title>
    <meta content="Responsive bootstrap 4 admin template" name="description">
    <meta content="Coderthemes" name="author">
    <base href="{{ asset('')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- App favicon -->
    {{-- <link rel="stylesheet" href="{{ mix('css/app.css') }}"> --}}
    <!-- App favicon -->
    <link rel="shortcut icon" href="backend\assets\images\icon-2.png">

    <!-- Plugins css -->
    <link href="backend\assets\libs\flatpickr\flatpickr.min.css" rel="stylesheet" type="text/css">
    <link href="backend\assets\libs\selectize\css\selectize.bootstrap3.css" rel="stylesheet" type="text/css">
    <link href="backend\assets\fontawesome\css\all.css" rel="stylesheet" type="text/css">

    <!-- App css -->
    <link href="backend\assets\css\bootstrap.min.css" rel="stylesheet" type="text/css" id="bs-default-stylesheet">
    <link href="backend\assets\css\app.min.css" rel="stylesheet" type="text/css" id="app-default-stylesheet">

    <!-- icons -->
    <link href="backend\assets\css\icons-style.css" rel="stylesheet" type="text/css">
    
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js" integrity="sha512-d9xgZrVZpmmQlfonhQUvTR7lMPtO7NkZMkA0ABN3PHCbKA5nqylQ/yWlFAyY6hYgdF1Qh6nYiuADWwKB4C2WSw==" crossorigin="anonymous"></script></head>

<body class="loading"
    data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed", "topbar": {"color": "dark"}, "showRightSidebarOnPageLoad": true}'>
    <div id="wrapper" >
       
        <!--Start header-->
        @include('backend.master.header')
        <!--End header-->

        <!-- Side bar -->
        @include('backend.master.sidebar')
        <!-- End Side bar-->

        <!--dashboard-->
        <div class="content-page" >
            @yield('content')
        </div>
        <!--end dashboard-->
    </div>

    @include('backend.master.footer')

    <!-- Vendor js -->
    <script src="backend\assets\js\vendor.min.js"></script>

    <!-- Plugins js-->
    <script src="backend\assets\libs\flatpickr\flatpickr.min.js"></script>

    <script src="backend\assets\libs\selectize\js\standalone\selectize.min.js"></script>

    <!-- App js-->
    <script src="backend\assets\js\app.min.js"></script>
    
    <script type="text/javascript">
    $(document).ready(function () {
    const timeout = 900000;  // 900000 ms = 15 minutes
    var idleTimer = null;
    $('*').bind('mousemove click mouseup mousedown keydown keypress keyup submit change mouseenter scroll resize dblclick', function () {
        clearTimeout(idleTimer);

        idleTimer = setTimeout(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: '{{route("logout")}}',
                success: function( msg ) {
                    console.log('logout ok');
                }
            });
        }, timeout);
    });
    $("body").trigger("mousemove");
});
    </script>



</body>

</html>
