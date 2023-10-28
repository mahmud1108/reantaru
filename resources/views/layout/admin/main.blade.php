<!doctype html>
<!--
* Bootstrap Simple Admin Template
* Version: 2.1
* Author: Alexis Luna
* Website: https://github.com/alexis-luna/bootstrap-simple-admin-template
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ $title }}</title>
    <link href="{{ asset('template/assets/vendor/fontawesome/css/fontawesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('template/assets/vendor/fontawesome/css/solid.min.css') }}" rel="stylesheet">
    <link href="{{ asset('template/assets/vendor/fontawesome/css/brands.min.css') }}" rel="stylesheet">
    <link href="{{ asset('template/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('template/assets/css/master.css') }}" rel="stylesheet">
    <link href="{{ asset('template/assets/vendor/flagiconcss/css/flag-icon.min.css') }}" rel="stylesheet">
    <link href="{{ asset('template/assets/vendor/datatables/datatables.min.css') }}" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>

</head>

<body>

    @include('sweetalert::alert')

    <div class="wrapper">

        @include('components.admin.sidebar')

        <div id="body" class="active">

            @include('components.admin.top-menu')

            <div class="content">
                <div class="container">

                    @yield('content')

                </div>
            </div>

        </div>
    </div>

    @yield('javascript')

    <script src="{{ asset('template/assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('template/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('template/assets/js/script.js') }}"></script>
    <script src="{{ asset('template/assets/vendor/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('template/assets/js/initiate-datatables.js') }}"></script>
</body>

</html>
