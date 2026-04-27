@extends('layouts.admin')
@section('title')
    <h3>Datos Institucionales</h3>
    <p class="text-subtitle text-muted">En este apartado podra ver y/o actualizar los datos de su institución.</p>
@endsection
@section('navegacion')
    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Configuración</a></li>
            <li class="breadcrumb-item active" aria-current="page">Datos Institucionales</li>
        </ol>
    </nav>
@endsection
@section('content')
<div class="row" style="d-flex; justify-content: center;">
    <div class="card col-lg-12 col-md-12">
        <div class="card-content">
            <div class="card-body">
                <h4 class="card-title">Datos Institucionales</h4>
                <!-- Button trigger for primary themes modal -->
                <button style="float: right;" type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalmarca">
                    <i class="bi bi-pen"></i> Actualizar datos de la empresa
                </button>
                <!--primary theme Modal -->
                <div class="modal fade text-left" id="modalmarca" tabindex="-1" aria-labelledby="myModalLabel160" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-primary">
                                <h5 class="modal-title white" id="myModalLabel160">Datos Institucionales
                                </h5>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                </button>
                            </div>
                            <div class="modal-body">
                                
                            </div>  
                        </div>
                    </div>
                </div> 
                <button style="float: right;" type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#modalpersonal">
                    <i class="bi bi-pen"></i> Actualizar datos personales
                </button>
                <!--primary theme Modal -->
                <div class="modal fade text-left" id="modalpersonal" tabindex="-1" aria-labelledby="myModalLabel160" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-success">
                                <h5 class="modal-title white" id="myModalLabel160">Datos Personales
                                </h5>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                </button>
                            </div>
                            <div class="modal-body">
                                
                            </div>  
                        </div>
                    </div>
                </div> 
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-7 col-md-12">
                        <form >
                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <div class="row">
                                        <div class="col-md-7">
                                            <label for="oem" class="form-label">Nombre de la empresa</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="bi bi-building-fill"></i></span>
                                                <input name="name" type="text" class="form-control" value="{{$datos->name}}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <label for="oem" class="form-label">Telefono</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                                                <input name="phone" type="text" class="form-control" value="{{$datos->phone_whatsapp}}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <label for="oem" class="form-label">NIT</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="bi bi-file-ruled"></i></span>
                                                <input name="phone" type="text" class="form-control" value="{{$datos->nit}}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <label for="oem" class="form-label">Ciudad</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="bi bi-globe-americas"></i></span>
                                                <input name="phone" type="text" class="form-control" value="{{$datos->city}}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="oem" class="form-label">Correo corporativo</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="bi bi-chat-square-dots"></i></span>
                                                <input name="phone" type="text" class="form-control" value="{{$datos->email}}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-12">
                                            <label for="Especificaciones" class="form-label">Dirección de la empresa</label>
                                            <div class="form-group with-title mb-3">
                                                <textarea class="form-control" rows="3" name="cat_description" readonly>{{$datos->address}}</textarea>
                                                <label>Dirección</label>      
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-5 col-md-12">
                        <form >
                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="oem" class="form-label">Nombre</label>
                                            <div class="input-group">
                                                <span class="input-group-text "><i class="bi bi-person"></i></span>
                                                <input type="text" class="form-control" value="{{$perfil->name}}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="oem" class="form-label">Correo</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="bi bi-chat-square-dots"></i></span>
                                                <input name="phone" type="text" class="form-control" value="{{$perfil->email}}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>
@endsection