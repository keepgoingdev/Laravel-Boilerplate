<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>ERAS SFTS</title>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    
    <script src="https://eras.eirsautomation.xyz/Content/Plugins/bootstrap-select/js/bootstrap-select.min.js"></script>
    
    <link rel="stylesheet" type="text/css" href="https://eras.eirsautomation.xyz/Content/Plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://eras.eirsautomation.xyz/Content/Fonts/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="https://eras.eirsautomation.xyz/Content/Fonts/simple-line-icons/simple-line-icons.css">
    <link rel="stylesheet" type="text/css" href="https://eras.eirsautomation.xyz/Content/Plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="https://eras.eirsautomation.xyz/Content/Plugins/bootstrap-select/css/bootstrap-select.min.css">
    <link rel="stylesheet" type="text/css" href="https://eras.eirsautomation.xyz/Content/Styles/Common/components.min.css">
    <link rel="stylesheet" type="text/css" href="https://eras.eirsautomation.xyz/Content/Styles/Common/layout.min.css">
    <link rel="stylesheet" type="text/css" href="https://eras.eirsautomation.xyz/Content/Styles/Common/plugins.min.css">
    <link rel="stylesheet" type="text/css" href="https://eras.eirsautomation.xyz/Content/Styles/Common/theme.min.css">
    <link rel="stylesheet" type="text/css" href="https://eras.eirsautomation.xyz/Content/Styles/Web/custom.css">


    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    @include('admin.layouts.header')
    <section class="alternate">
        <div class="container">
            @yield('content')
        </div>
    </section>
    @include('admin.layouts.footer')

    <script type="text/javascript" src="https://eras.eirsautomation.xyz/Content/Scripts/jquery.min.js"></script>
    <script type="text/javascript" src="https://eras.eirsautomation.xyz/Content/Scripts/jquery.validate.min.js"></script>
    <script type="text/javascript" src="https://eras.eirsautomation.xyz/Content/Scripts/jquery.unobtrusive-ajax.min.js"></script>
    <script type="text/javascript" src="https://eras.eirsautomation.xyz/Content/Scripts/jquery.validate.unobtrusive.min.js"></script>
    <script type="text/javascript" src="https://eras.eirsautomation.xyz/Content/Plugins/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://eras.eirsautomation.xyz/Content/Plugins/bootstrap-select/js/bootstrap-select.min.js"></script>
    <script type="text/javascript" src="https://eras.eirsautomation.xyz/Content/Plugins/datatables/datatables.min.js"></script>
    <script type="text/javascript" src="https://eras.eirsautomation.xyz/Content/Plugins/datatables/datatables.all.min.js"></script>
    <script type="text/javascript" src="https://eras.eirsautomation.xyz/Content/Plugins/datatables/plugins/bootstrap/datatables.bootstrap.js"></script>
    <script type="text/javascript" src="https://eras.eirsautomation.xyz/Content/FormScripts/jsCommon.js"></script>
    <script type="text/javascript" src="https://eras.eirsautomation.xyz/Content/FormScripts/jsBusinessProfile.js"></script>

</body>
</html>
