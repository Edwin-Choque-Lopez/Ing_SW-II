@extends('layouts.web')
@section('content')
    <!-- Start Content -->
    <div class="container py-5">
        <div class="row">

            <div class="d-flex align-items-center">
                @auth
                    <div class="d-flex justify-content-between align-items-center w-100 py-2 border-bottom">
                        <h4 class="text-dark mb-0 fw-normal">
                            ¡Hola, <span class="fw-bold text-gradient">{{ auth()->user()->name }}</span>!
                        </h4>

                        <div class="d-flex align-items-center gap-3">
                            @if($code)
                                <form action="{{route('shopping.cart')}}" method="GET" id="form-carrito" class="d-flex align-items-center gap-3">
                                    @csrf
                                    <input type="hidden" name="code_order" value="{{ $code ? $code->code_order : '' }}">
                                    @if($code)
                                        <span class="badge bg-warning-subtle text-success border border-warning-subtle px-3 py-2 rounded-pill fw-semibold">
                                            <i class="fa fa-clock me-1"></i> Reserva pendiente: <strong class="text-dark">{{ $code->code_order }}</strong>
                                        </span>
                                    @endif
                                    <a class="btn btn-link position-relative p-2 text-dark hover-zoom" 
                                    href="javascript:void(0);" 
                                    onclick="document.getElementById('form-carrito').submit();" 
                                    title="Ver carrito">
                                        <i class="fa fa-lg fa-cart-arrow-down"></i>
                                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger text-white border border-2 border-white small">
                                            {{ $count }}
                                        </span>
                                    </a>
                                </form>
                            @else
                                <span class="badge bg-light text-dark border px-3 py-2 rounded-pill fw-normal">
                                    <i class="fa fa-check-circle text-success me-1"></i> Sin reservas pendientes
                                </span>
                            @endif
                        </div>
                    </div>
                @else
                    <h5 class="text-dark mb-0 fw-normal">
                        ¡Necesitas iniciar sesión para realizar una reserva!
                    </h5>
                @endauth
            </div>

            <div class="col-lg-3">
                <h1 class="h2 pb-4 text-dark fw-bold">Categorías</h1>
                <ul class="list-unstyled templatemo-accordion">
                    @foreach ($categories as $category)
                        <li class="pb-3">
                            <!-- El ID único en 'data-bs-target' controla el despliegue individual de Bootstrap -->
                            <a class="collapsed d-flex justify-content-between h5 text-decoration-none text-dark" 
                            data-bs-toggle="collapse" 
                            href="#collapse-cat-{{ $category->id }}" 
                            role="button" 
                            aria-expanded="false">
                                {{ $category->name }}
                                <i class="fa fa-fw fa-chevron-circle-down mt-1 text-secondary"></i>
                            </a>
                            
                            <!-- El contenedor inicia colapsado (sin la clase 'show') -->
                            <ul id="collapse-cat-{{ $category->id }}" class="collapse list-unstyled pl-3 ms-3">
                                @forelse ($category->children as $sub)
                                    <li class="py-1">
                                        <a class="text-decoration-none text-secondary d-block" href="{{ route('filter.prodcuts', $sub->id) }}">
                                            {{ $sub->name }}
                                        </a>
                                    </li>
                                @empty
                                    <li class="py-1 text-muted small">No hay subcategorías</li>
                                @endforelse
                            </ul>
                        </li>
                    @endforeach
                </ul>
            </div>


            <div class="col-lg-9">
                <div class="row">
                    <div class="col-md-6">
                        <p class="mb-0 mt-auto mb-4 fw-bold h2">Estos son nuestros productos</p>
                    </div>
                    
                </div>
                <div class="row">

                    @foreach ($products as $product)
                        <!-- h-100 en la columna ayuda a que todas compartan la misma altura en la fila -->
                        <div class="col-md-4 mb-4 d-flex align-items-stretch">
                            <!-- h-100 aquí obliga a la tarjeta a estirarse al máximo disponible -->
                            <div class="card product-wap rounded-0 w-100 h-100 d-flex flex-column">
                                
                                <div class="card rounded-0 border-0">
                                    <img class="card-img rounded-0 img-fluid" 
                                        src="{{ asset('storage/' . $product->image_main) }}" 
                                        style="height: 300px; object-fit: cover; width: 100%;">
                                    
                                    <div class="card-img-overlay rounded-0 product-overlay d-flex align-items-center justify-content-center">
                                        <ul class="list-unstyled">
                                            <!--<li><a class="btn btn-primary text-white mt-2" href="{{route('info.products',$product->id)}}"><i class="far fa-eye"></i></a></li>-->
                                            <li><a class="btn btn-primary text-white mt-2" href="{{route('info.products',$product->id)}}"><i class="fas fa-cart-plus"></i></a></li>
                                        </ul>
                                    </div>
                                </div>

                                <!-- flex-grow-1 hace que el cuerpo llene el espacio restante y mt-auto empuja el precio al fondo -->
                                <div class="card-body d-flex flex-column flex-grow-1">
                                    <p class="mb-0 mt-auto fw-bold "> Codigo OEM: </p>
                                    <a href="{{route('info.products',$product->id)}}" class="h3 text-center text-decoration-none text-truncate d-block" title="{{ $product->oem }}">
                                        {{ $product->oem }}
                                    </a>
                                    <p class="mb-0 mt-auto fw-bold"> Nombre: </p>
                                    <p class="text-center mb-0 mt-auto">{{ $product->name }}</p>
                                    <a class="h3 text-decoration-none text-truncate d-block" title="{{ $product->oem }}">
                                        
                                    </a>
                                    <!-- mt-auto asegura que el precio siempre quede alineado perfectamente abajo-->
                                    @auth
                                        <p class="text-center mb-0 mt-auto fw-bold text-primary">BS. {{ $product->price_sell }}</p>
                                    @endauth
                                </div>

                            </div>
                        </div>
                    @endforeach

                    
                    
                </div>
                <div div="row">
                    @if($products->hasPages())
                        <div class="d-flex justify-content-left">
                            {{ $products->links('pagination::bootstrap-5') }}
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
    <!-- End Content -->
@endsection