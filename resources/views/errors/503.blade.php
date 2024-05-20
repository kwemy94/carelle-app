<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from codescandy.com/geeks-bootstrap-5/pages/maintenance-mode.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 18 May 2024 21:23:08 GMT -->
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

{{-- ====== Favicon Icon ====== --}}
<link rel="shortcut icon" href="{{ asset('front-template/assets/images/favicon-32x32.png') }}" type="image/svg" />
<link rel="apple-touch-icon" href="{{asset('front-template/assets/images/logo/logo.png')}}">



<!-- Libs CSS -->
<link href="{{ asset('front-end/assets/fonts/feather/feather.css') }}" rel="stylesheet">
<link href="{{ asset('front-end/assets/libs/bootstrap-icons/font/bootstrap-icons.css') }}" rel="stylesheet" />
<link href="{{ asset('front-end/assets/libs/%40mdi/font/css/materialdesignicons.min.css') }}" rel="stylesheet" />
<link href="{{ asset('front-end/assets/libs/simplebar/dist/simplebar.min.css') }}" rel="stylesheet">




<!-- Theme CSS -->
<link rel="stylesheet" href="{{ asset('front-end/assets/css/theme.min.css') }}">
 <title>Maintenance Mode | Tech Briva</title>
</head>

<body class="bg-white">
 <!-- Page Content -->
<main>
 <section class="container d-flex flex-column">
     <div class="row">
         <div class="offset-xl-1 col-xl-2 col-lg-3 col-md-12 col-12">
             <div class="mt-4" style="text-align: center">
             <a href="https://techbriva.com"><img style="width: 80px; height: 80px" src="https://techbriva.com/front-template/assets/images/logo/logo.png" alt="logo" class="logo-inverse"></a>
               <!-- theme switch -->
     <div class="form-check form-switch theme-switch d-none ">
        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
        <label class="form-check-label" for="flexSwitchCheckDefault"></label>
      </div>
            </div>
         </div>
     </div>
  <div class="row align-items-center justify-content-center g-0 py-lg-22 py-8">
   <!-- Docs -->
   <div class="offset-xl-1 col-xl-5 col-lg-6 col-md-12 col-12 text-center text-lg-start">
    <h3 class="display-3 mb-2 fw-bold">Nous corrigeons quelques problèmes en coulisses.</h3>

    <p class="mb-5 fs-4">
        Nous nous excusons pour la gêne occasionnée, mais nous procédons à des travaux de maintenance. Vous pouvez toujours nous contacter à l'adresse
        <a href="#">admin@techbriva.com</a>. Nous serons bientôt de retour</p>

    <hr class="my-5">
    <div>
        {{-- <h3 class="mb-3">Notify me when it’s ready.</h3> --}}
        {{-- <form class="d-inline-flex justify-content-center justify-content-lg-start">
            <label class="visually-hidden" for="subscribeInput">Email</label>
            <input type="email" class="form-control mb-2 me-2" id="subscribeInput" placeholder="Your e-mail...">
            <button type="submit" class="btn btn-primary mb-2">Subscribe</button>
          </form> --}}
    </div>

   </div>
   <!-- img -->
   <div class="offset-xl-1 col-xl-5 col-lg-6 col-md-12 col-12 mt-8 mt-lg-0">
    <img src="https://codescandy.com/geeks-bootstrap-5/assets/images/background/maintenance-mode.svg" alt="maintenance" class="w-100" />
   </div>
  </div>
  <div class="row">
    <div class="offset-xl-1 col-xl-10 col-lg-12 col-md-12 col-12">
        <div class="row align-items-center mt-6">
            <div class="col-md-6 col-8">
        <p class="mb-0">© Tech Briva {{ date('Y') }}. .</p>
    </div>
    
       </div>
    </div>
</div>
</section>
</main>

 <!-- Scripts -->
 <!-- Libs JS -->
<script src="{{ asset('front-end/assets/libs/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('front-end/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('front-end/assets/libs/simplebar/dist/simplebar.min.js') }}"></script>


<!-- Theme JS -->
<script src="{{ asset('front-end/assets/js/theme.min.js') }}"></script>


</body>

<!-- Mirrored from codescandy.com/geeks-bootstrap-5/pages/maintenance-mode.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 18 May 2024 21:23:08 GMT -->
</html>