<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Immo Bénin</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendor.css') }}">

    <!-- Link Swiper's CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />


    <!-- Link Bootstrap's CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <link rel="stylesheet" href="{{ asset('assets/style.css') }}">

    <!-- Google Fonts ================================================== -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- script ================================================== -->
    <script src="{{ asset('assets/js/modernizr.js') }}"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</head>

<body data-bs-spy="scroll" data-bs-target="#navbar-example2" tabindex="0">
    <header id="nav" class="site-header position-fixed text-white bg-dark">
        <nav id="navbar-example2" class="navbar navbar-expand-lg py-2">

            <div class="container ">

                <a class="navbar-brand" href="/"><img src="{{ asset('assets/images/logo.png') }}"
                        alt="image"></a>


                <button class="navbar-toggler text-white" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasNavbar2" aria-controls="offcanvasNavbar2"
                    aria-label="Toggle navigation"><ion-icon name="menu-outline"
                        style="font-size: 30px;"></ion-icon></button>

                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar2"
                    aria-labelledby="offcanvasNavbar2Label">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasNavbar2Label">Menu</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                            aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="navbar-nav align-items-center justify-content-end align-items-center flex-grow-1 ">
                            <li class="nav-item">
                                <a class="nav-link  me-md-4 {{ request()->routeIs('welcome') ? 'active' : '' }}" href="/">Accueil</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link me-md-4 {{ request()->routeIs('about') ? 'active' : '' }}" href="/about">A propos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link me-md-4 {{ request()->routeIs('contact') ? 'active' : '' }}" href="/contact">Contact</a>
                            </li>
                            <li class="nav-item dropdown ">
                                <a class="nav-link me-md-4 text-center dropdown-toggle" data-bs-toggle="dropdown"
                                    href="#" role="button" aria-expanded="false">Annonces</a>
                                <ul class="dropdown-menu dropdown-menu-dark">
                                    
                                        <li><a href="{{ route('search-property', ['type' => 1]) }}"class="dropdown-item">Appartement</a></li>
                                        <li><a href="{{ route('search-property', ['type' => 2]) }}"class="dropdown-item">Maison</a></li>
                                        <li><a href="{{ route('search-property', ['type' => 3]) }}"class="dropdown-item">Studio</a></li>
                                        <li><a href="{{ route('search-property', ['type' => 4]) }}"class="dropdown-item">Terrain</a></li>
                                        <li><a href="{{ route('search-property', ['type' => 5]) }}"class="dropdown-item">Villa</a></li>
                                        <li><a href="{{ route('search-property', ['type' => 6]) }}"class="dropdown-item">Chalet</a></li>
                                    
                                    <li><a href="index.html" class="dropdown-item">FAQs</a></li>
                                </ul>

                            </li>
                            <!-- Modal -->
                            @if (Auth::check())
                                <!-- Affiche l'avatar de l'utilisateur connecté -->
                                <li class="nav-item dropdown">
                                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        <img src="{{ Auth::user()->picture ? asset('storage/' . Auth::user()->picture) : asset('assets/images/logo.png') }}"
                                            alt="Avatar" class="rounded-circle" width="40" height="40"
                                            style="object-fit: cover">
                                        <span class="ms-2">{{ Auth::user()->name }}</span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-dark mt-2">
                                        <li><a href="{{ route('profile') }}" class="dropdown-item">Profile</a></li>
                                        <li>
                                            <form action="{{ route('logout') }}" method="post">
                                                @csrf
                                                @method('POST')
                                                <button class="dropdown-item">
                                                    Se déconnecter
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </li>
                            @else
                                <!-- Affiche le bouton de connexion si l'utilisateur n'est pas connecté -->
                                <li class="nav-item">
                                    <a class="btn btn-primary btn-medium" href="#" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal2">Connexion</a>
                                </li>
                                @include('components.authentification-modal')
                            @endif

                        </ul>
                    </div>
                </div>

            </div>
        </nav>
    </header>

    {{-- le corps du site --}}
    @yield('content')


    <!-- Footer start  -->
    @include('components.footer')
    <script src="{{ asset('assets/js/jquery-1.11.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/script.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</body>

</html>
