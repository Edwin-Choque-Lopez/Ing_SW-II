@extends('layouts.admin')
@section('title')
    <h3>Configuracion del Sistema</h3>
    <p class="text-subtitle text-muted">En este aparatado usted puede ver las configuraciones del sistema</p>
@endsection
@section('navegacion')
    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Configuraciones</a></li>
            <li class="breadcrumb-item active" aria-current="page">Ajustes</li>
        </ol>
    </nav>
@endsection
@section('content')
<div class="row">
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <h4 class="card-title">Formulario de registro</h4>
                <h6 class="card-subtitle">Rellena los campos para registrar un nuevo producto</h6>
            </div>
            <div class="card-body">
            </div>
        </div>
    </div>
</div>
@endsection