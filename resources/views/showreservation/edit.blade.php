@extends('layouts.admin')

@section('title')
    <h3 class="fw-bold">Editar reserva: <span class="text-info">{{ $reservation->code_order }}</span></h3>
    <p class="text-subtitle text-muted d-flex align-items-center">
        Modifica el estado y agrega una nota opcional a la reserva.
    </p>
@endsection

@section('navegacion')
    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{ route('reservation.show', $reservation->id) }}">Detalle</a></li>
            <li class="breadcrumb-item active" aria-current="page">Editar</li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="row gy-4">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Datos del cliente</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <p class="mb-2"><strong>Nombre:</strong> {{ $reservation->user->name ?? 'No disponible' }}</p>
                        <p class="mb-2"><strong>CI:</strong> {{ $reservation->user->ci ?? 'No disponible' }}</p>
                        <p class="mb-2"><strong>Correo:</strong> {{ $reservation->user->email ?? 'No disponible' }}</p>
                        <p class="mb-2"><strong>Teléfono:</strong> {{ $reservation->user->phone ?? 'No disponible' }}</p>
                        <p class="mb-0"><strong>Notas actuales:</strong></p>
                        <p class="text-muted small">{{ $reservation->notes ?? 'No se ingresaron observaciones.' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <form action="{{ route('reservation.update', $reservation->id) }}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-header d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
                        <div>
                            <h4 class="card-title mb-1">Editar reserva</h4>
                            <p class="text-muted mb-0">Código de orden <strong>{{ $reservation->code_order }}</strong></p>
                        </div>
                        <div class="text-md-end">
                            <span class="badge bg-primary me-2">{{ $reservation->status->name ?? 'Sin estado' }}</span>
                            <p class="text-muted mb-0">Total: Bs. {{ number_format($reservation->total, 2) }}</p>
                            @if($reservation->expiry_date)
                                <p class="text-muted mb-0">Expira: {{ \Carbon\Carbon::parse($reservation->expiry_date)->format('d/m/Y H:i') }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row gy-3">
                                <div class="col-12">
                                    <label for="status_id" class="form-label">Estado de la reserva</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-flag-fill"></i></span>
                                        <select id="status_id" name="status_id" class="form-select @error('status_id') is-invalid @enderror" required>
                                            <option value="">Seleccionar estado</option>
                                            @foreach($statusOptions as $id => $label)
                                                <option value="{{ $id }}" @selected(old('status_id', $reservation->status_id) == $id)>{{ $label }}</option>
                                            @endforeach
                                        </select>
                                        @error('status_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label for="notes" class="form-label">Notas de la reserva <span class="text-muted small">(opcional)</span></label>
                                    <textarea id="notes" name="notes" rows="4" class="form-control @error('notes') is-invalid @enderror" placeholder="Ej. Cliente pide entrega el jueves, revisar disponibilidad.">{{ old('notes', $reservation->notes) }}</textarea>
                                    @error('notes')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-bordered align-middle">
                                            <thead class="table-dark">
                                                <tr>
                                                    <th>Producto</th>
                                                    <th class="text-center">Precio unitario</th>
                                                    <th class="text-center">Cantidad</th>
                                                    <th class="text-end">Subtotal</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($reservation->ReservationItems as $item)
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center gap-3">
                                                                @if(isset($item->product->image_main))
                                                                    <img src="{{ asset('storage/' . $item->product->image_main) }}" alt="{{ $item->product->name }}" class="rounded" style="width: 60px; height: 60px; object-fit: cover;" onerror="this.src='{{ asset('images/no-image.png') }}'">
                                                                @else
                                                                    <div class="rounded bg-secondary-subtle d-flex justify-content-center align-items-center" style="width: 60px; height: 60px;">N/A</div>
                                                                @endif
                                                                <div>
                                                                    <strong>{{ $item->product->name ?? 'Producto eliminado' }}</strong>
                                                                    <p class="mb-0 text-muted small">{{ $item->product->oem ?? '' }}</p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="text-center">Bs. {{ number_format($item->unite_price, 2) }}</td>
                                                        <td class="text-center">{{ $item->quantity }}</td>
                                                        <td class="text-end">Bs. {{ number_format($item->item_subtotal, 2) }}</td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="4" class="text-center text-muted">No hay ítems registrados para esta reserva.</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="col-12 d-flex justify-content-between align-items-center gap-2">
                                    <a href="{{ route('reservation.show', $reservation->id) }}" class="btn btn-outline-secondary">Cancelar</a>
                                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection