@extends('layouts.admin')
@section('title')
    <h3>Detalles del Producto</h3>
    <p class="text-subtitle text-muted">Información completa del producto {{ $product->name }}</p>
@endsection
@section('navegacion')
    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Productos</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
        </ol>
    </nav>
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title mb-0">DETALLES DEL PRODUCTO</h4>
                <div class="btn-group">
                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-outline-warning">
                        <i class="bi bi-pencil me-1"></i>Editar
                    </a>
                    <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-1"></i>Volver
                    </a>
                </div>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <div class="row gx-4 gy-4">
                        <div class="col-lg-8">
                            <div class="row gy-3">
                                <div class="col-md-6">
                                    <div class="border rounded p-3 h-100">
                                        <label class="form-label fw-bold text-primary">Código OEM</label>
                                        <p class="mb-0">{{ $product->oem }}</p>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="border rounded p-3 h-100">
                                        <label class="form-label fw-bold text-primary">Categoría</label>
                                        <p class="mb-0">{{ $product->category->name ?? 'Sin categoría' }}</p>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="border rounded p-3 h-100">
                                        <label class="form-label fw-bold text-primary">Nombre del Producto</label>
                                        <p class="mb-0">{{ $product->name }}</p>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="border rounded p-3 h-100">
                                        <label class="form-label fw-bold text-primary">Marca</label>
                                        <p class="mb-0">{{ $product->brand->name ?? 'Sin marca' }}</p>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="border rounded p-3 h-100">
                                        <label class="form-label fw-bold text-primary">Estado del Producto</label>
                                        <p class="mb-0">
                                            <span class="badge bg-info">{{ $product->status->name ?? 'Sin estado' }}</span>
                                        </p>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="border rounded p-3 h-100">
                                        <label class="form-label fw-bold text-primary">Precio de Compra</label>
                                        <p class="mb-0 fs-5 text-success">Bs. {{ number_format($product->price_buy, 2) }}</p>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="border rounded p-3 h-100">
                                        <label class="form-label fw-bold text-primary">Precio de Venta</label>
                                        <p class="mb-0 fs-5 text-primary">Bs. {{ number_format($product->price_sell, 2) }}</p>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="border rounded p-3 h-100">
                                        <label class="form-label fw-bold text-primary">Stock Actual</label>
                                        <p class="mb-0">
                                            <span class="badge {{ $product->stock <= $product->min_stock ? 'bg-danger' : 'bg-success' }} fs-6">
                                                {{ $product->stock }} unidades
                                            </span>
                                        </p>
                                        <small class="text-muted">Stock mínimo: {{ $product->min_stock }}</small>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="border rounded p-3 h-100">
                                        <label class="form-label fw-bold text-primary">Stock Mínimo</label>
                                        <p class="mb-0">{{ $product->min_stock }} unidades</p>
                                    </div>
                                </div>

                                @if($product->compatibility_notes)
                                <div class="col-md-6">
                                    <div class="border rounded p-3 h-100">
                                        <label class="form-label fw-bold text-primary">Notas de Compatibilidad</label>
                                        <p class="mb-0">{{ $product->compatibility_notes }}</p>
                                    </div>
                                </div>
                                @endif

                                @if($product->technical_specs)
                                <div class="col-md-6">
                                    <div class="border rounded p-3 h-100">
                                        <label class="form-label fw-bold text-primary">Especificaciones Técnicas</label>
                                        <p class="mb-0">{{ $product->technical_specs }}</p>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="card border rounded p-3 h-100">
                                <div class="text-center">
                                    <label class="form-label fw-bold text-primary mb-3">Imagen del Producto</label>
                                    @if($product->image_main)
                                        <img src="{{ asset('storage/' . $product->image_main) }}" alt="{{ $product->name }}" class="img-fluid rounded shadow" style="max-height: 300px;">
                                    @else
                                        <div class="d-flex align-items-center justify-content-center rounded bg-light" style="height: 300px;">
                                            <i class="bi bi-card-image fs-1 text-secondary"></i>
                                        </div>
                                        <p class="text-muted mt-2">Sin imagen</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection