@extends('layouts.admin')
@section('title')
    <h3>Registro de producto</h3>
    <p class="text-subtitle text-muted">Rellene el formulario para registar un producto</p>
@endsection
@section('navegacion')
    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
            <li class="breadcrumb-item active" aria-current="page">Productos</li>
            <li class="breadcrumb-item active" aria-current="page">Registrar Productos</li>
        </ol>
    </nav>
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title mb-0">FORMULARIO DE REGISTRO</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row gx-4 gy-4">
                            <div class="col-lg-8">
                                <div class="row gy-3">
                                    <div class="col-md-6">
                                        <label for="oem" class="form-label">Codigo OEM</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bi bi-box-seam"></i></span>
                                            <input type="text" id="oem" name="oem" value="{{ old('oem') }}" class="form-control @error('oem') is-invalid @enderror" required>
                                            @error('oem')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="category_id" class="form-label">Categoria</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bi bi-tags-fill"></i></span>
                                            <select id="category_id" name="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                                                <option value="">Seleccionar categoría</option>
                                                @foreach($categories as $id => $label)
                                                    <option value="{{ $id }}" @selected(old('category_id') == $id)>{{ $label }}</option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <label for="name" class="form-label">Nombre</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bi bi-card-text"></i></span>
                                            <input type="text" id="name" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" required>
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="brand_id" class="form-label">Marca</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bi bi-building"></i></span>
                                            <select id="brand_id" name="brand_id" class="form-select @error('brand_id') is-invalid @enderror" required>
                                                <option value="">Seleccionar marca</option>
                                                @foreach($brands as $id => $label)
                                                    <option value="{{ $id }}" @selected(old('brand_id') == $id)>{{ $label }}</option>
                                                @endforeach
                                            </select>
                                            @error('brand_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="status_id" class="form-label">Estado del producto</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bi bi-info-circle-fill"></i></span>
                                            <select id="status_id" name="status_id" class="form-select @error('status_id') is-invalid @enderror" required>
                                                <option value="">Seleccionar estado</option>
                                                @foreach($statusProducts as $id => $label)
                                                    <option value="{{ $id }}" @selected(old('status_id') == $id)>{{ $label }}</option>
                                                @endforeach
                                            </select>
                                            @error('status_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="price_buy" class="form-label">Precio de Compra</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bi bi-currency-dollar"></i></span>
                                            <input type="number" step="0.01" id="price_buy" name="price_buy" value="{{ old('price_buy') }}" class="form-control @error('price_buy') is-invalid @enderror" required>
                                            @error('price_buy')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="price_sell" class="form-label">Precio de Venta</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bi bi-cash-stack"></i></span>
                                            <input type="number" step="0.01" id="price_sell" name="price_sell" value="{{ old('price_sell') }}" class="form-control @error('price_sell') is-invalid @enderror" required>
                                            @error('price_sell')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="stock" class="form-label">Registro de Stock</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bi bi-stack"></i></span>
                                            <input type="number" id="stock" name="stock" value="{{ old('stock') }}" class="form-control @error('stock') is-invalid @enderror" required>
                                            @error('stock')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="min_stock" class="form-label">Stock Minimo</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bi bi-arrow-down-left-square-fill"></i></span>
                                            <input type="number" id="min_stock" name="min_stock" value="{{ old('min_stock') }}" class="form-control @error('min_stock') is-invalid @enderror" required>
                                            @error('min_stock')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <label for="technical_notes" class="form-label">Notas tecnicas</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bi bi-gear-fill"></i></span>
                                            <textarea id="technical_notes" name="technical_notes" class="form-control @error('technical_notes') is-invalid @enderror" rows="3">{{ old('technical_notes') }}</textarea>
                                            @error('technical_notes')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="card border rounded p-3 h-100">
                                    <div class="mb-3">
                                        <label for="image_main" class="form-label">Foto del producto</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bi bi-image-fill"></i></span>
                                            <input type="file" id="image_main" name="image_main" class="form-control @error('image_main') is-invalid @enderror" accept="image/*" onchange="previewProductImage(event)">
                                        </div>
                                        @error('image_main')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="text-center mb-3">
                                        <div id="productImagePlaceholder" class="d-flex align-items-center justify-content-center rounded bg-light" style="height: 300px;">
                                            <i class="bi bi-card-image fs-1 text-secondary"></i>
                                        </div>
                                        <img id="productImagePreview" src="" alt="Vista previa de producto" class="img-fluid rounded mx-auto d-block d-none" style="max-height: 300px;">
                                    </div>

                                    <div class="text-end mt-auto">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="bi bi-save me-2"></i> Guardar producto
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
function previewProductImage(event) {
    const file = event.target.files[0];
    const preview = document.getElementById('productImagePreview');
    const placeholder = document.getElementById('productImagePlaceholder');

    if (!file) {
        preview.classList.add('d-none');
        placeholder.classList.remove('d-none');
        preview.src = '';
        return;
    }

    const reader = new FileReader();
    reader.onload = function (e) {
        preview.src = e.target.result;
        preview.classList.remove('d-none');
        placeholder.classList.add('d-none');
    };
    reader.readAsDataURL(file);
}
</script>

@endsection