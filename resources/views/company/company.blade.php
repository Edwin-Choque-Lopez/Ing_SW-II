@extends('layouts.admin')
@section('title')
    <h3>Datos Institucionales</h3>
    <p class="text-subtitle text-muted">En este apartado usted puede ver y/o aculizar los datos de la empresa</p>
@endsection
@section('navegacion')
    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
            <li class="breadcrumb-item active" aria-current="page">Institución</li>
        </ol>
    </nav>
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title mb-0">Estos son los datos de la Empresa</h4>
                <!-- Botón para abrir el modal de creación de producto -->
                <div class="modal-primary me-1 mb-1 d-inline-block">
                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#edituser">
                        <i class="bi bi-pencil-square"></i> Actualizar
                    </button>
                    <!-- Modal de creación de producto -->
                    <div class="modal fade text-left" id="edituser" tabindex="-1" aria-labelledby="myModalLabel160" style="display: none;" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                            <div class="modal-content">
                                <div class="modal-header bg-primary">
                                    <h5 class="modal-title white" id="myModalLabel160">
                                        Actualiza los datos de la empresa
                                    </h5>
                                    <!--Boton para cerrar el modal-->
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('company.edit', $storeProfile->id )}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="row gx-4 gy-3">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Nombre de la empresa<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="bi bi-building"></i></span>
                                                    <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ $storeProfile->name }}" required>
                                                    @error('name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label for="nit" class="form-label">Nit<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="bi bi-card-text"></i></span>
                                                    <input name="nit" type="text" class="form-control @error('nit') is-invalid @enderror" value="{{ $storeProfile->nit }}" required>
                                                    @error('nit')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label for="address" class="form-label">Direccion<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="bi bi-geo-alt"></i></span>
                                                    <input name="address" type="text" class="form-control @error('address') is-invalid @enderror" value="{{ $storeProfile->address }}" required>
                                                    @error('address')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="city" class="form-label">Ciudad</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="bi bi-globe-americas"></i></span>
                                                    <input name="city" type="text" class="form-control @error('city') is-invalid @enderror" value="{{ $storeProfile->city }}" >
                                                    @error('city')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label for="phone_whatsapp" class="form-label">N. de telefono<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                                                    <input name="phone_whatsapp" type="text" class="form-control @error('phone_whatsapp') is-invalid @enderror" value="{{ $storeProfile->phone_whatsapp }}" required>
                                                    @error('phone_whatsapp')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label for="email" class="form-label">Correo electrónico</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
                                                    <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" value="{{ $storeProfile->email}}" >
                                                    @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class=" mb-3">
                                                <label for="footer_text" class="form-label">Descripción</label>
                                                <div class="form-group with-title mb-3">
                                                    <textarea name="footer_text" class="form-control @error('footer_text') is-invalid @enderror" rows="3" >{{$storeProfile->footer_text}}</textarea>
                                                    <label>Redacte una mensaje referente a la empresa</label>
                                                    @error('footer_text')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="card border rounded p-3 h-100">
                                                <div class="d-flex align-items-center justify-content-between mb-3">
                                                    <div>
                                                        <h5 class="mb-1">Logo de la empresa</h5>
                                                        <p class="text-muted mb-0">Sube una imagen y verifica la vista previa antes de guardar.</p>
                                                    </div>
                                                    <span class="badge bg-primary">Vista previa</span>
                                                </div>
                                                <div class="text-center mb-3">
                                                    <div id="photoPreviewPlaceholder" class="d-flex align-items-center justify-content-center rounded bg-light" style="height: 240px;">
                                                        <i class="bi bi-person-circle fs-1 text-secondary"></i>
                                                    </div>
                                                    <img id="photoPreview" src="#" alt="Logo" class="img-fluid rounded mx-auto d-block {{ $storeProfile->logo_path ? '' : 'd-none' }}" style="max-height: 240px;">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="logo_path" class="form-label">Seleccionar imagen</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text"><i class="bi bi-image"></i></span>
                                                        <input type="file" id="photo" name="logo_path" class="form-control @error('logo_path') is-invalid @enderror" accept="image/*" onchange="previewProfilePhoto(event)">
                                                        @error('logo_path')
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
                                                    <span class="d-none d-sm-block">Actualizar</span>
                                                </button>
                                            </div>
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
                        <div class="row gx-4 gy-3">
                            <div class="row col-lg-6">
                                <div class="mb-3">
                                    <label for="ci" class="form-label">Nombre de la empresa</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-building"></i></span>
                                        <input type="text" class="form-control" value="{{ $storeProfile->name }}" readonly>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="name" class="form-label">Nit</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-card-text"></i></span>
                                        <input type="text" class="form-control" value="{{ $storeProfile->nit }}" readonly>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">Direccion</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-geo-alt"></i></span>
                                        <input type="email" class="form-control" value="{{ $storeProfile->address }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="ci" class="form-label">Ciudad</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-globe-americas"></i></span>
                                        <input type="text" class="form-control" value="{{ $storeProfile->city }}" readonly>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">N. de telefono</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                                        <input type="text" class="form-control" value="{{ $storeProfile->phone_whatsapp }}" readonly>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">Correo electrónico </label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
                                        <input type="email" class="form-control" value="{{ $storeProfile->email}}" readonly>
                                    </div>
                                </div>
                                <div class=" mb-3">
                                    <label for="Especificaciones" class="form-label">Descripción</label>
                                    <div class="form-group with-title mb-3">
                                        <textarea class="form-control" rows="3" >{{$storeProfile->footer_text}}</textarea>
                                        <label>Redacte una mensaje referente a la empresa</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="card border rounded p-3 h-100">
                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                        <div>
                                            <h5 class="mb-1">Logo de la Empresa</h5>
                                            <p class="text-muted mb-0">Vista previa del logo intitucional.</p>
                                        </div>
                                        <span class="badge bg-primary">Vista previa</span>
                                    </div>

                                    <div class="text-center mb-3">
                                        <img id="photoPreview" src="{{ $storeProfile->logo_path ? asset('storage/' . $storeProfile->logo_path) : '' }}" alt="Foto de perfil" class="img-fluid rounded mx-auto d-block {{ $storeProfile->logo_path ? '' : 'd-none' }}" style="max-height: 240px;">
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>

<script>
    function previewProfilePhoto(event) {
        const file = event.target.files[0];
        const preview = document.getElementById('photoPreview');
        const placeholder = document.getElementById('photoPreviewPlaceholder');

        if (!file) {
            return;
        }

        const reader = new FileReader();
        reader.onload = function (e) {
            preview.src = e.target.result;
            preview.classList.remove('d-none');
            if (placeholder) {
                placeholder.classList.add('d-none');
            }
        };
        reader.readAsDataURL(file);
    }
</script>

@if ($errors->any())
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var Modal = document.getElementById('edituser');
            if (Modal && window.bootstrap && typeof bootstrap.Modal === 'function') {
                new bootstrap.Modal(Modal).show();
            }
        });
    </script>
@endif

@endsection