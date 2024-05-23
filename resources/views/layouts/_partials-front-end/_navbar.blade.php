<nav class="navbar navbar-expand-lg">
    <div class="container-fluid px-0">
        <a class="" href="https://techbriva.com" target="_blank">
            <img style="width: 45px; height:45px; border-radius: 50px" src="{{ asset('images/logo.png') }}" alt="">
        </a>
        <!-- Mobile view nav wrap -->

        <div class="ms-auto d-flex align-items-center order-lg-3">

            <div>
                <a href="#" class="form-check form-switch theme-switch btn btn-light btn-icon rounded-circle">
                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                    <label class="form-check-label" for="flexSwitchCheckDefault"></label>

                </a>
            </div>
            <ul class="navbar-nav navbar-right-wrap mx-2 flex-row">


                <li class="dropdown ms-2 d-inline-block position-static">
                    <a class="rounded-circle" href="#" data-bs-toggle="dropdown" data-bs-display="static"
                        aria-expanded="false">
                        <div class="avatar avatar-md avatar-indicators avatar-online">
                            <img alt="avatar" src="{{ asset('front-end/assets/images/avatar/avatar-00.jpg') }}"
                                class="rounded-circle">
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end position-absolute mx-3 my-5">

                        <div class="dropdown-divider"></div>
                        <ul class="list-unstyled">
                            @auth
                                <li>
                                    <a class="dropdown-item" href="{{ route('dashboard') }}">
                                        <i class="fe fe-user me-2"></i>Dashboard
                                    </a>
                                </li>
                                <li>
                                    <form  method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <a href="{{ route('logout') }}" class="dropdown-item"
                                        onclick="event.preventDefault();
                                            this.closest('form').submit();">
                                            <i class="fe fe-power me-2"></i>
                                        {{ __('Sign Out') }}
                                    </a>
                                    </form>
                                    
                                </li>
                            @else
                                <li>
                                    <a class="dropdown-item" href="{{ route('login') }}">
                                        <i class="fe fe-user me-2"></i>Connexion
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('register') }}">
                                        <i class="fe fe-star me-2"></i>Subscription
                                    </a>
                                </li>
                            @endauth



                        </ul>
                        <div class="dropdown-divider"></div>

                    </div>
                </li>
            </ul>
        </div>
        <div>
            <!-- Button -->
            <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbar-default" aria-controls="navbar-default" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="icon-bar top-bar mt-0"></span>
                <span class="icon-bar middle-bar"></span>
                <span class="icon-bar bottom-bar"></span>
            </button>
        </div>
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="navbar-default">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="dropdown-item" href="{{ route('home') }}">
                        Accueil
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarBrowse" data-bs-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false" data-bs-display="static">
                        About
                    </a>
                    <ul class="dropdown-menu dropdown-menu-arrow" aria-labelledby="navbarBrowse">

                        <li>
                            <a href="{{ route('home') }}" class="dropdown-item">
                                Tech
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('home') }}" class="dropdown-item">
                                Briva
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>

        </div>

    </div>
</nav>
