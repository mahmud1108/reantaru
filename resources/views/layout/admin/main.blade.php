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
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet" />
</head>

<style>
    .elemen-halus {
        opacity: 1;
        transition: opacity 6s;
    }

    .elemen-hilang {
        opacity: 0;
    }
</style>

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
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <!-- include summernote css/js -->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

    <script>
        $('#summernote').summernote({
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['fontsize', ['fontsize']],
                ['para', ['ul', 'ol']],
            ]
        });
    </script>

    <script>
        $(document).ready(function() {
            var elemenList = document.querySelectorAll(".elemen-halus");

            elemenList.forEach(function(elemen) {
                elemen.classList.add("elemen-hilang");

                setTimeout(function() {
                    elemen.parentNode.removeChild(elemen);
                }, 6000); // Menunggu 1 detik (sesuai dengan durasi transisi)
            });
        });
    </script>

    <script src="{{ asset('template/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('template/assets/js/script.js') }}"></script>
    <script src="{{ asset('template/assets/vendor/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('template/assets/js/initiate-datatables.js') }}"></script>
</body>

</html>
