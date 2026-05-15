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
                                        <label for="compatibility_notes" class="form-label">Notas de compatibilidad</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bi bi-pc-display"></i></span>
                                            <textarea id="compatibility_notes" name="compatibility_notes" class="form-control @error('compatibility_notes') is-invalid @enderror" rows="3">{{ old('compatibility_notes') }}</textarea>
                                            @error('compatibility_notes')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <label for="technical_specs" class="form-label">Notas tecnicas</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bi bi-gear-fill"></i></span>
                                            <textarea id="technical_specs" name="technical_specs" class="form-control @error('technical_specs') is-invalid @enderror" rows="3">{{ old('technical_specs') }}</textarea>
                                            @error('technical_specs')
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