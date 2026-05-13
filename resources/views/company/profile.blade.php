@extends('layouts.admin')
@section('title')
    <h3>Datos del propietario</h3>
    <p class="text-subtitle text-muted">En este apartado usted puede ver y/o aculizar sus datos</p>
@endsection
@section('navegacion')
    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
            <li class="breadcrumb-item active" aria-current="page">Perfil</li>
        </ol>
    </nav>
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title mb-0">Estos son tus datos</h4>
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
                                        Actualiza tus datos
                                    </h5>
                                    <!--Boton para cerrar el modal-->
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('profile.edit', ['id' => auth()->user()->id]) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="row gx-4 gy-3">
                                            <div class="mb-3">
                                                <label for="ci" class="form-label">Cédula <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="bi bi-credit-card-2-front"></i></span>
                                                    <input type="text" id="ci" name="ci" class="form-control @error('ci') is-invalid @enderror" value="{{ old('ci', auth()->user()->ci) }}" required>
                                                    @error('ci')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Nombre <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                                                    <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', auth()->user()->name) }}" required>
                                                    @error('name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Correo electrónico <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
                                                    <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', auth()->user()->email) }}" required>
                                                    @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="card border rounded p-3 h-100">
                                                <div class="d-flex align-items-center justify-content-between mb-3">
                                                    <div>
                                                        <h5 class="mb-1">Foto de perfil</h5>
                                                        <p class="text-muted mb-0">Sube una imagen y verifica la vista previa antes de guardar.</p>
                                                    </div>
                                                    <span class="badge bg-primary">Vista previa</span>
                                                </div>
                                                <div class="text-center mb-3">
                                                    <div id="photoPreviewPlaceholder" class="d-flex align-items-center justify-content-center rounded bg-light" style="height: 240px;">
                                                        <i class="bi bi-person-circle fs-1 text-secondary"></i>
                                                    </div>
                                                    <img id="photoPreview" src="#" alt="Foto de perfil" class="img-fluid rounded mx-auto d-block {{ auth()->user()->photo ? '' : 'd-none' }}" style="max-height: 240px;">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="photo" class="form-label">Seleccionar imagen</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text"><i class="bi bi-image"></i></span>
                                                        <input type="file" id="photo" name="photo" class="form-control @error('photo') is-invalid @enderror" accept="image/*" onchange="previewProfilePhoto(event)">
                                                        @error('photo')
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
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="ci" class="form-label">Cédula</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-credit-card-2-front"></i></span>
                                        <input type="text" class="form-control" value="{{ old('ci', auth()->user()->ci) }}" readonly>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="name" class="form-label">Nombre</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                                        <input type="text" class="form-control" value="{{ old('name', auth()->user()->name) }}" readonly>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">Correo electrónico </label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', auth()->user()->email) }}" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="card border rounded p-3 h-100">
                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                        <div>
                                            <h5 class="mb-1">Foto de perfil</h5>
                                            <p class="text-muted mb-0">Vista previa de foto de perfil.</p>
                                        </div>
                                        <span class="badge bg-primary">Vista previa</span>
                                    </div>

                                    <div class="text-center mb-3">
                                        <img id="photoPreview" src="{{ auth()->user()->photo ? asset('storage/' . auth()->user()->photo) : '' }}" alt="Foto de perfil" class="img-fluid rounded mx-auto d-block {{ auth()->user()->photo ? '' : 'd-none' }}" style="max-height: 240px;">
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