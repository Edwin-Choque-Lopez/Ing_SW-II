@extends('layouts.admin')
@section('title')
    <h3 class="fw-bold">Reservas en estado: <span class="text-info">{{ $namestatus->name }}</span></h3>
    <p class="text-subtitle text-muted d-flex align-items-center">
        Revise los datos del cliente, prepare las piezas solicitadas y gestione las órdenes vigentes en tienda.
    </p>
@endsection
@section('navegacion')
    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
            <li class="breadcrumb-item active" aria-current="page">Reservas</li>
        </ol>
    </nav>
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title mb-0">Reservas</h4>
                <!-- Botón para abrir el modal de creación de producto -->
            </div>
            <div class="card-content">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th style="text-aling: center:">N°</th>
                                    <th style="text-align: center;">Codigo</th>
                                    <th style="text-align: center;">Cliente</th>
                                    <th style="text-align: center;">Precio Final</th>
                                    <th style="text-align: center;">Estado</th>
                                    <th style="text-align: center;">Contacto</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($reservations as $reservation)
                                    <tr>
                                        <td>{{ ($reservations->currentPage() - 1) * $reservations->perPage() + $loop->iteration }}</td>
                                        <td >{{ $reservation->code_order }}</td>
                                        <td>{{ $reservation->user->name }}</td>
                                        <td>Bs. {{ number_format($reservation->total, 2) }}</td>
                                        <td class="text-center align-middle">
                                            <span class="badge bg-primary">{{ $reservation->status->name ?? 'Sin estado' }}</span>
                                        </td>
                                        <td class="text-center align-middle">
                                            @if($reservation->user->phone)
                                                <!-- Reemplaza el espacio en blanco o el prefijo de país según sea necesario en Oruro (ej: 591) -->
                                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $reservation->user->phone) }}" 
                                                target="_blank" 
                                                class="btn btn-sm btn-success text-white" 
                                                style="background-color: #25D366; border-color: #25D366;"
                                                title="Enviar mensaje por WhatsApp">
                                                    <i class="bi bi-whatsapp me-1"></i>
                                                </a>
                                            @else
                                                <span class="text-muted"><i class="bi bi-telephone-x me-1"></i> S/N</span>
                                            @endif
                                        </td>
                                        <td class="d-flex justify-content-center gap-2"> 
                                            <a href="{{ route('reservation.show', $reservation->id) }}" class="btn btn-sm btn-outline-info" title="Ver">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('reservation.edit', $reservation->id) }}" class="btn btn-sm btn-outline-success" title="Editar">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form id="delete-form-{{ $reservation->id }}" action="{{ route('products.destroy', $reservation->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-outline-danger btn-sm" onclick="confirmDelete({{ $reservation->id }})"><i class="bi bi-file-earmark-pdf"></i></button>
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
                        @if($reservations->hasPages())
                            <div class="d-flex justify-content-left">
                                {{ $reservations->links('pagination::bootstrap-5') }}
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