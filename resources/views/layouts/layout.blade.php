<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from codescandy.com/geeks-bootstrap-5/pages/student-quiz-start.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 18 May 2024 21:21:08 GMT -->

<head> <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="Codescandy">

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-M8S4MT3EYG"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-M8S4MT3EYG');
    </script>



    <script>
        // Render blocking JS:
        if (localStorage.theme) document.documentElement.setAttribute("data-theme", localStorage.theme);
    </script>

    {{-- ====== Favicon Icon ====== --}}
    <link rel="shortcut icon" href="{{ asset('images/favicon-32x32.png') }}" type="image/svg" />
    <link rel="apple-touch-icon" href="{{ asset('images/logo.png') }}">



    <!-- Libs CSS -->
    <link href="{{ asset('front-end/assets/fonts/feather/feather.css') }}" rel="stylesheet" />
    <link href="{{ asset('front-end/assets/libs/bootstrap-icons/font/bootstrap-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('front-end/assets/libs/%40mdi/font/css/materialdesignicons.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('front-end/assets/libs/simplebar/dist/simplebar.min.css') }}" rel="stylesheet">

    {{-- toast alert --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" rel="stylesheet">


    <!-- Theme CSS -->
    <link rel="stylesheet" href="{{ asset('front-end/assets/css/theme.min.css') }}">
    <title>Quiz Tech Briva</title>

    @yield('front-end-css')
</head>

<body>
    @include('layouts._partials-front-end._navbar')
    <!-- Page Content -->
    <main>
        <section class="pt-5 pb-5">
            <div class="container">
                <!-- User info -->
                @include('layouts._partials-front-end._nav_header_quiz')

                <!-- Content -->

                <div class="row mt-0 mt-md-4">
                    @include('layouts._partials-front-end._sidebar')

                    @yield('front-content')

                </div>
            </div>
        </section>
    </main>

    {{-- Footer  --}}
    @include('layouts._partials-front-end._footer')


    <!-- Scripts -->
    <!-- Libs JS -->
    <script src="{{ asset('front-end/assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('front-end/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('front-end/assets/libs/simplebar/dist/simplebar.min.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script>
        @if (Session::has('message'))
            var type = "{{ Session::get('alert-type', 'info') }}"
            switch (type) {
                case 'info':

                    toastr.options.timeOut = 10000;
                    toastr.info("{{ Session::get('message') }}");
                    var audio = new Audio('audio.mp3');
                    audio.play();
                    break;
                case 'success':

                    toastr.options.timeOut = 10000;
                    toastr.success("{{ Session::get('message') }}");
                    var audio = new Audio('audio.mp3');
                    audio.play();

                    break;
                case 'warning':

                    toastr.options.timeOut = 10000;
                    toastr.warning("{{ Session::get('message') }}");
                    var audio = new Audio('audio.mp3');
                    audio.play();

                    break;
                case 'error':

                    toastr.options.timeOut = 10000;
                    toastr.error("{{ Session::get('message') }}");
                    var audio = new Audio('audio.mp3');
                    audio.play();

                    break;
            }
        @endif
    </script>
    @yield('front-js')
    <!-- Theme JS -->
    <script src="{{ asset('front-end/assets/js/theme.min.js') }}"></script>

    <script src="{{ asset('front-end/assets/libs/bs-stepper/dist/js/bs-stepper.min.js') }}"></script>
    <script src="{{ asset('front-end/assets/js/vendors/beStepper.js') }}"></script>

</body>


<!-- Mirrored from codescandy.com/geeks-bootstrap-5/pages/student-quiz-start.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 18 May 2024 21:21:36 GMT -->

</html>
