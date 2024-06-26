<!DOCTYPE html>
<html lang="en">


<!-- -->
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
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-M8S4MT3EYG');
</script>



<script>
    // Render blocking JS:
    if (localStorage.theme) document.documentElement.setAttribute("data-theme", localStorage.theme);
    </script>

<!-- Favicon icon-->
<link rel="shortcut icon" href="{{ asset('front-template/assets/images/favicon-32x32.png') }}" type="image/svg" />
<link rel="apple-touch-icon" href="{{asset('front-template/assets/images/logo/logo.png')}}">


<!-- Libs CSS -->
<link href="{{ asset('front-end/assets/fonts/feather/feather.css') }}" rel="stylesheet">
<link href="{{ asset('front-end/assets/libs/bootstrap-icons/font/bootstrap-icons.css') }}" rel="stylesheet" />
<link href="{{ asset('front-end/assets/libs/%40mdi/font/css/materialdesignicons.min.css') }}" rel="stylesheet" />
<link href="{{ asset('front-end/assets/libs/simplebar/dist/simplebar.min.css') }}" rel="stylesheet">




<!-- Theme CSS -->
<link rel="stylesheet" href="{{ asset('front-end/assets/css/theme.min.css') }}">
 <title>404 Error | Tech Briva</title>
</head>

<body class="bg-white">
 <!-- Page Content -->
<main>
 <section class="container d-flex flex-column">
  <div class="row">
   <div class="offset-xl-1 col-xl-2 col-lg-12 col-md-12 col-12">
    <div class="mt-4">
     <a href="https://techbriva.com"><img src="{{ asset('images/logo.png') }}" alt="" class="logo-inverse"></a>
    <!-- theme switch -->
     <div class="form-check form-switch theme-switch d-none ">
        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
        <label class="form-check-label" for="flexSwitchCheckDefault"></label>
      </div>
    </div>
   </div>
  </div>
  <div class="row align-items-center justify-content-center g-0 py-lg-22 py-10">
   <!-- Docs -->
   <div class="offset-xl-1 col-xl-4 col-lg-6 col-md-12 col-12 text-center text-lg-start">
    <h1 class="display-1 mb-3">404</h1>

    <p class="mb-5 lead px-4 px-md-0">Oops! Sorry, we couldn’t find the page you were looking for. If you think this is a
     problem with us, please <a href="#" class="btn-link">Contact us</a></p>
    <a href="{{ route('home') }}" class="btn btn-primary me-2">Back to Safety</a>
   </div>
   <!-- img -->
   <div class="offset-xl-1 col-xl-6 col-lg-6 col-md-12 col-12 mt-8 mt-lg-0">
    <img src="https://codescandy.com/geeks-bootstrap-5/assets/images/error/404-error-img.svg" alt="error" class="w-100" />
   </div>
  </div>
  <div class="row">
   <div class="offset-xl-1 col-xl-10 col-lg-12 col-md-12 col-12">
    <div class="row align-items-center mt-6">
     <div class="col-md-6 col-8">
      <p class="mb-0">© Tech Briva. {{ date('Y') }} </p>
     </div>
     <div class="col-md-6 col-4 d-flex justify-content-end">
      
     </div>
    </div>
   </div>
  </div>
 </section>
</main>


 {{--  Scripts -->
 <!-- Libs JS  --}}
<script src="{{ asset('front-end/assets/libs/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('front-end/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('front-end/assets/libs/simplebar/dist/simplebar.min.js') }}"></script>


{{-- <!-- Theme JS --> --}}
<script src="{{ asset('front-end/assets/js/theme.min.js') }}"></script>


</body>



</html>