@extends('layouts.admin')
@section('title')
    <h3>Productos registrados en el Sistema</h3>
    <p class="text-subtitle text-muted">En este apartado puede gestionar la información de los productos registrados en el sistema</p>
@endsection
@section('navegacion')
    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
            <li class="breadcrumb-item active" aria-current="page">Productos</li>
        </ol>
    </nav>
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title mb-0">PRODUCTOS</h4>
                <!-- Botón para abrir el modal de creación de producto -->
                <a href="{{route('products.create')}}" class="btn btn-outline-primary"> Registrar Producto</a>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th style="text-aling: center:">N°</th>
                                    <th style="text-align: center;">OEM</th>
                                    <th style="text-align: center;">Nombre</th>
                                    <th style="text-align: center;">Precio Venta</th>
                                    <th style="text-align: center;">Stock</th>
                                    <th style="text-align: center;">Estado</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($products as $product)
                                    <tr>
                                        <td>{{ ($products->currentPage() - 1) * $products->perPage() + $loop->iteration }}</td>
                                        <td >{{ $product->oem }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td>Bs. {{ number_format($product->price_sell, 2) }}</td>
                                        <td>
                                            <span class="badge {{ $product->stock <= $product->min_stock ? 'bg-danger' : ($product->stock <= $product->min_stock * 1.5 ? 'bg-warning' : 'bg-success') }}">
                                                {{ $product->stock }}
                                                @if($product->stock <= $product->min_stock)
                                                    <i class="bi bi-exclamation-triangle-fill ms-1"></i>
                                                @endif
                                            </span>
                                            <small class="text-muted d-block">Mín: {{ $product->min_stock }}</small>
                                        </td>
                                        <td>
                                            <span class="badge bg-info">{{ $product->status->name ?? 'Sin estado' }}</span>
                                        </td>
                                        <td class="d-flex justify-content-center gap-2"> 
                                            <a href="{{ route('products.show', $product->id) }}" class="btn btn-sm btn-outline-info" title="Ver">
                                                    <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-outline-success" title="Editar">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form id="delete-form-{{ $product->id }}" action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-outline-danger btn-sm" onclick="confirmDelete({{ $product->id }})"><i class="bi bi-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted">
                                            No hay productos registrados
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        <!-- Paginación -->
                        @if($products->hasPages())
                            <div class="d-flex justify-content-left">
                                {{ $products->links('pagination::bootstrap-5') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
function confirmDelete(productId) {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-success ms-2",
            cancelButton: "btn btn-danger"
        },
        buttonsStyling: false
    });
    swalWithBootstrapButtons.fire({
        title: "¿Estás seguro?",
        text: "¡No podrás revertir esto!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Sí, eliminarlo!",
        cancelButtonText: "No, cancelar!",
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-form-' + productId).submit();
            
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            swalWithBootstrapButtons.fire({
                title: "Cancelado",
                text: "Tu producto está a salvo :)",
                icon: "error"
            });
        }
    });
}
</script>

@endsection