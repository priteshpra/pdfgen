<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="">

    <meta name="author" content="">

    <link rel="icon" href="{{ asset('admin_assets/images_new/favicon.ico') }}">



    <title>PDF Generator </title>



    <!-- Vendors Style-->

    <link rel="stylesheet" href="{{ asset('admin_assets/css_new/vendors_css.css') }}">



    <!-- Style-->

    <link rel="stylesheet" href="{{ asset('admin_assets/css_new/style.css') }}">

    <link rel="stylesheet" href="{{ asset('admin_assets/css_new/skin_color.css') }}">



</head>



<body class="hold-transition theme-primary bg-img" style="background-image: url(../public/admin_assets/images_new/auth-bg/bg-1.jpg)">



    <div class="container h-p100">
        @yield('content')
    </div>
    <!-- Vendor JS -->
    <script src="{{ asset('admin_assets/js_new/vendors.min.js') }}"></script>
    <script src="{{ asset('admin_assets/js_new/pages/chat-popup.js') }}"></script>
    <script src="{{ asset('admin_assets/assets/icons/feather-icons/feather.min.js') }}"></script>
</body>

</html>