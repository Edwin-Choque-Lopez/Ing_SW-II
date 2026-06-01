@extends('layouts.web')
@section('content')

    <!-- Open Content -->
    <section class="bg-light">
        <div class="container pb-5">
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
                <!-- Nombre y Código OEM -->
                <h1 class="h2">{{ $product->name }}</h1>
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
                <form action="" method="GET">
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="product-title" value="{{ $product->name }}">
                    
                    <div class="row">
                        <div class="col-auto">
                            <ul class="list-inline pb-3">
                                <li class="list-inline-item text-right">
                                    Cantidad
                                    <input type="hidden" name="product-quanity" id="product-quanity" value="1">
                                </li>
                                <li class="list-inline-item"><span class="btn btn-primary" id="btn-minus">-</span></li>
                                <li class="list-inline-item"><span class="badge bg-secondary" id="var-value">1</span></li>
                                <li class="list-inline-item"><span class="btn btn-primary" id="btn-plus">+</span></li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="row pb-3">
                        <div class="col d-grid">
                            <button type="submit" class="btn btn-primary btn-lg" name="submit" value="buy" {{ $product->stock <= 0 ? 'disabled' : '' }}>
                                Comprar
                            </button>
                        </div>
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
    <!-- Close Content -->

    @endsection