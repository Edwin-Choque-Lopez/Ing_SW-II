@extends('layouts.web')
@section('content')

    <!-- Open Content -->
    <section class="bg-light">
        <div class="container pb-5">
             @if ($errors->any() || session('message'))
                <div class="alert alert-danger alert-dismissible fade show mt-4" role="alert">
                    <ul class="mb-0">
                        <!-- Muestra los errores de validación del formulario -->
                        @foreach ($errors->all() as $error)
                            <li><strong>Error:</strong> {{ $error }}</li>
                        @endforeach

                        <!-- Muestra el mensaje personalizado de falta de stock -->
                        @if (session('message'))
                            <li><strong>Disponibilidad:</strong> {{ session('message') }}</li>
                        @endif
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="row">
                <!-- Columna de la Imagen -->
                <div class="col-lg-5 mt-5">
                    <div class="card mb-3">
                        <img class="card-img img-fluid" src="{{ asset('storage/' . $product->image_main) }}" alt="{{ $product->name }}" id="product-detail" style="height: 450px; object-fit: cover;">
                    </div>
                </div>
                
                <!-- Columna de la Información -->
                <div class="col-lg-7 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center w-100 py-2 border-bottom">
                                <h1 class="h2">{{ $product->name }}</h1>
                                @if($code)
                                    <span class="badge bg-warning-subtle text-primary border border-warning-subtle px-3 py-2 rounded-pill fw-semibold">
                                        <i class="fa fa-clock me-1"></i> Reserva pendiente: <strong class="text-dark">{{ $code->code_order }}</strong>
                                    </span>
                                @endif
                            </div>
                            <p class="text-dark">OEM: <strong>{{ $product->oem }}</strong></p>
                            
                            <!-- Precio de Venta -->
                            <p class="h3 py-2 text-primary">BS. {{ number_format($product->price_sell, 2) }}</p>
                            
                            <!-- Stock Disponible -->
                            <p class="py-1">
                                <span class="badge {{ $product->stock > $product->min_stock ? 'bg-success' : 'bg-danger' }}">
                                    Stock: {{ $product->stock }} unidades
                                </span>
                            </p>

                            <!-- Marca y Origen -->
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <h6>Marca:</h6>
                                </li>
                                <li class="list-inline-item">
                                    <p class="text-dark">
                                        <strong>
                                            {{ $product->brand->name ?? 'Sin Marca' }} 
                                            @if(!empty($product->brand->country_origin))
                                                ({{ $product->brand->country_origin }})
                                            @endif
                                        </strong>
                                    </p>
                                </li>
                            </ul>

                            <!-- Categoría -->
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <h6>Categoría:</h6>
                                </li>
                                <li class="list-inline-item">
                                    <p class="text-dark"><strong>{{ $product->category->name ?? 'Sin Categoría' }}</strong></p>
                                </li>
                            </ul>

                            <!-- Especificaciones Técnicas -->
                            <h6>Especificaciones Técnicas:</h6>
                            <div class="pb-3 text-dark">
                                @if(!empty($product->technical_notes))
                                    {{-- Si guardas las especificaciones con saltos de línea, nl2br las respetará en HTML --}}
                                    {!! nl2br(e($product->technical_notes)) !!}
                                @else
                                    <p>No se especifican detalles técnicos.</p>
                                @endif
                            </div>

                            <!-- Formulario de Compra / Carrito -->
                            <form action="{{route('reservation.store')}}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="product_price" value="{{$product->price_sell}}">
                                <input type="hidden" name="user_id" value="{{auth()->id()}}">
                                <input type="hidden" name="code_order" value="{{ $code ? $code->code_order : '' }}">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <div class="d-flex align-items-center gap-2 pb-3">
                                            <label for="product-quantity" class="text-dark fw-semibold mb-0">
                                                Cantidad:
                                            </label>
                                            
                                            <!-- Input limitado dinámicamente con el stock disponible -->
                                            <input 
                                                type="number" 
                                                name="product_quantity" 
                                                id="product-quantity" 
                                                class="form-control text-center fw-bold" 
                                                value="{{ $product->stock > 0 ? 1 : 0 }}" 
 
                                                step="1"
                                                style="width: 80px;"
                                                {{ $product->stock == 0 ? 'disabled' : '' }}
                                                required
                                            >

                                            <!-- Pequeño aviso visual del stock disponible -->
                                            @if($product->stock > 0)
                                                <span class="text-dark small">({{ $product->stock }} disponibles)</span>
                                            @else
                                                <span class="badge bg-danger">Agotado</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row pb-3">
                                    <div class="col d-grid">
                                        <button type="submit" class="btn btn-success btn-lg text-white" name="submit" value="addtocard" {{ $product->stock <= 0 ? 'disabled' : '' }}>
                                            Añadir al carrito
                                        </button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    @endsection