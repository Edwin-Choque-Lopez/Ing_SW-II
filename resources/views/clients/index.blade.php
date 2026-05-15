@extends('layouts.admin')
@section('title')
    <h3>Clientes registrados en el Sistema</h3>
    <p class="text-subtitle text-muted">En este apartado puede gestionar las registros  de los clientes registrados en el sistema</p>
@endsection
@section('navegacion')
    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
            <li class="breadcrumb-item active" aria-current="page">Clientes</li>
        </ol>
    </nav>
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title mb-0">CLIENTES</h4>
                <!-- Botón para abrir el modal de creación de producto -->
                <div class="modal-primary me-1 mb-1 d-inline-block">
                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#createclient">
                         <i class="bi bi-plus-square-fill"></i> CREAR
                    </button>
                    <!-- Modal de creación de producto -->
                    <div class="modal fade text-left" id="createclient" tabindex="-1" aria-labelledby="myModalLabel160" style="display: none;" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                            <div class="modal-content">
                                <div class="modal-header bg-primary">
                                    <h5 class="modal-title white" id="myModalLabel160">
                                        Registrar nuevo cliente
                                    </h5>
                                    <!--Boton para cerrar el modal-->
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>Los campos marcados con * son obligatorios</p>
                                     <form action="{{ route('client.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="mb-3">
                                                <label class="form-label">Cedula de identidad*</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="bi bi-person-vcard-fill"></i></span>
                                                    <input name="ci" type="text" class="form-control @error('ci') is-invalid @enderror" placeholder="C.I. del cliente"
                                                    value="{{ old('ci') }}" required>
                                                    @error('ci')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Nombre del cliente*</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="bi bi-person"></i></span>
                                                    <input name="full_name" type="text" class="form-control @error('full_name') is-invalid @enderror" placeholder="Nombre del cliente"
                                                    value="{{ old('full_name') }}" required>
                                                    @error('name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Celular*</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                                                    <input name="phone" type="text" class="form-control @error('phone') is-invalid @enderror" placeholder="Numero de celular del cliente"
                                                    value="{{ old('phone') }}" required>
                                                    @error('name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Correo electronico</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                                    <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Correlo electronico"
                                                    value="{{ old('email') }}" >
                                                    @error('name')
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
                    <p>En este apartado puede gestionar las clientes del sistema.</p>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>C.I.</th>
                                    <th>Nombre</th>
                                    <th>N° de Celular</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($clients as $client)
                                    <tr>
                                        <td>{{ $client->ci}}</td>
                                        <td>{{ $client->full_name }}</td>
                                        <td>{{ $client->phone }}</td>
                                        <td class="d-flex justify-content-center gap-2">
                                            <button type="button" class="btn btn-outline-info btn-sm" data-bs-toggle="modal" data-bs-target="#showclient{{ $client->id }}">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                            <button type="button" class="btn btn-outline-success btn-sm" data-bs-toggle="modal" data-bs-target="#editclient{{ $client->id }}">
                                                <i class="bi bi-pen"></i>
                                            </button>
                                            <form id="delete-form-{{ $client->id }}" action="{{ route('client.destroy', $client->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-outline-danger btn-sm" onclick="confirmDelete({{ $client->id }})"><i class="bi bi-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        @foreach($clients as $client)
                            <div class="modal fade text-left" id="editclient{{ $client->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $client->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-success">
                                            <h5 class="modal-title white">
                                                Editar datos del cliente
                                            </h5>
                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Los campos marcados con * son obligatorios</p>
                                            <form action="{{ route('client.update', $client->id) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="edit_id" value="{{ $client->id }}">
                                                <div class="row">
                                                    <div class="mb-3">
                                                        <label class="form-label">Cedula de identidad*</label>
                                                        <div class="input-group">
                                                            <span class="input-group-text"><i class="bi bi-person-vcard-fill"></i></span>
                                                            <input name="ci" type="text" class="form-control @error('ci') is-invalid @enderror" placeholder="C.I. del cliente"
                                                            value="{{ old('name',$client->ci)}}" required>
                                                            @error('ci')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Nombre del cliente*</label>
                                                        <div class="input-group">
                                                            <span class="input-group-text"><i class="bi bi-person"></i></span>
                                                            <input name="full_name" type="text" class="form-control @error('full_name') is-invalid @enderror" placeholder="Nombre del cliente"
                                                            value="{{ old('full_name',$client->full_name) }}" required>
                                                            @error('name')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Celular*</label>
                                                        <div class="input-group">
                                                            <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                                                            <input name="phone" type="text" class="form-control @error('phone') is-invalid @enderror" placeholder="Numero de celular del cliente"
                                                            value="{{ old('phone',$client->phone) }}" required>
                                                            @error('name')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Correo electronico</label>
                                                        <div class="input-group">
                                                            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                                            <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Correlo electronico"
                                                            value="{{ old('email',$client->email) }}" >
                                                            @error('name')
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

                             <div class="modal fade text-left" id="showclient{{ $client->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $client->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-info">
                                            <h5 class="modal-title white" >
                                                Información del cliente
                                            </h5>
                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="mb-3">
                                                    <label class="form-label">Cedula de identidad</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text"><i class="bi bi-person-vcard-fill"></i></span>
                                                        <input name="ci" type="text" class="form-control" placeholder="C.I. del cliente"
                                                        value="{{ old('name',$client->ci)}}" readonly>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Nombre del cliente</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                                                        <input name="full_name" type="text" class="form-control" placeholder="Nombre del cliente"
                                                        value="{{ old('full_name',$client->full_name) }}" readonly>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Celular</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                                                        <input name="phone" type="text" class="form-control" placeholder="Numero de celular del cliente"
                                                        value="{{ old('phone',$client->phone) }}" readonly>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Correo electronico</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                                        <input name="email" type="email" class="form-control" placeholder="Correlo electronico"
                                                        value="{{ old('email',$client->email) }}" readonly>
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

                        @if ($clients->hasPages())
                            <div class="d-flex justify-content-left">
                                {{ $clients->links('pagination::bootstrap-5') }}
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
            var editId = '{{ old('edit_id') }}';

            if (editId) {
                var editModal = document.getElementById('editclient' + editId);
                if (editModal && window.bootstrap && typeof bootstrap.Modal === 'function') {
                    new bootstrap.Modal(editModal).show();
                }
            } else {
                var createClient = document.getElementById('createclient');
                if (createClient && window.bootstrap && typeof bootstrap.Modal === 'function') {
                    new bootstrap.Modal(createClient).show();
                }
            }
        });
    </script>
@endif

<script>
function confirmDelete(productId) {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-success",
            cancelButton: "btn btn-danger"
        },
        buttonsStyling: false
    });
    swalWithBootstrapButtons.fire({
        title: "¿Estás seguro?",
        text: "¡No podrás revertir esto!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Sí, eliminarlo!",
        cancelButtonText: "No, cancelar!",
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-form-' + productId).submit();
            
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            swalWithBootstrapButtons.fire({
                title: "Cancelado",
                text: "Tu cliente está a salvo :)",
                icon: "error"
            });
        }
    });
}
</script>

@endsection