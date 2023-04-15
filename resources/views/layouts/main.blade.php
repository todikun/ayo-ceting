<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>@yield('title') | AyoCeting</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" />
    <script type="text/javascript" src="//code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Vendor CSS Files -->
    <link href="{{asset('dist/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('dist/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
    <link href="{{asset('dist/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
    <link href="{{asset('dist/vendor/quill/quill.snow.css')}}" rel="stylesheet">
    <link href="{{asset('dist/vendor/quill/quill.bubble.css')}}" rel="stylesheet">
    <link href="{{asset('dist/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
    <link href="{{asset('dist/vendor/simple-datatables/style.css')}}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{asset('dist/css/style.css')}}" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    @stack('css')
    <!-- =======================================================
  * Template Name: NiceAdmin - v2.5.0
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        @include('includes.navbar')

    </header><!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

        @include('includes.sidebar')

    </aside><!-- End Sidebar-->

    <main id="main" class="main">
        <section class="section dashboard">
            <div class="row">
                @yield('content')
            </div>
        </section>

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        @include('includes.footer')
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{asset('dist/vendor/apexcharts/apexcharts.min.js')}}"></script>
    <script src="{{asset('dist/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('dist/vendor/chart.js/chart.umd.js')}}"></script>
    <script src="{{asset('dist/vendor/echarts/echarts.min.js')}}"></script>
    <script src="{{asset('dist/vendor/tinymce/tinymce.min.js')}}"></script>
    <script src="{{asset('dist/vendor/quill/quill.min.js')}}"></script>
    <script src="{{asset('dist/vendor/simple-datatables/simple-datatables.js')}}"></script>

    <!-- Template Main JS File -->
    <script src="{{asset('dist/js/main.js')}}"></script>

    @stack('script')

    <script>
        const user = document.querySelector('#user-logged');
        
        // get localStorage
        const getSession = localStorage.getItem('session');
        user.innerHTML = getSession;
        
    </script>
</body>

</html>