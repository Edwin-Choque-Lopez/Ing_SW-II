@extends('layouts.admin')

@section('title')
    <h3>Panel de control</h3>
@endsection

@section('content')
<div class="row g-4">
    <div class="col-12 col-md-6 col-xl-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-1">Clientes registrados</h6>
                        <h2 class="fw-bold mb-0">{{ $totalClients - 1 }}</h2>
                    </div>
                    <div class="rounded-circle bg-primary bg-opacity-10 p-3 text-primary">
                        <i class="bi bi-people fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-6 col-xl-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-1">Productos registrados</h6>
                        <h2 class="fw-bold mb-0">{{ $totalProducts }}</h2>
                    </div>
                    <div class="rounded-circle bg-success bg-opacity-10 p-3 text-success">
                        <i class="bi bi-box-seam fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-6 col-xl-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-1">Reservas realizadas</h6>
                        <h2 class="fw-bold mb-0">{{ $totalReservations }}</h2>
                    </div>
                    <div class="rounded-circle bg-warning bg-opacity-10 p-3 text-warning">
                        <i class="bi bi-calendar2-check fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-6 col-xl-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-1">Reservas pendientes</h6>
                        <h2 class="fw-bold mb-0">{{ $pendingReservations->count() }}</h2>
                    </div>
                    <div class="rounded-circle bg-info bg-opacity-10 p-3 text-info">
                        <i class="bi bi-clock-history fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mt-1">
    <div class="col-12 col-xl-8">
        <div class="card border-0 shadow-sm">
            <div class="card-header border-0">
                <h5 class="mb-0">Reservaciones Recientes</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Código</th>
                                <th>Cliente</th>
                                <th>Estado</th>
                                <th>Fecha</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pendingReservations as $reservation)
                                <tr>
                                    <td><span class="fw-semibold">{{ $reservation->code_order }}</span></td>
                                    <td>{{ $reservation->user?->name ?? 'Sin usuario' }}</td>
                                    <td>
                                        <span class="badge bg-warning text-dark">{{ $reservation->status?->name ?? 'Pendiente' }}</span>
                                    </td>
                                    <td>{{ optional($reservation->created_at)->format('d/m/Y') }}</td>
                                    <td>${{ number_format((float) $reservation->total, 2, ',', '.') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">No hay reservaciones en este estado.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-xl-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header border-0">
                <h5 class="mb-0">Productos con stock bajo</h5>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    @forelse($lowStockProducts as $product)
                        <li class="list-group-item px-0">
                            <div class="d-flex justify-content-between align-items-start gap-2">
                                <div>
                                    <div class="fw-semibold">{{ $product->name }}</div>
                                    <small class="text-muted">Stock: {{ $product->stock }} / Mínimo: {{ $product->min_stock }}</small>
                                </div>
                                <span class="badge bg-danger">Bajo</span>
                            </div>
                        </li>
                    @empty
                        <li class="list-group-item px-0 text-muted">No hay productos con stock bajo.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
