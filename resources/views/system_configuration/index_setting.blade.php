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
                <h4 class="card-title">Listado de ajustes
                     <a href="{{ route('categories.create') }}" style="float: right;" type="button" class="btn btn-outline-primary" type="button" class="btn btn-outline-primary"><i class="bi bi-pencil"> Agregar un ajuste</i></a>
                </h4>
                
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-7">
                        <div style="text-align: center"><h4>Lista de categorias</h4></div>
                        <table class="table table-hover table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                    @foreach($categorias as $categoria)
                                    <tr>
                                        <td>{{ $categoria->name }}</td>
                                        <td>{{ $categoria->description_short }}</td>
                                        <td class="d-flex justify-content-center gap-2">                                    
                                                <!-- Button trigger for primary themes modal -->
                                                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalcategoria{{ $categoria->id }}">
                                                    <i class="bi bi-pen"></i>
                                                </button>
                                                <!--primary theme Modal -->
                                                <div class="modal fade text-left" id="modalcategoria{{ $categoria->id }}" tabindex="-1" aria-labelledby="myModalLabel160" style="display: none;" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-primary">
                                                                <h5 class="modal-title white" id="myModalLabel160">Primary Modal
                                                                </h5>
                                                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="{{ route('categories.update', $categoria->id) }}" method="POST" enctype="multipart/form-data">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="row">
                                                                        <div class="col-lg-12 col-md-12">
                                                                            <div class="col-md-12">
                                                                                <label class="form-label">Nombre de la categoria</label>
                                                                                <div class="input-group">
                                                                                    <span class="input-group-text"><i class="bi bi-pen"></i></span>
                                                                                    <input name="nombre_categoria" type="text" class="form-control" value="{{ $categoria->name }}" required>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-12 mb-12">
                                                                                <label class="form-label">Descripción</label>
                                                                                <div class="form-group with-title mb-3">
                                                                                    <textarea class="form-control" rows="3" name="descripcion_corta" >{{$categoria->description_short}}</textarea>
                                                                                    <label>Redacte una descripción de la categoria</label>
                                                                                </div>
                                                                            </div> 
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                                                                    <i class="bx bx-x d-block d-sm-none"></i>
                                                                                    <span class="d-none d-sm-block">Cancelar</span>
                                                                                </button>
                                                                                <button type="submit" class="btn btn-primary ms-1" data-bs-dismiss="modal">
                                                                                    <i class="bx bx-check d-block d-sm-none"></i>
                                                                                    <span class="d-none d-sm-block">Actualizar</span>
                                                                                </button>
                                                                            </div> 
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            <form action="{{ route('categories.destroy', $categoria->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger" class="btn btn-outline-primary" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar esta categoría?')"><i class="bi bi-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @if ($categorias->hasPages())
                            <div class="d-flex justify-content-left">
                                {{ $categorias->links('pagination::bootstrap-5') }}
                            </div>
                        @endif
                    </div>
                    <div class="col-12 col-sm-12 col-md-5">
                        <div style="text-align: center"><h4>Lista de Marcas</h4></div>
                        <table class="table table-hover table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Pais de origen</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($marcas as $marca)
                                <tr>
                                    <td>{{ $marca->name }}</td>
                                    <td>{{ $marca->country_origin }}</td>
                                    <td class="d-flex justify-content-center gap-2">                                    
                                            <!-- Button trigger for primary themes modal -->
                                            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalmarca{{ $marca->id }}">
                                                <i class="bi bi-pen"></i>
                                            </button>
                                            <!--primary theme Modal -->
                                            <div class="modal fade text-left" id="modalmarca{{ $marca->id }}" tabindex="-1" aria-labelledby="myModalLabel160" style="display: none;" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-primary">
                                                            <h5 class="modal-title white" id="myModalLabel160">Primary Modal
                                                            </h5>
                                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('brands.update', $marca->id) }}" method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="row">
                                                                    <div class="col-lg-12 col-md-12">
                                                                        <div class="col-md-12">
                                                                            <label class="form-label">Nombre de la marca</label>
                                                                            <div class="input-group">
                                                                                <span class="input-group-text"><i class="bi bi-pen"></i></span>
                                                                                <input name="nombre_marca" type="text" class="form-control" value="{{ $marca->name }}" required>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <label class="form-label">Pais de origen</label>
                                                                            <div class="input-group">
                                                                                <span class="input-group-text"><i class="bi bi-justify"></i></span>
                                                                                <input name="pais_origen" type="text" class="form-control" value="{{ $marca->country_origin }}" required>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                                                                <i class="bx bx-x d-block d-sm-none"></i>
                                                                                <span class="d-none d-sm-block">Cancelar</span>
                                                                            </button>
                                                                            <button type="submit" class="btn btn-primary ms-1" data-bs-dismiss="modal">
                                                                                <i class="bx bx-check d-block d-sm-none"></i>
                                                                                <span class="d-none d-sm-block">Actualizar</span>
                                                                            </button>
                                                                        </div> 
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>  
                                                    </div>
                                                </div>
                                            </div>
                                            <form action="{{ route('categories.destroy', $categoria->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger" class="btn btn-outline-primary" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar esta categoría?')"><i class="bi bi-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @if ($marcas->hasPages())
                            <div class="d-flex justify-content-left">
                                {{ $marcas->links('pagination::bootstrap-5') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection