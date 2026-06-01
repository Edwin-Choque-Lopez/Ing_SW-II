@extends('layouts.web')

@section('content')
<!-- Start Banner Hero -->
    <div id="template-mo-zay-hero-carousel" class="carousel slide" data-bs-ride="carousel">
        <ol class="carousel-indicators">
            @foreach ($categories as $categorie)
                <li 
                    data-bs-target="#template-mo-zay-hero-carousel" 
                    data-bs-slide-to="{{ $loop->index }}" 
                    class="{{ $loop->first ? 'active' : '' }}">
                </li>
            @endforeach
        </ol>
        <div class="carousel-inner">
            <div class="row text-center pt-3">
            <div class="col-lg-6 m-auto">
                <h1 class="h1 text-dark fw-bold">Encuentra el Repuesto Exacto para tu Vehículo</h1>
            </div>
        </div>
            @foreach ($categories as $categorie)
                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                    <div class="container">
                        <div class="row p-5">
                            <div class="mx-auto col-md-8 col-lg-6 order-lg-last d-flex align-items-center">
                                <img class="img-fluid" style="border-radius: 10%" src="{{ $categorie->photo ? asset('storage/' . $categorie->photo) : '' }}" alt="">
                            </div>
                            <div class="col-lg-6 mb-0 d-flex align-items-center">
                                <div class="text-align-left align-self-center">
                                    <h1 class="h1 text-primary">{{$categorie->name}}</h1>
                                    <p>
                                        {{ $categorie->description ?? 'Sin descripción disponible' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <a class="carousel-control-prev text-decoration-none w-auto ps-3" href="#template-mo-zay-hero-carousel" role="button" data-bs-slide="prev">
            <i class="fas fa-chevron-left"></i>
        </a>
        <a class="carousel-control-next text-decoration-none w-auto pe-3" href="#template-mo-zay-hero-carousel" role="button" data-bs-slide="next">
            <i class="fas fa-chevron-right"></i>
        </a>
    </div>
    <!-- End Banner Hero -->


    <!-- Start Categories of The Month -->
    <section class="container py-5">
        <!-- Encabezado con Nombre y Descripción de la Empresa -->
        <div class="row text-center pt-3">
            <div class="col-lg-8 m-auto">
                <!-- Mostramos el Logo de la Empresa si existe, si no, un icono mecánico -->
                <div class="mb-4">
                    @if($institution->logo_path)
                        <img src="{{ asset('storage/' . $institution->logo_path) }}" 
                            alt="Logo {{ $institution->name }}" 
                            class="rounded-circle img-fluid border p-2 bg-white" 
                            style="width: 140px; height: 140px; object-fit: cover; box-shadow: 0px 4px 10px rgba(0,0,0,0.1);">
                    @else
                        <div class="rounded-circle bg-dark text-primary d-inline-flex align-items-center justify-content-center border" style="width: 140px; height: 140px;">
                            <i class="fas fa-tools fa-3x"></i>
                        </div>
                    @endif
                </div>
                
                <h1 class="h1 fw-bold text-dark">{{ $institution->name }}</h1>
                <p class="text-muted mt-3 fs-5">
                    {{ $institution->description ?? 'Tu socio de confianza en la provisión de autopartes y repuestos de alta calidad.' }}
                </p>
            </div>
        </div>

        <!-- Bloques con Información de Contacto y Datos del Negocio -->
        <div class="row mt-4 g-4">
            
            <!-- Columna 1: Dirección Física -->
            <div class="col-12 col-md-4 text-center px-4">
                <div class="p-4 rounded shadow-sm bg-white h-100 border-top border-4 border-success">
                    <div class="text-success mb-3">
                        <i class="fas fa-map-marked-alt fa-3x"></i>
                    </div>
                    <h3 class="h5 fw-bold text-secondary mb-3">Nuestra Sucursal</h3>
                    <p class="text-muted mb-0 small">
                        {{ $institution->address }}
                    </p>
                </div>
            </div>

            <!-- Columna 2: Contacto Directo y WhatsApp -->
            <div class="col-12 col-md-4 text-center px-4">
                <div class="p-4 rounded shadow-sm bg-white h-100 border-top border-4 border-success">
                    <div class="text-success mb-3">
                        <i class="fab fa-whatsapp fa-3x"></i>
                    </div>
                    <h3 class="h5 fw-bold text-secondary mb-2">Atención Inmediata</h3>
                    <p class="text-muted mb-3 small">{{ $institution->email }}</p>
                    <p class="mb-0">
                        <!-- Botón interactivo que abre el chat de WhatsApp directamente -->
                        <a href="https://wa.me{{ $institution->phone_whatsapp }}" target="_blank" class="btn btn-success px-4 py-2 rounded-pill fw-bold">
                            <i class="fab fa-whatsapp me-2"></i>Contactanos por WhatsApp
                        </a>
                    </p>
                </div>
            </div>

            <!-- Columna 3: Información Legal y Operación -->
            <div class="col-12 col-md-4 text-center px-4">
                <div class="p-4 rounded shadow-sm bg-white h-100 border-top border-4 border-success">
                    <div class="text-success mb-3">
                        <i class="fas fa-building fa-3x"></i>
                    </div>
                    <h3 class="h5 fw-bold text-secondary mb-3">Datos Fiscales</h3>
                    <ul class="list-unstyled text-muted small mb-0">
                        <li class="mb-2"><strong>NIT:</strong> {{ $institution->nit }}</li>
                        <li><strong>Ciudad Base:</strong> {{ $institution->city }}</li>
                    </ul>
                </div>
            </div>

        </div>
    </section>

    <!-- End Categories of The Month -->


    <!-- Start Featured Product -->
    


    <section class="bg-light py-5">
    <div class="container my-4">
        <div class="row text-center py-3">
            <div class="col-lg-6 m-auto">
                <h1 class="h1">Marcas</h1>
                <p>
                    Estas son las marcas que tenemos disponibles en nuestro catálogo. ¡Explora y encuentra tus favoritas!
                </p>
            </div>
            
            <!-- Cambiamos a col-lg-8 para que el contenedor esté más centrado y compacto -->
            <div class="col-lg-8 m-auto tempaltemo-carousel">
                <!-- d-flex y align-items-center alinean las flechas verticalmente con la imagen -->
                <div class="row d-flex flex-row align-items-center justify-content-center">
                    
                    <!-- Control Izquierdo (Anterior) -->
                    <div class="col-1 text-end">
                        <!-- Cambiamos 'text-light' por 'text-secondary' o 'text-dark' para que se vea sobre el fondo claro -->
                        <a class="h1 text-secondary" href="#multi-item-example" role="button" data-bs-slide="prev">
                            <i class="fas fa-chevron-left"></i>
                        </a>
                    </div>
                    <!-- End Control Izquierdo -->

                    <!-- Carousel Wrapper -->
                    <div class="col-10 col-md-8">
                        <div class="carousel slide pt-2 pt-md-0" id="multi-item-example" data-bs-ride="carousel">
                            <!-- Slides -->
                            <div class="carousel-inner product-links-wap" role="listbox">
                                
                                @foreach ($brands as $brand)
                                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                        <!-- row y justify-content-center garantizan el centrado absoluto del contenido -->
                                        <div class="row justify-content-center text-center">
                                            <!-- col-12 para usar todo el espacio asignado al carrusel y agrandar la imagen -->
                                            <div class="col-12 p-3">
                                                <a href="#" class="d-block">
                                                    <!-- Se aumentó la altura máxima a 220px para que luzca imponente y grande -->
                                                    <img class="img-fluid brand-img mx-auto" 
                                                         style="border-radius: 10%; object-fit: contain; max-height: 220px; width: auto;" 
                                                         src="{{ $brand->logo ? asset('storage/' . $brand->logo) : asset('img/default-brand.png') }}" 
                                                         alt="{{ $brand->name }}">
                                                    
                                                    <!-- Opcional: Nombre de la marca debajo de la imagen -->
                                                    <h5 class="mt-3 text-dark">{{ Str::limit($brand->name, 20, '...') }}</h5>
                                                </a>             
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                            <!-- End Slides -->
                        </div>
                    </div>
                    <!-- End Carousel Wrapper -->

                    <!-- Control Derecho (Siguiente) -->
                    <div class="col-1 text-start">
                        <a class="h1 text-secondary" href="#multi-item-example" role="button" data-bs-slide="next">
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    </div>
                    <!-- End Control Derecho -->

                </div>
            </div>
        </div>
    </div>
</section>

@endsection

