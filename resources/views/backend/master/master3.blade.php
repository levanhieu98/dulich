<!DOCTYPE html>
<html lang="{{Illuminate\Support\Facades\App::currentLocale()}}">

<head>
    <meta charset="utf-8">
    <!-- <title>@yield('title')</title> -->
    <title>Hiệp hội du lịch Thanh Hóa</title>
    <meta content="Responsive bootstrap 4 admin template" name="description">
    <meta content="Coderthemes" name="author">
    <meta name="viewport" content="width=device-width, initial-scale=0">
    <base href="{{ asset('')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- App favicon -->
    {{-- <link rel="stylesheet" href="{{ mix('css/app.css') }}"> --}}
    <!-- App favicon -->
    <link rel="shortcut icon" href="backend\assets\images\favicon.ico">

    <!-- Jquery Toast css -->
    <link href="backend\assets\libs\jquery-toast-plugin\jquery.toast.min.css" rel="stylesheet" type="text/css">

    <!-- App css -->
    <link href="backend\assets\css\bootstrap.min.css" rel="stylesheet" type="text/css" id="bs-default-stylesheet">
    <link href="backend\assets\css\app.min.css" rel="stylesheet" type="text/css" id="app-default-stylesheet">

    <!-- Plugins css -->
    <link href="backend\assets\libs\mohithg-switchery\switchery.min.css" rel="stylesheet" type="text/css">
    <link href="backend\assets\libs\multiselect\css\multi-select.css" rel="stylesheet" type="text/css">
    <link href="backend\assets\libs\select2\css\select2.min.css" rel="stylesheet" type="text/css">
    <link href="backend\assets\libs\bootstrap-select\css\bootstrap-select.min.css" rel="stylesheet" type="text/css">
    <link href="backend\assets\libs\bootstrap-touchspin\jquery.bootstrap-touchspin.min.css" rel="stylesheet" type="text/css">

    <!-- icons -->
    <link href="backend\assets\css\icons-style.css" rel="stylesheet" type="text/css">
    <link href="backend\assets\fontawesome\css\all.css" rel="stylesheet" type="text/css">
   
    <!-- Free Style-->
    <link href="backend\assets\css\style.css" rel="stylesheet">
    <link href="backend\assets\libs\flatpickr\flatpickr.min.css" rel="stylesheet" type="text/css">
    <link href="backend\assets\libs\bootstrap-colorpicker\css\bootstrap-colorpicker.min.css" rel="stylesheet" type="text/css">
    <link href="backend\assets\libs\clockpicker\bootstrap-clockpicker.min.css" rel="stylesheet" type="text/css">
    <link href="backend\assets\libs\bootstrap-datepicker\css\bootstrap-datepicker.min.css" rel="stylesheet" type="text/css">
    @yield('showCSS')

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

</head>

<body class="loading"
    data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed", "topbar": {"color": "dark"}, "showRightSidebarOnPageLoad": true}'>
    <div id="wrapper">
        <!--Start header-->
        @include('backend.master.header')
        <!--End header-->

        <!-- Side bar -->
        @include('backend.master.sidebar')
        <!-- End Side bar-->

        <!--dashboard-->
        <div class="content-page">
            @yield('content')
        </div>
        <!--end dashboard-->
    </div>

    @include('backend.master.footer')

    <!-- Vendor js -->
  
    <script src="backend\assets\js\vendor.min.js"></script>

    <!-- Start forms-advanced -->
    <script src="backend\assets\libs\selectize\js\standalone\selectize.min.js"></script>
    <script src="backend\assets\libs\mohithg-switchery\switchery.min.js"></script>
    <script src="backend\assets\libs\multiselect\js\jquery.multi-select.js"></script>
    <script src="backend\assets\libs\select2\js\select2.min.js"></script>
    {{-- <script src="backend\assets\libs\jquery-mockjax\jquery.mockjax.min.js"></script> --}}
    <script src="backend\assets\libs\devbridge-autocomplete\jquery.autocomplete.min.js"></script>
    <script src="backend\assets\libs\bootstrap-select\js\bootstrap-select.min.js"></script>
    <script src="backend\assets\libs\bootstrap-touchspin\jquery.bootstrap-touchspin.min.js"></script>
    <script src="backend\assets\libs\bootstrap-maxlength\bootstrap-maxlength.min.js"></script>
    <!-- End forms-advanced -->

    <!-- Init js-->
    {{-- <script src="backend\assets\js\pages\form-advanced.init.js"></script> --}}

    <!-- Tost-->
    <script src="backend\assets\libs\jquery-toast-plugin\jquery.toast.min.js"></script>

    <!-- toastr init js-->
    <script src="backend\assets\js\pages\toastr.init.js"></script>

    <!-- izi modal-->
    <script src="backend\assets\js\izi.js"></script>
    <script src="backend\assets\js\popup.js"></script>

    <!-- App js-->
    <script src="backend\assets\js\app.min.js"></script>
    <script src="backend\assets\js\HieuJS\validateH.js"></script>
    <script type="text/javascript" src="backend/assets/js/tinymce/tinymce.min.js"></script>
    
    <script src="backend\assets\libs\flatpickr\flatpickr.min.js"></script>
    <script src="backend\assets\libs\bootstrap-colorpicker\js\bootstrap-colorpicker.min.js"></script>
    <script src="backend\assets\libs\clockpicker\bootstrap-clockpicker.min.js"></script>
    <script src="backend\assets\libs\bootstrap-datepicker\js\bootstrap-datepicker.min.js"></script>
   <!-- Long js-->
   @yield('showJS')
    
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
