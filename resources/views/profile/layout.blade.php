<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Immo Bénin - Dashboard</title>

    <!-- Bootstrap et autres styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendor.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/style.css') }}">

    <!-- Police Google et CSS additionnel -->
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Work Sans', sans-serif;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 250px;
            background-color: #343a40;
            color: white;
            padding-top: 1rem;
            padding-left: 10px z-index: 1000;
        }

        .sidebar .nav-link,
        .sidebar .dropdown-item {
            color: #adb5bd;
        }

        .sidebar .nav-link:hover,
        .sidebar .dropdown-item:hover,
        .sidebar .nav-link.active {
            color: #ffffff;
            background-color: #495057;
            border-radius: 0.375rem;
        }

        .content-wrapper {
            margin-left: 250px;
            padding: 2rem;
        }

        .card {
            border: none;
        }
    </style>
</head>

<body>

    <div class="d-flex">
        <!-- Sidebar -->
        <nav class="sidebar shadow">
            <div class="text-center mb-4">
                <a href="/">
                    <h4>Immo Bénin</h4>
                </a>
            </div>
            <ul class="navbar-nav flex-column text-white">
                <li class="nav-item py-2">
                    <a class="nav-link {{ request()->routeIs('profile') ? 'active' : '' }}"
                        href="{{ route('profile') }}">
                        <i class="bi bi-speedometer2"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item dropdown py-2">
                    <a class="nav-link dropdown-toggle text-white" data-bs-toggle="dropdown" href="#"
                        role="button" aria-expanded="false">
                        <i class="bi bi-house"></i> Vos Annonces
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark">
                        <li><a href="{{ route('profile.properties') }}" class="dropdown-item">Liste des annonces</a>
                        </li>
                        <li><a href="{{ route('property.xyz.create') }}" class="dropdown-item">Créer une annonce</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item py-2">
                    <a class="nav-link {{ request()->routeIs('profile.edit') ? 'active' : '' }}"
                        href="{{ route('profile.edit') }}">
                        <i class="bi bi-gear"></i> Paramètres
                    </a>
                </li>
                <li class="nav-item py-2">
                    <a class="nav-link {{ request()->routeIs('profile.notification') ? 'active' : '' }}"
                        href="{{ route('profile.notification') }}">
                        <i class="bi bi-bell"></i> Notification
                    </a>
                </li>
                <li class="nav-item py-2">
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button class="dropdown-item text-white bg-transparent border-0" style="text-align: left;">
                            <i class="bi bi-box-arrow-left"></i> Se déconnecter
                        </button>
                    </form>
                </li>
            </ul>
        </nav>

        <!-- Contenu principal -->
        <div class="content-wrapper">
            <section class="py-5">
                <div>
                    <!-- Contenu du profil -->
                    <div class="card shadow-sm">
                        <div class="card-body p-4">
                            @yield('profile')
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="{{ asset('assets/js/jquery-1.11.0.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <script src="{{ asset('assets/js/script.js') }}"></script>
</body>

</html>
