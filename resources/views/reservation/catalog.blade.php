@extends('layouts.web')
@section('content')
    <!-- Start Content -->
    <div class="container py-5">
        <div class="row">

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
                                            <li><a class="btn btn-primary text-white mt-2" href="{{route('info.products',$product->id)}}"><i class="far fa-eye"></i></a></li>
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
                                    <!-- mt-auto asegura que el precio siempre quede alineado perfectamente abajo -->
                                    <p class="text-center mb-0 mt-auto fw-bold text-primary">BS. {{ $product->price_sell }}</p>
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