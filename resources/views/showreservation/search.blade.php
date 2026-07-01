@extends('layouts.web')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card border-0 shadow-lg overflow-hidden rounded-4">
                <div class="row g-0">
                    <div class="col-lg-5" style="background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 100%);">
                        <div class="p-4 p-lg-5 text-white h-100 d-flex flex-column justify-content-between">
                            <div>
                                <p class="text-uppercase small fw-bold mb-2">Seguimiento de reserva</p>
                                <h2 class="h3 fw-bold mb-3">Reserva {{ $reservation?->code_order ?? 'sin resultados' }}</h2>
                                <p class="mb-0">Consulta el estado de tu reserva, revisa los productos seleccionados y confirma los datos de tu solicitud.</p>
                            </div>
                            <div>
                                <p class="small text-muted mb-1">Observaciones</p>
                                <p class="mb-0">{{ $reservation->notes ?? 'No se registraron observaciones.' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-7">
                        @if($reservation)
                            <div class="p-4 p-lg-5">
                                <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 border-bottom pb-3 mb-4">
                                    <div>
                                        <h3 class="h4 fw-bold mb-1">¡Información de tu reserva!</h3>
                                        <p class="text-muted mb-0">Cliente: <span class="fw-semibold text-dark">{{ $reservation->user->name ?? 'No disponible' }}</span></p>
                                        <p class="text-muted  mb-0">Telf: <span class="fw-semibold text-dark">{{ $reservation->user->phone ?? 'No registrado' }}</span></p>
                                    </div>
                                    <span class="badge bg-success text-white fw-bold rounded-pill px-3 py-2 text-uppercase" style="font-size: 0.72rem; letter-spacing: 0.5px; box-shadow: 0 2px 4px rgba(40, 167, 69, 0.15);">
                                        {{ $reservation->status->name ?? 'Sin estado' }}
                                    </span>

                                </div>

       

                                <div class="card border-0 bg-light rounded-3 mb-4">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h4 class="h6 fw-bold mb-0">Productos reservados</h4>
                                            <span class="small text-muted">{{ $reservation->ReservationItems->count() }} artículo(s)</span>
                                        </div>

                                        <div class="row g-3">
                                            @forelse($reservation->ReservationItems as $item)
                                                <div class="col-12">
                                                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3 p-3 border rounded-3 bg-white">
                                                        <div class="d-flex align-items-center gap-3">
                                                            @if(!empty($item->product->image_main))
                                                                <img src="{{ asset('storage/' . $item->product->image_main) }}" alt="{{ $item->product->name ?? 'Producto' }}" class="rounded-3" style="width: 64px; height: 64px; object-fit: cover;" onerror="this.src='{{ asset('images/no-image.png') }}'">
                                                            @else
                                                                <div class="rounded-3 bg-secondary-subtle d-flex justify-content-center align-items-center" style="width: 64px; height: 64px;">
                                                                    <i class="fa fa-box text-secondary"></i>
                                                                </div>
                                                            @endif
                                                            <div>
                                                                <p class="fw-semibold mb-1">{{ $item->product->name ?? 'Producto eliminado' }}</p>
                                                                <p class="small text-muted mb-1">{{ $item->product->oem ?? 'Sin referencia' }}</p>
                                                                <p class="small text-muted mb-0">Cantidad: {{ $item->quantity }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="text-md-end">
                                                            <p class="small text-muted mb-1">Precio unitario</p>
                                                            <p class="fw-semibold mb-1">Bs. {{ number_format($item->unite_price, 2) }}</p>
                                                            <p class="fw-bold mb-0">Subtotal: Bs. {{ number_format($item->item_subtotal, 2) }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @empty
                                                <div class="col-12">
                                                    <div class="border rounded-3 p-4 text-center text-muted">
                                                        No hay productos registrados en esta reserva.
                                                    </div>
                                                </div>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3 border-top pt-3">
                                    
                                    <div class="text-md-end">
                                        <p class="small text-muted mb-1">Total estimado</p>
                                        <p class="h4 fw-bold mb-0">Bs. {{ number_format($reservation->total, 2) }}</p>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="p-4 p-lg-5 text-center">
                                <div class="display-1 mb-3">🔎</div>
                                <h3 class="h4 fw-bold">No encontramos esa reserva</h3>
                                <p class="text-muted mb-0">Verifica el código ingresado o intenta nuevamente en unos minutos.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

