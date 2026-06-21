<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{$profile->name}}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="{{asset('/assets/img/apple-icon.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href=""> <!--icono-->

    <link rel="stylesheet" href="{{asset('/assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('/assets/css/templatemo.css')}}">
    <link rel="stylesheet" href="{{asset('/assets/css/custom.css')}}">

    <!-- Load fonts style after rendering the layout styles -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link rel="stylesheet" href="{{asset('/assets/css/fontawesome.min.css')}}">
<!--
    
TemplateMo 559 Zay Shop

https://templatemo.com/tm-559-zay-shop

-->
</head>

<body>
    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-light shadow">
        <div class="container d-flex justify-content-between align-items-center">

            <a class="navbar-brand text-primary logo h1 align-self-center" href="index.html">
                Casa Ignacio
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#templatemo_main_nav" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="align-self-center collapse navbar-collapse flex-fill  d-lg-flex justify-content-lg-between" id="templatemo_main_nav">
                <div class="flex-fill">
                    <!--<ul class="nav navbar-nav d-flex justify-content-between mx-lg-auto">-->
                    <ul class="nav navbar-nav mx-lg-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('inicio')}}">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('catalog.products')}}">Productos</a>
                        </li>
                    </ul>
                </div>
                <div class="navbar align-self-center d-flex">
                    <div class="d-lg-none flex-sm-fill mt-3 mb-4 col-7 col-sm-auto pr-3">
                        <div class="input-group">
                            <input type="text" class="form-control" id="inputMobileSearch" placeholder="Buscar...">
                            <div class="input-group-text">
                                <i class="fa fa-fw fa-search"></i>
                            </div>
                        </div>
                    </div>
                    <a class="nav-icon d-none d-lg-inline" href="#" data-bs-toggle="modal" data-bs-target="#templatemo_search">
                        <i class="fa fa-fw fa-search text-dark mr-2"></i>
                    </a>
                    
                    @auth
                        @if(auth()->user()->role_id == 2)
                            <!-- Caso Cliente: El botón de login se transforma en el botón de Cerrar Sesión -->
                            <a class="nav-icon position-relative text-decoration-none text-danger" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('nav-logout-form').submit();" 
                            title="Cerrar sesión">
                                <i class="fa fa-fw fa-door-open text-danger mr-3"></i>
                            </a>
                            
                            <!-- Formulario oculto necesario para procesar el cierre de sesión seguro en Laravel -->
                            <form id="nav-logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        @else
                            {{-- Si es administrador (role_id 1) o cualquier otro rol, funciona normal --}}
                            <a class="nav-icon position-relative text-decoration-none" href="{{ route('login') }}">
                                <i class="fa fa-fw fa-user text-dark mr-3"></i>
                            </a>
                        @endif
                    @else
                        {{-- Si no ha iniciado sesión, el botón dirige al login normalmente --}}
                        <a class="nav-icon position-relative text-decoration-none" href="{{ route('login') }}">
                            <i class="fa fa-fw fa-user text-dark mr-3"></i>
                        </a>
                    @endauth

                </div>
            </div>

        </div>
    </nav>
    <!-- Close Header -->

    <!-- Modal -->
    <div class="modal fade bg-white" id="templatemo_search" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="w-100 pt-1 mb-5 text-right">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="get" class="modal-content modal-body border-0 p-0">
                <div class="input-group mb-2">
                    <input type="text" class="form-control" id="inputModalSearch" name="q" placeholder="Buscar ...">
                    <button type="submit" class="input-group-text bg-success text-light">
                        <i class="fa fa-fw fa-search text-white"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>

    @yield('content')

    <!-- Start Footer -->
<footer class="bg-dark text-light" id="tempaltemo_footer">
    <div class="container py-5">
        <div class="row g-4">

            <!-- Columna 1: Logo o Foto del Dueño y Nombre del Negocio -->
            <div class="col-md-5">
                <div class="d-flex align-items-center mb-3">
                    <!-- Icono de repuestos de auto por defecto si no hay foto -->
                    <div class="rounded-circle bg-primary text-dark d-flex align-items-center justify-content-center me-3" style="width: 60px; height: 60px;">
                        <i class="fas fa-cogs fa-lg"></i>
                    </div>
                    <h2 class="h3 text-primary mb-0 logo fw-bold">{{ $profile->name }}</h2>
                </div>
                <p class="text-secondary small">
                    Especialistas en la venta de autopartes, repuestos legítimos y accesorios mecánicos de alta calidad para garantizar el rendimiento de tu vehículo.
                </p>
            </div>

            <!-- Columna 2: Datos de Contacto Disponibles -->
            <div class="col-md-4 offset-md-3">
                <h5 class="h5 border-bottom pb-2 border-secondary text-primary fw-bold">Contacto Oficial</h5>
                <ul class="list-unstyled footer-link-list mt-3">
                    <li class="mb-2 d-flex align-items-center">
                        <i class="fa fa-envelope fa-fw text-primary me-2"></i>
                        <a class="text-light text-decoration-none text-break" href="mailto:{{ $profile->email }}">
                            {{ $profile->email }}
                        </a>
                    </li>
                    <li class="small text-secondary mt-3">
                        <i class="fas fa-id-card fa-fw text-primary me-2"></i>
                        <span class="text-uppercase">NIT / CI: {{ $profile->ci }}</span>
                    </li>
                </ul>
            </div>

        </div>

        <!-- Línea Divisoria -->
        <div class="row text-light mt-4">
            <div class="col-12">
                <div class="w-100 my-3 border-top border-secondary"></div>
            </div>
            
            <!-- Redes Sociales y Copyright -->
            <div class="col-md-6 text-center text-md-start align-self-center">
                <ul class="list-inline footer-icons mb-0">
                    <li class="list-inline-item border border-secondary rounded-circle text-center m-1" style="width: 40px; height: 40px; line-height: 40px;">
                        <a class="text-light text-decoration-none" target="_blank" href="https://facebook.com"><i class="fab fa-facebook-f"></i></a>
                    </li>
                    <li class="list-inline-item border border-secondary rounded-circle text-center m-1" style="width: 40px; height: 40px; line-height: 40px;">
                        <a class="text-light text-decoration-none" target="_blank" href="https://www.instagram.com/"><i class="fab fa-instagram"></i></a>
                    </li>
                </ul>
            </div>
            
            <div class="col-md-6 text-center text-md-end mt-3 mt-md-0 small text-secondary">
                <p class="mb-0">&copy; {{ date('Y') }} {{ $profile->name }}. Todos los derechos reservados.</p>
            </div>
        </div>
    </div>
</footer>

    <!-- End Footer -->

    <!-- Start Script -->
    <script src="{{asset('/assets/js/jquery-1.11.0.min.js')}}"></script>
    <script src="{{asset('/assets/js/jquery-migrate-1.2.1.min.js')}}"></script>
    <script src="{{asset('/assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('/assets/js/templatemo.js')}}"></script>
    <script src="{{asset('/assets/js/custom.js')}}"></script>
</body>

</html>