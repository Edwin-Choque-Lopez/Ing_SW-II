@extends('layouts.web')
@section('content')

    <!-- Open Content -->
    <section class="bg-light">
        <div class="container pb-5">
            <div class="row">
                <div class="col-lg-12 mt-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-body">
                                <!-- Encabezado del Carrito / Datos de la Orden -->
                                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center border-bottom pb-3 mb-4 gap-2">
                                    <div>
                                        <h5 class="text-dark mb-1">Orden de Reserva: <span class="fw-bold text-primary">{{ $shopping->code_order }}</span></h5>
                                        <p class="text-dark small mb-0">
                                            <i class="fa fa-user me-1"></i> Cliente: {{ $shopping->user->name }} | 
                                            <i class="fa fa-envelope me-1"></i> {{ $shopping->user->email }}
                                        </p>
                                    </div>
                                    <div class="text-md-end">
                                        <span class="badge bg-warning-subtle text-warning border border-warning-subtle px-3 py-2 rounded-pill fw-semibold d-inline-block mb-1">
                                            <i class="fa fa-clock me-1"></i> {{ $shopping->status->name }}
                                        </span>
                                        <p class="text-danger small mb-0 fw-medium">
                                            <i class="fa fa-exclamation-circle me-1"></i> Expira: {{ \Carbon\Carbon::parse($shopping->expiry_date)->format('d/m/Y H:i') }}
                                        </p>
                                    </div>
                                </div>

                                <!-- Inicializamos acumulador para el total real -->
                                @php $totalReal = 0; @endphp

                                <!-- Tabla de Productos del Carrito -->
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle">
                                        <thead class="table-light text-secondary small text-uppercase">
                                            <tr>
                                                <th scope="col" style="min-width: 250px;">Producto / Repuesto</th>
                                                <th scope="col" class="text-center">Precio Unit.</th>
                                                <th scope="col" class="text-center" style="width: 120px;">Cantidad</th>
                                                <th scope="col" class="text-end">Subtotal</th>
                                                <th scope="col" class="text-center" style="width: 60px;"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($shopping->reservationItems ?? [] as $item)
                                                @php $totalReal += $item->item_subtotal; @endphp
                                                <tr>
                                                    <!-- Celda Producto con Imagen y Detalle Técnico -->
                                                    <td>
                                                        <div class="d-flex align-items-center gap-3">
                                                            <img src="{{ asset('storage/' . $item->product->image_main) }}" 
                                                                alt="{{ $item->product->name }}" 
                                                                class="rounded border bg-light object-fit-cover"
                                                                style="width: 60px; height: 60px; min-width: 60px;"
                                                                onerror="this.src='{{ asset('images/no-image.png') }}'">
                                                            <div>
                                                                <h6 class="text-dark mb-0 fw-semibold">{{ $item->product->name }}</h6>
                                                                <div class="text-muted x-small d-flex flex-wrap gap-2 mt-1" style="font-size: 0.8rem;">
                                                                    <span class="badge bg-light text-secondary border">OEM: {{ $item->product->oem }}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <!-- Precio de Venta Unitario -->
                                                    <td class="text-center fw-medium text-dark">
                                                        ${{ number_format($item->unite_price, 2) }}
                                                    </td>
                                                    <!-- Cantidad Solicitada -->
                                                    <td class="text-center">
                                                        <span class="badge bg-secondary-subtle text-dark border px-3 py-2 fs-6 fw-normal rounded">
                                                            {{ $item->quantity }} u.
                                                        </span>
                                                    </td>
                                                    <!-- Subtotal del Ítems -->
                                                    <td class="text-end fw-bold text-dark">
                                                        ${{ number_format($item->item_subtotal, 2) }}
                                                    </td>
                                                    <!-- Botón para Eliminar Fila (Opcional) -->
                                                    <td class="text-center">
                                                        <form action="{{ route('item.delete', $item->id) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <input type="hidden" name="code_order" value="{{$shopping->code_order}}">
                                                            <button type="submit" class="btn btn-sm btn-outline-danger border-0 p-2" title="Quitar producto">
                                                                <i class="fa fa-trash-alt"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Notas y Panel de Totales de Cierre -->
                                <div class="row g-4 mt-2">
                                    <!-- Notas del pedido -->
                                    <div class="col-lg-7">
                                        <div class="bg-light p-3 rounded h-100">
                                            <h6 class="text-dark fw-bold mb-2"><i class="fa fa-sticky-note me-2 text-muted"></i>Notas de la Reserva</h6>
                                            <p class="text-muted small mb-0 italic">
                                                {{ $shopping->notes ?? 'No se ingresaron observaciones adicionales para esta orden de reserva.' }}
                                            </p>
                                        </div>
                                    </div>
                                    
                                    <!-- Cuadro Resumen Financiero -->
                                    <div class="col-lg-5">
                                        <form action="{{ route('reserve') }}" method="POST" class="border rounded p-3 bg-light-subtle">
                                            @csrf
                                            
                                            <!-- Input oculto para enviar el total real calculado al controlador -->
                                            <input type="hidden" name="total_reserva" value="{{ $totalReal }}">
                                            
                                            <!-- Input oculto para enviar el código de orden (útil para saber qué reserva cerrar) -->
                                            <input type="hidden" name="code_order" value="{{ $shopping->code_order }}">
                                            
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <span class="text-dark fw-bold fs-5">Monto Total:</span>
                                                <span class="text-primary fw-extrabold fs-4">${{ number_format($totalReal, 2) }}</span>
                                            </div>
                                            
                                            <hr class="my-2">
                                            
                                            <!-- Acciones Finales -->
                                            <div class="d-grid gap-2">
                                                <!-- Cambiado de <a> a <button type="submit"> -->
                                                <button type="submit" class="btn btn-primary fw-bold py-2 shadow-sm">
                                                    <i class="fa fa-check-circle me-2"></i>Confirmar Reserva
                                                </button>
                                                
                                                <a href="{{ route('catalog.products') }}" class="btn btn-outline-secondary btn-sm py-2">
                                                    <i class="fa fa-arrow-left me-2"></i>Seguir Buscando Repuestos
                                                </a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>  
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endsection