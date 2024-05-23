<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from codescandy.com/geeks-bootstrap-5/pages/sign-in.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 18 May 2024 21:23:13 GMT -->
<head>  <!-- Required meta tags -->
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
<link rel="shortcut icon" href="{{ asset('images/favicon-32x32.png') }}" type="image/svg" />
    <link rel="apple-touch-icon" href="{{ asset('images/logo.png') }}">


<!-- Libs CSS -->
<link href="{{ asset('front-end/assets/fonts/feather/feather.css') }}" rel="stylesheet">
<link href="{{ asset('front-end/assets/libs/bootstrap-icons/font/bootstrap-icons.css') }}" rel="stylesheet" />
<link href="{{ asset('front-end/assets/libs/%40mdi/font/css/materialdesignicons.min.css') }}" rel="stylesheet" />
<link href="{{ asset('front-end/assets/libs/simplebar/dist/simplebar.min.css') }}" rel="stylesheet">




<!-- Theme CSS -->
<link rel="stylesheet" href="{{ asset('front-end/assets/css/theme.min.css') }}">
  <title>Connexion | Tech Briva </title>
</head>

<body>
  <!-- Page content -->
<main>
  <section class="container d-flex flex-column">
    <div class="row align-items-center justify-content-center g-0 min-vh-100">

      <div class="col-lg-5 col-md-8 py-8 py-xl-0">
        <!-- Card -->
        <div class="card shadow ">
          <!-- Card body -->
          <div class="card-body p-6">
            <div class="mb-4" style="text-align: center">
              <a href="{{ route('home') }}"><img style="width: 70px; height: 70px; border-radius: 50%;" src="{{ asset('images/logo.png') }}" class="mb-4" alt="logo-icon"></a>
              <h1 class="mb-1 fw-bold">Connexion</h1>
              <span>Pas de compte? <a href="{{ route('register') }}" class="ms-1">Créer un compte</a></span>
            </div>
            <!-- Form -->
            <form method="POST" action="{{ route('login') }}">
              	<!-- Username -->
                @csrf
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" class="form-control" name="email" placeholder="Email address here"
                  required>
              </div>
              	<!-- Password -->
              <div class="mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" id="password" class="form-control" name="password" placeholder="**************"
                  required>
              </div>
              	<!-- Checkbox -->
              <div class="d-lg-flex justify-content-between align-items-center mb-4">
                <div class="form-check">
                  <input type="checkbox" class="form-check-input" id="rememberme">
                  <label class="form-check-label " for="rememberme">Remember me</label>
                </div>
                <div>
                  {{-- <a href="forget-password.html">Forgot your password?</a> --}}
                </div>
              </div>
              <div>
                	<!-- Button -->
                  <div class="d-grid">
                <button type="submit" class="btn btn-primary ">Sign in</button>
              </div>
              </div>
              <hr class="my-4">
              
            </form>
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


<!-- Mirrored from codescandy.com/geeks-bootstrap-5/pages/sign-in.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 18 May 2024 21:23:13 GMT -->
</html>