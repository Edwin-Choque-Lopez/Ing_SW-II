<!doctype html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Reserva {{ $code }}</title>
	<style>
		body { font-family: DejaVu Sans, Helvetica, Arial, sans-serif; font-size:12px; color:#222 }
		.header { display:flex; justify-content:space-between; align-items:center; margin-bottom:20px }
		.logo img { max-height:80px; }
		.institution { text-align:right }
		h1 { font-size:18px; margin:0 }
		.meta { margin-bottom:10px }
		table { width:100%; border-collapse:collapse; margin-top:10px }
		table th, table td { border:1px solid #ddd; padding:8px; text-align:left }
		table th { background:#f7f7f7 }
		.text-right { text-align:right }
		.totals { margin-top:12px; width:100%; }
		.totals td { padding:6px }
		.small { font-size:11px; color:#555 }
		.section { margin-top:18px }
	</style>
</head>
<body>
	<div class="header">
		<div class="logo">
			@if(!empty($institution) && !empty($institution->logo_path))
				<img src="{{ public_path('storage/' . $institution->logo_path) }}" alt="{{ $institution->name }}">
			@endif
		</div>
		<div class="institution">
			@if($institution)
				<strong>{{ $institution->name }}</strong><br>
				<span class="small">NIT: {{ $institution->nit }}</span><br>
				<span class="small">{{ $institution->address }} - {{ $institution->city }}</span><br>
				<span class="small">Tel/WhatsApp: {{ $institution->phone_whatsapp }}</span><br>
				<span class="small">Email: {{ $institution->email }}</span>
			@endif
		</div>
	</div>

	<div class="section">
		<h1>Detalle de la reserva</h1>
		<div class="meta small">
			<strong>Código:</strong> {{ $code }} &nbsp; | &nbsp;
			<strong>Estado:</strong> {{ $reservation->status->name ?? 'N/A' }} &nbsp; | &nbsp;
			<strong>Fecha:</strong> {{ $reservation->created_at ? $reservation->created_at->format('d/m/Y H:i') : '' }}
		</div>
	</div>

	<div class="section">
		<h2>Items</h2>
		<table>
			<thead>
				<tr>
					<th>#</th>
					<th>Producto</th>
					<th class="text-right">Cantidad</th>
					<th class="text-right">Precio unitario</th>
					<th class="text-right">Subtotal</th>
				</tr>
			</thead>
			<tbody>
				@php $i = 1; @endphp
				@foreach($reservation->reservationItems as $item)
					<tr>
						<td>{{ $i++ }}</td>
						<td>{{ $item->product->name ?? 'Sin producto' }}
							@if(!empty($item->product->description))<div class="small">{{ $item->product->description }}</div>@endif
						</td>
						<td class="text-right">{{ $item->quantity }}</td>
						<td class="text-right">{{ number_format($item->unite_price, 2, ',', '.') }}</td>
						<td class="text-right">{{ number_format($item->item_subtotal, 2, ',', '.') }}</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>

	@php
		$subtotal = $reservation->reservationItems->sum(function($it){
			return $it->item_subtotal ?? ($it->quantity * $it->unite_price);
		});
		$total = $reservation->total ?? $subtotal;
	@endphp

	<table class="totals">
		<tr>
			<td style="width:70%"></td>
			<td style="width:30%">
				<table style="width:100%">
					<tr>
						<td class="small">Subtotal</td>
						<td class="text-right">{{ number_format($subtotal, 2, ',', '.') }}</td>
					</tr>
					<tr>
						<td class="small">Total</td>
						<td class="text-right"><strong>{{ number_format($total, 2, ',', '.') }}</strong></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>

	<div class="section">
		<h2>Información del cliente</h2>
		@if($reservation->user)
			<strong>{{ $reservation->user->name }}</strong><br>
			<div class="small">CI: {{ $reservation->user->ci ?? 'N/A' }}</div>
			<div class="small">Teléfono: {{ $reservation->user->phone ?? 'N/A' }}</div>
			<div class="small">Email: {{ $reservation->user->email ?? 'N/A' }}</div>
		@else
			<div class="small">Sin información de usuario</div>
		@endif
	</div>

	@if(!empty($reservation->notes))
		<div class="section">
			<h3>Notas</h3>
			<div class="small">{{ $reservation->notes }}</div>
		</div>
	@endif

</body>
</html>

