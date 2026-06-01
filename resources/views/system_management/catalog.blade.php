@extends('layouts.admin')
@section('title')
    <h3>Gestión de Catálogo</h3>
    <p class="text-subtitle text-muted">Este módulo agrupa las características que definen la naturaleza del artículo.</p>
@endsection
@section('navegacion')
    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
            <li class="breadcrumb-item active" aria-current="page">Gestión del Sistema</li>
            <li class="breadcrumb-item active" aria-current="page">Catalogo</li>
        </ol>
    </nav>
@endsection
@section('content')
<div class="row">
    <div class="col-12 col-md-6">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title mb-0">CATEGORÍAS</h4>
                <!-- Botón para abrir el modal de creación de categoría -->
                <div class="modal-primary me-1 mb-1 d-inline-block">
                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#createcategory">
                         <i class="bi bi-plus-square-fill"></i> CREAR
                    </button>
                    <!-- Modal de creación de categoría -->
                    <div class="modal fade text-left" id="createcategory" tabindex="-1" aria-labelledby="myModalLabel160" style="display: none;" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                            <div class="modal-content">
                                <div class="modal-header bg-primary">
                                    <h5 class="modal-title white" id="myModalLabel160">
                                        Crear nueva categoría
                                    </h5>
                                    <!--Boton para cerrar el modal-->
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>Los campos marcados con * son obligatorios</p>
                                     <form action="{{ route('category.create') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="create_type" value="category">
                                        <div class="row">
                                            <div class="col-md-12 mb-3">
                                                <label class="form-label">Nombre de la categoria*</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="bi bi-pen"></i></span>
                                                    <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Nombre de la categoria"
                                                    value="{{ old('name') }}" required>
                                                    @error('name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-12 mb-3">
                                                <label for="oem" class="form-label">Categoria Padre</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="bi bi-arrow-bar-down"></i></span>
                                                    <select name="parent_id" class="form-select @error('parent_id') is-invalid @enderror">
                                                        <option value="">Seleccionar Categoria</option>
                                                        @foreach($parentCategories as $id_parent => $name_parent)
                                                            <option value="{{ $id_parent }}" {{ old('parent_id') == $id_parent ? 'selected' : '' }}>
                                                                {{ $name_parent }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('parent_id')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            
                                            <div class="card border rounded p-3 h-100">
                                                <div class="d-flex align-items-center justify-content-between mb-3">
                                                    <div>
                                                        <h5 class="mb-1">Foto de Categoria</h5>
                                                        <p class="text-muted mb-0">Sube una imagen solo para las categorias padres</p>
                                                    </div>
                                                    <span class="badge bg-primary">Vista previa</span>
                                                </div>
                                                <div class="text-center mb-3">
                                                    <div id="categoryPhotoPreviewPlaceholder" class="d-flex align-items-center justify-content-center rounded bg-light" style="height: 240px;">
                                                        <i class="bi bi-image fs-1 text-secondary"></i>
                                                    </div>
                                                    <img id="categoryPhotoPreview" src="#" alt="Foto de categoria" class="img-fluid rounded mx-auto d-block d-none" style="max-height: 240px;">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="photo" class="form-label">Seleccionar imagen</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text"><i class="bi bi-image"></i></span>
                                                        <input type="file" id="photo" name="photo" class="form-control @error('photo') is-invalid @enderror" accept="image/*" onchange="previewCategoryPhoto(event)">
                                                        @error('photo')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12 mb-3">
                                                <label for="Especificaciones" class="form-label">Descripción</label>
                                                <div class="form-group with-title mb-3">
                                                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="3" >{{ old('description') }}</textarea>
                                                    <label>Redacte una descripción de la categoria</label>
                                                    @error('description')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                                <i class="bx bx-x d-block d-sm-none"></i>
                                                <span class="d-none d-sm-block">Cancelar</span>
                                            </button>
                                            <button type="submit" class="btn btn-primary ms-1" data-bs-dismiss="modal">
                                                <i class="bx bx-check d-block d-sm-none"></i>
                                                <span class="d-none d-sm-block">Registrar</span>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <p>En este apartado puede gestionar las categorías de productos del sistema.</p>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th style="text-align: center;">Nombre</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $category)
                                    <tr>
                                        <td>{{ Str::limit($category->name, 20, '...')}} </td>
                                        <td class="d-flex justify-content-center gap-2">
                                            <button type="button" class="btn btn-outline-info btn-sm" data-bs-toggle="modal" data-bs-target="#showcategory{{ $category->id }}">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                            <button type="button" class="btn btn-outline-success btn-sm" data-bs-toggle="modal" data-bs-target="#editcategory{{ $category->id }}">
                                                <i class="bi bi-pen"></i>
                                            </button>
                                            <form id="delete-category-{{ $category->id }}" action="{{ route('category.destroy', $category->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-outline-danger btn-sm" 
                                                        onclick="confirmDelete('delete-category-{{ $category->id }}', 'esta categoría')">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        @foreach($categories as $category)
                            <div class="modal fade text-left" id="editcategory{{ $category->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $category->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-success">
                                            <h5 class="modal-title white" id="editModalLabel{{ $category->id }}">
                                                Editar categoría
                                            </h5>
                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Los campos marcados con * son obligatorios</p>
                                            <form action="{{ route('category.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="edit_id" value="{{ $category->id }}">
                                                <div class="row">
                                                    <div class="col-md-12 mb-3">
                                                        <label class="form-label">Nombre de la categoria*</label>
                                                        <div class="input-group">
                                                            <span class="input-group-text"><i class="bi bi-pen"></i></span>
                                                            <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Nombre de la categoria"
                                                            value="{{ $category->name }}" required>
                                                            @error('name')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-12 mb-3">
                                                        <label for="oem" class="form-label">Categoria Padre</label>
                                                        <div class="input-group">
                                                            <span class="input-group-text"><i class="bi bi-arrow-bar-down"></i></span>
                                                            <select name="parent_id" class="form-select @error('parent_id') is-invalid @enderror">
                                                                <option value="">Seleccionar Categoria</option>
                                                                @foreach($parentCategories as $id_parent => $name_parent)
                                                                    <option value="{{ $id_parent }}" {{ $category->parent_id == $id_parent ? 'selected' : '' }}>
                                                                        {{ $name_parent }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            @error('parent_id')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-md-12 mb-3">
                                                        <div class="card border rounded p-3 h-100">
                                                            <div class="mb-3">
                                                                <label for="image_main_{{ $category->id }}" class="form-label">Foto de categoría</label>
                                                                <div class="input-group">
                                                                    <span class="input-group-text"><i class="bi bi-image-fill"></i></span>
                                                                    <input type="file" id="image_main_{{ $category->id }}" name="photo" class="form-control @error('photo') is-invalid @enderror" accept="image/*" onchange="previewCategoryImage(event, '{{ $category->id }}')">
                                                                </div>
                                                                @error('photo')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>

                                                            <div class="text-center mb-3">
                                                                <div id="productImagePlaceholder{{ $category->id }}" class="d-flex align-items-center justify-content-center rounded bg-light {{ $category->photo ? 'd-none' : '' }}" style="height: 240px;">
                                                                    <i class="bi bi-image fs-1 text-secondary"></i>
                                                                </div>
                                                                <img id="productImagePreview{{ $category->id }}" data-current-src="{{ $category->photo ? asset('storage/' . $category->photo) : '' }}" src="{{ $category->photo ? asset('storage/' . $category->photo) : '' }}" alt="Vista previa de categoría" class="img-fluid rounded mx-auto d-block {{ $category->photo ? '' : 'd-none' }}" style="max-height: 240px;">
                                                            </div>
                                                        </div>
                                                    </div>    
                                                    
                                                    <div class="col-md-12 mb-3">
                                                        <label for="Especificaciones" class="form-label">Descripción</label>
                                                        <div class="form-group with-title mb-3">
                                                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="3" >{{ old('description') ?? $category->description }}</textarea>
                                                            <label>Redacte una descripción de la categoria</label>
                                                            @error('description')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                                        <i class="bx bx-x d-block d-sm-none"></i>
                                                        <span class="d-none d-sm-block">Cancelar</span>
                                                    </button>
                                                    <button type="submit" class="btn btn-success ms-1">
                                                        <i class="bx bx-check d-block d-sm-none"></i>
                                                        <span class="d-none d-sm-block">Actualizar</span>
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                             <div class="modal fade text-left" id="showcategory{{ $category->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $category->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-info">
                                            <h5 class="modal-title white" id="editModalLabel{{ $category->id }}">
                                                Información de la categoría
                                            </h5>
                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="hidden" name="edit_id" value="{{ $category->id }}">
                                            <div class="row">
                                                <div class="col-md-12 mb-3">
                                                    <label class="form-label">Nombre de la categoria</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text"><i class="bi bi-pen"></i></span>
                                                        <input name="name" type="text" class="form-control"
                                                        value="{{ $category->name }}" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-12 mb-3">
                                                    <label for="oem" class="form-label">Categoria Padre</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text"><i class="bi bi-arrow-bar-down"></i></span>
                                                            {{-- 1. Buscamos el nombre del padre una sola vez --}}
                                                            @php
                                                                $parentName = $parentCategories[$category->parent_id] ?? 'Sin Categoría Padre';
                                                            @endphp

                                                            {{-- 2. Renderizamos el input una sola vez --}}
                                                            <input type="text" value="{{ $parentName }}" class="form-control" readonly>

                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                    <label for="Especificaciones" class="form-label">Descripción</label>
                                                    <div class="form-group with-title mb-3">
                                                        <textarea name="description_" class="form-control" rows="3" readonly>{{ old('description_short') ?? $category->description }}</textarea>
                                                        <label>Descripción de la categoria</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light-secondary col-md-12" data-bs-dismiss="modal">
                                                    <i class="bx bx-x d-block d-sm-none"></i>
                                                    <span class="d-none d-sm-block">Cerrar</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        @if ($categories->hasPages())
                            <div class="d-flex justify-content-left">
                                {{ $categories->links('pagination::bootstrap-5') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="col-12 col-md-6">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title mb-0">Marcas</h4>
                <!-- Botón para abrir el modal de creación de categoría -->
                <div class="modal-primary me-1 mb-1 d-inline-block">
                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#createbrand">
                         <i class="bi bi-plus-square-fill"></i> CREAR
                    </button>
                    <!-- Modal de creación de categoría -->
                    <div class="modal fade text-left" id="createbrand" tabindex="-1" aria-labelledby="myModalLabel160" style="display: none;" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                            <div class="modal-content">
                                <div class="modal-header bg-primary">
                                    <h5 class="modal-title white" id="myModalLabel160">
                                        Registrar Nueva Marca
                                    </h5>
                                    <!--Boton para cerrar el modal-->
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>Los campos marcados con * son obligatorios</p>
                                     <form action="{{ route('brands.create') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="create_type" value="brand">
                                        <div class="row">
                                            <div class="col-12 col-md-12 mb-3">
                                                <label class="form-label">Nombre de la marca*</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="bi bi-pen"></i></span>
                                                    <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Nombre del descuento"
                                                    value="{{ old('name') }}" required>
                                                    @error('name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-12 mb-3">
                                                <label class="form-label">Pais de origen</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="bi bi-globe-americas"></i></span>
                                                    <input name="country_origin" type="text" class="form-control @error('country_origin') is-invalid @enderror" placeholder="Pais de origen"
                                                    value="{{ old('country_origin') }}" >
                                                    @error('country_origin')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="card border rounded p-3 h-100">
                                                <div class="d-flex align-items-center justify-content-between mb-3">
                                                    <div>
                                                        <h5 class="mb-1">Foto de Marca</h5>
                                                        <p class="text-muted mb-0">Sube el logo de la marca</p>
                                                    </div>
                                                    <span class="badge bg-primary">Vista previa</span>
                                                </div>
                                                <div class="text-center mb-3">
                                                    <div id="brandPhotoPreviewPlaceholder" class="d-flex align-items-center justify-content-center rounded bg-light" style="height: 240px;">
                                                        <i class="bi bi-image fs-1 text-secondary"></i>
                                                    </div>
                                                    <img id="brandPhotoPreview" src="#" alt="Foto de marca" class="img-fluid rounded mx-auto d-block d-none" style="max-height: 240px;">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="photo" class="form-label">Seleccionar imagen</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text"><i class="bi bi-image"></i></span>
                                                        <input type="file" id="logo" name="logo" class="form-control @error('logo') is-invalid @enderror" accept="image/*" onchange="previewBrandPhoto(event)">
                                                        @error('logo')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                                <i class="bx bx-x d-block d-sm-none"></i>
                                                <span class="d-none d-sm-block">Cancelar</span>
                                            </button>
                                            <button type="submit" class="btn btn-primary ms-1" data-bs-dismiss="modal">
                                                <i class="bx bx-check d-block d-sm-none"></i>
                                                <span class="d-none d-sm-block">Registrar</span>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <p>En este apartado puede gestionar las categorías de productos del sistema.</p>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th style="text-align: center;">Nombre</th>
                                    <th style="text-align: center;">Pais de origen</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($brands as $brand)
                                    <tr>
                                        <td>{{ $brand->name }}</td>
                                        <td>{{ $brand->country_origin }}</td>
                                        <td class="d-flex justify-content-center gap-2">
                                            <button type="button" class="btn btn-outline-info btn-sm" data-bs-toggle="modal" data-bs-target="#showbrand{{ $brand->id }}">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                            <button type="button" class="btn btn-outline-success btn-sm" data-bs-toggle="modal" data-bs-target="#editbrand{{ $brand->id }}">
                                                <i class="bi bi-pen"></i>
                                            </button>
                                            <form id="delete-brand-{{ $brand->id }}" action="{{ route('brands.destroy', $brand->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-outline-danger btn-sm" 
                                                        onclick="confirmDelete('delete-brand-{{ $brand->id }}', 'esta marca')">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        @foreach($brands as $brand)
                            <div class="modal fade text-left" id="editbrand{{ $brand->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $brand->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-success">
                                            <h5 class="modal-title white" id="editModalLabel{{ $brand->id }}">
                                                Editar marca
                                            </h5>
                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Los campos marcados con * son obligatorios</p>
                                            <form action="{{ route('brands.update', $brand->id) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="edit_brand_id" value="{{ $brand->id }}">
                                                <div class="row">
                                                    <div class="col-12 col-md-12 mb-3">
                                                        <label class="form-label">Nombre de la marca*</label>
                                                        <div class="input-group">
                                                            <span class="input-group-text"><i class="bi bi-pen"></i></span>
                                                            <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Nombre de la marca"
                                                            value="{{ $brand->name }}" required>
                                                            @error('name')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-12 mb-3">
                                                        <label class="form-label">Pais de origen</label>
                                                        <div class="input-group">
                                                            <span class="input-group-text"><i class="bi bi-globe-americas"></i></span>
                                                            <input name="country_origin" type="text" class="form-control @error('country_origin') is-invalid @enderror" placeholder="Pais de origen"
                                                            value="{{ $brand->country_origin }}">
                                                            @error('country_origin')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-md-12 mb-3">
                                                        <div class="card border rounded p-3 h-100">
                                                            <div class="mb-3">
                                                                <label for="image_main_{{ $brand->id }}" class="form-label">Foto de marca</label>
                                                                <div class="input-group">
                                                                    <span class="input-group-text"><i class="bi bi-image-fill"></i></span>
                                                                    <input type="file" id="image_main_{{ $brand->id }}" name="logo" class="form-control @error('logo') is-invalid @enderror" accept="image/*" onchange="previewBrandImage(event, '{{ $brand->id }}')">
                                                                </div>
                                                                @error('logo')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>

                                                            <div class="text-center mb-3">
                                                                <div id="brandImagePlaceholder{{ $brand->id }}" class="d-flex align-items-center justify-content-center rounded bg-light {{ $brand->logo ? 'd-none' : '' }}" style="height: 240px;">
                                                                    <i class="bi bi-image fs-1 text-secondary"></i>
                                                                </div>
                                                                <img id="brandImagePreview{{ $brand->id }}" data-current-src="{{ $brand->logo ? asset('storage/' . $brand->logo) : '' }}" src="{{ $brand->logo ? asset('storage/' . $brand->logo) : '' }}" alt="Vista previa de marca" class="img-fluid rounded mx-auto d-block {{ $brand->logo ? '' : 'd-none' }}" style="max-height: 240px;">
                                                            </div>
                                                        </div>
                                                    </div>


                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                                        <i class="bx bx-x d-block d-sm-none"></i>
                                                        <span class="d-none d-sm-block">Cancelar</span>
                                                    </button>
                                                    <button type="submit" class="btn btn-success ms-1">
                                                        <i class="bx bx-check d-block d-sm-none"></i>
                                                        <span class="d-none d-sm-block">Actualizar</span>
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                             <div class="modal fade text-left" id="showbrand{{ $brand->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $brand->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-info">
                                            <h5 class="modal-title white" id="editModalLabel{{ $brand->id }}">
                                                Información de la marca
                                            </h5>
                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-12 col-md-12 mb-3">
                                                        <label class="form-label">Nombre de la marca</label>
                                                        <div class="input-group">
                                                            <span class="input-group-text"><i class="bi bi-pen"></i></span>
                                                            <input name="name" type="text" class="form-control"
                                                            value="{{ $brand->name }}" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-12 mb-3">
                                                        <label class="form-label">Pais de origen</label>
                                                        <div class="input-group">
                                                            <span class="input-group-text"><i class="bi bi-globe-americas"></i></span>
                                                            <input name="country_origin" type="text" class="form-control"
                                                            value="{{ $brand->country_origin }}" readonly>
                                                        </div>
                                                    </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light-secondary col-md-12" data-bs-dismiss="modal">
                                                    <i class="bx bx-x d-block d-sm-none"></i>
                                                    <span class="d-none d-sm-block">Cerrar</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        @if ($brands->hasPages())
                            <div class="d-flex justify-content-left">
                                {{ $brands->links('pagination::bootstrap-5') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>

@if ($errors->any())
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // --- Variables de Categorías ---
        const editCategoryId = '{{ old('edit_id') }}'; // ID de edición
        const isCreatingCategory = '{{ old('create_type') }}' === 'category';

        // --- Variables de Descuentos (Ejemplo) ---
        const editBrandId = '{{ old('edit_brand_id') }}'; 
        const isCreatingBrand = '{{ old('create_type') }}' === 'brand';

        // Lógica de apertura
        if (editCategoryId) {
            abrirModal('editcategory' + editCategoryId);
        } else if (isCreatingCategory) {
            abrirModal('createcategory');
        } else if (editBrandId) {
            abrirModal('editbrand' + editBrandId);
        } else if (isCreatingBrand) {
            abrirModal('createbrand');
        }

        function abrirModal(id) {
            const el = document.getElementById(id);
            if (el && window.bootstrap) {
                new bootstrap.Modal(el).show();
            }
        }
    });
</script>
@endif

<script>
    function previewCategoryPhoto(event) {
        const file = event.target.files[0];
        const preview = document.getElementById('categoryPhotoPreview');
        const placeholder = document.getElementById('categoryPhotoPreviewPlaceholder');

        if (!preview || !placeholder) {
            return;
        }

        if (!file) {
            preview.classList.add('d-none');
            placeholder.classList.remove('d-none');
            preview.src = '#';
            return;
        }

        const reader = new FileReader();
        reader.onload = function (e) {
            preview.src = e.target.result;
            preview.classList.remove('d-none');
            placeholder.classList.add('d-none');
        };
        reader.readAsDataURL(file);
    }

    function previewCategoryImage(event, categoryId) {
        const file = event.target.files[0];
        const preview = document.getElementById('productImagePreview' + categoryId);
        const placeholder = document.getElementById('productImagePlaceholder' + categoryId);

        if (!preview || !placeholder) {
            return;
        }

        if (!file) {
            const currentSrc = preview.dataset.currentSrc || '';
            if (currentSrc) {
                preview.src = currentSrc;
                preview.classList.remove('d-none');
                placeholder.classList.add('d-none');
            } else {
                preview.classList.add('d-none');
                placeholder.classList.remove('d-none');
            }
            return;
        }

        const reader = new FileReader();
        reader.onload = function (e) {
            preview.src = e.target.result;
            preview.classList.remove('d-none');
            placeholder.classList.add('d-none');
        };
        reader.readAsDataURL(file);
    }
///
function previewBrandPhoto(event) {
        const file = event.target.files[0];
        const preview = document.getElementById('brandPhotoPreview');
        const placeholder = document.getElementById('brandPhotoPreviewPlaceholder');

        if (!preview || !placeholder) {
            return;
        }

        if (!file) {
            preview.classList.add('d-none');
            placeholder.classList.remove('d-none');
            preview.src = '#';
            return;
        }

        const reader = new FileReader();
        reader.onload = function (e) {
            preview.src = e.target.result;
            preview.classList.remove('d-none');
            placeholder.classList.add('d-none');
        };
        reader.readAsDataURL(file);
    }

    function previewBrandImage(event, brandId) {
        const file = event.target.files[0];
        const preview = document.getElementById('brandImagePreview' + brandId);
        const placeholder = document.getElementById('brandImagePlaceholder' + brandId);

        if (!preview || !placeholder) {
            return;
        }

        if (!file) {
            const currentSrc = preview.dataset.currentSrc || '';
            if (currentSrc) {
                preview.src = currentSrc;
                preview.classList.remove('d-none');
                placeholder.classList.add('d-none');
            } else {
                preview.classList.add('d-none');
                placeholder.classList.remove('d-none');
            }
            return;
        }

        const reader = new FileReader();
        reader.onload = function (e) {
            preview.src = e.target.result;
            preview.classList.remove('d-none');
            placeholder.classList.add('d-none');
        };
        reader.readAsDataURL(file);
    }

    

    function confirmDelete(formId, itemName) {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: "btn btn-success ms-2", // Añadí margen para que no se peguen
                cancelButton: "btn btn-danger"
            },
            buttonsStyling: false
        });

        swalWithBootstrapButtons.fire({
            title: "¿Estás seguro?",
            text: "Vas a eliminar " + itemName + ". ¡No podrás revertir esto!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Sí, eliminar!",
            cancelButtonText: "No, cancelar",
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // Envía el formulario que recibió por parámetro
                document.getElementById(formId).submit();
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                swalWithBootstrapButtons.fire({
                    title: "Cancelado",
                    text: "El registro está a salvo :)",
                    icon: "error"
                });
            }
        });
    }
</script>

@endsection