<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Datech || Los Mejores Precios</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"
        />


    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('css/estil.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/vistas.js') }}"></script>

</head>

<body>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-xl navbar-light bg-light w-100">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="#!">Datech</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="{{ route('welcome') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">About</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Shop</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#!">All Products</a></li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>
                            <li><a class="dropdown-item" href="#!">Popular Items</a></li>
                            <li><a class="dropdown-item" href="#!">New Arrivals</a></li>
                        </ul>
                    </li>
                    <div class="input-group mb-5">
                        <input type="text" class="form-control w-500" placeholder="Busca Producto" aria-label="Buscar" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button"><i class="bi bi-search"></i></button>
                        </div>
                    </div>
                </ul>
                <form class="d-flex">
                    @csrf
                    @auth('cliente')
                    <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10 pad">
                        <a href="{{ route('logout') }}" class="btn btn-outline-danger">Cerrar Sesion</a>
                    </div>
                    @else
                    <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                        <a href="{{ route('logi') }}" class="btn btn-outline-primary">Inicia Secion Cliente</a>
                    </div>
                    @endauth
                    @if (Route::has('login'))
                    <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                        @auth
                        <a href="{{ url('/dashboard') }}" class="btn btn-outline-primary">Dashboard</a>
                        @else
                        <a href="{{ route('login') }}" class="btn btn-outline-primary">Inicia Secion Admin</a>
                        @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-outline-primary">Register</a>
                        @endif
                        @endauth
                    </div>
                    @endif
                </form>
            </div>
        </div>
    </nav>