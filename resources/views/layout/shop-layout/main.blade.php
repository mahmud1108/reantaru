<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="meta description">
    <title>Rentaru Digital Printing</title>

    <!--=== Favicon ===-->
    <link rel="shortcut icon" href="assets/img/logo.ico" type="image/x-icon" />

    <!-- Google fonts include -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,900%7CYesteryear"
        rel="stylesheet">

    <!-- All Vendor & plugins CSS include -->
    <link href="assets/css/vendor.css" rel="stylesheet">
    <!-- Main Style CSS -->
    <link href="assets/css/style.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>

</head>

<body>

    <!-- Start Header Area -->
    @include('components.shop.header')
    <!-- end Header Area -->

    <!-- off-canvas menu start -->
    @include('components.shop.aside')
    <!-- off-canvas menu end -->

    @yield('shop-content')

    <!-- Start Footer Area Wrapper -->
    @include('components.shop.footer')
    <!-- End Footer Area Wrapper -->

    @include('components.shop.modal')

    <!-- Scroll to top start -->
    <div class="scroll-top not-visible">
        <i class="fa fa-angle-up"></i>
    </div>

    @yield('javascript')

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <script src="assets/js/vendor.js"></script>
    <!-- Active Js -->
    <script src="assets/js/active.js"></script>
</body>

</html>
