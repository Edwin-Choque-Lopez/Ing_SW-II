@extends('layouts.admin')
@section('title')
    <h3>Configuracion</h3>
    <p class="text-subtitle text-muted">En este apartado podra registrar nuevos estados de productos, reservaciones, registrar nuevas marcas y categorias.</p>
@endsection
@section('navegacion')
    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Configuración</a></li>
            <li class="breadcrumb-item active" aria-current="page">Ajustes</li>
            <li class="breadcrumb-item active" aria-current="page">Registro</li>
        </ol>
    </nav>
@endsection
@section('content')
<div class="row">
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <h4 class="card-title">Formularios de registro</h4>
                <h6 class="card-subtitle">Solo rellene los campos del formulario de su interes.</h6>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div id="contenedor-errores">
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-light-danger color-danger alert-dismissible show fade">
                                <i class="bi bi-exclamation-circle"></i> 
                                {{ $error }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endforeach
                    </div>

                    <script>
                        setTimeout(function() {
                            const contenedor = document.getElementById('contenedor-errores');
                            if (contenedor) {
                                const alertas = contenedor.querySelectorAll('.alert');
                                alertas.forEach(alerta => {
                                    const bsAlert = new bootstrap.Alert(alerta);
                                    bsAlert.close();
                                });
                            }
                        }, 10000);
                    </script>
                @endif
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-4">
                        <div class="list-group" role="tablist">
                            <a class="list-group-item list-group-item-action active" id="list-home-list" data-bs-toggle="list" href="#category_form" role="tab" aria-selected="true" tabindex="-1"><i class="bi bi-inboxes-fill"></i> Categorias</a>
                            <a class="list-group-item list-group-item-action" id="list-profile-list" data-bs-toggle="list" href="#brand_form" role="tab" aria-selected="false" tabindex="-1"><i class="bi bi-bag-fill"></i> Marcas</a>
                            <a class="list-group-item list-group-item-action" id="list-messages-list" data-bs-toggle="list" href="#status_product_form" role="tab" aria-selected="false" tabindex="-1"><i class="bi bi-ui-radios"></i> Estado de producto</a>
                            <a class="list-group-item list-group-item-action" id="list-settings-list" data-bs-toggle="list" href="#status_reservation_form" role="tab" aria-selected="false"><i class="bi bi-ui-checks"></i> Estado de reservación</a>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-8 mt-1">
                        <div class="tab-content text-justify" id="nav-tabContent">
                            <div class="tab-pane" id="category_form" role="tabpanel" aria-labelledby="list-home-list">
                                <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12">
                                            <div class="col-md-12">
                                                <label class="form-label">Nombre de la categoria</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="bi bi-pen"></i></span>
                                                    <input name="nombre_categoria" type="text" class="form-control" placeholder="Nombre de la categoria"
                                                    required>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-12">
                                                <label class="form-label">Descripción</label>
                                                <div class="form-group with-title mb-3">
                                                    <textarea class="form-control" rows="3" name="descripcion_corta" ></textarea>
                                                    <label>Redacte una descripción de la categoria</label>
                                                </div>
                                            </div> 
                                            <div class="col-md-12 mb-12">
                                                <div class="form-group">
                                                    <button class="btn btn-primary" type="submit">Registrar categoria</button>  
                                                    <a href="{{ route('home') }}" class="btn btn-secondary">Cancelar</a>
                                                </div>
                                            </div>  
                                        </div>
                                    </div>
                                </form>
                            </div>
                             <div class="tab-pane active show" id="brand_form" role="tabpanel" aria-labelledby="list-home-list">
                                <form action="{{ route('brands.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-9 col-md-12">
                                            <div class="col-md-12">
                                                <label class="form-label">Nombre de la marca</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="bi bi-pen"></i></span>
                                                    <input name="nombre_marca" type="text" class="form-control" placeholder="Nombre de la marca" required>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <label class="form-label">Pais de origen</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="bi bi-justify"></i></span>
                                                    <input name="pais_origen" type="text" class="form-control" placeholder="Pais de origen de la marca" required>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-12">
                                                <label class="form-label"></label>
                                                <div class="form-group">
                                                    <button class="btn btn-primary" type="submit">Registrar marca</button>  
                                                    <a href="{{ route('home') }}" class="btn btn-secondary">Cancelar</a>
                                                </div>
                                            </div> 
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane" id="status_reservation_form" role="tabpanel" aria-labelledby="list-messages-list">
                                
                            </div>
                            <div class="tab-pane" id="status_product_form" role="tabpanel" aria-labelledby="list-settings-list">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection