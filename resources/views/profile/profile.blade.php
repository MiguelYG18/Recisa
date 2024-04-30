@extends('layouts.app')
@section('title','Perfil')
    @push('css')
        <!--Alertas-->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>    
    @endpush 
    @section('content')
        @if (session('success'))
            <script>
                let message ="{{session('success')}}";
                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 1500,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                });
                Toast.fire({
                    icon: "success",
                    title: message
                });
            </script>            
        @endif 
        <div class="container-fluid">
            <h3 class="text-dark mb-4">Perfil</h3>
            <div class="row mb-3">
                <div class="col-lg-4">
                    <div class="card mb-3">
                        <div class="card-body text-center shadow">
                            <img class="rounded-circle mb-3 mt-4" src="{{url('public/storage/perfiles/' .$user->image)}}" width="160" height="160">
                            <div class="mb-3">
                                <button class="btn btn-primary btn-sm" type="button" style="background: #00486E;border-style: none;">
                                    Cambiar Fotografìa
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="row mb-3 d-none">
                        <div class="col">
                            <div class="card text-white bg-primary shadow">
                                <div class="card-body">
                                    <div class="row mb-2">
                                        <div class="col">
                                            <p class="m-0">Peformance</p>
                                            <p class="m-0"><strong>65.2%</strong></p>
                                        </div>
                                        <div class="col-auto"><i class="fas fa-rocket fa-2x"></i></div>
                                    </div>
                                    <p class="text-white-50 small m-0">
                                        <i class="fas fa-arrow-up"></i>&nbsp;5% since last month
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card text-white bg-success shadow">
                                <div class="card-body">
                                    <div class="row mb-2">
                                        <div class="col">
                                            <p class="m-0">Peformance</p>
                                            <p class="m-0"><strong>65.2%</strong></p>
                                        </div>
                                        <div class="col-auto"><i class="fas fa-rocket fa-2x"></i></div>
                                    </div>
                                    <p class="text-white-50 small m-0">
                                        <i class="fas fa-arrow-up"></i>
                                        &nbsp;5% since last month
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="card shadow mb-3">
                                <div class="card-header py-3">
                                    <p class="text-primary m-0 fw-bold" style="border-color: #00486E;--bs-primary: #00486E;--bs-primary-rgb: 0,72,110;">
                                        Información Personal
                                    </p>
                                </div>
                                <div class="card-body">
                                    <form>
                                        <div class="row">
                                            <div class="col-lg-6 col-xl-3" style="width: 250px;">
                                                <div class="mb-3">
                                                    <label class="form-label" for="username">
                                                        <strong>DNI</strong>
                                                        <br>
                                                    </label>
                                                    <div style="display: flex;align-items: center;">
                                                        <input class="form-control" type="text" id="dni" style="width: 180px;/*float: left;*/text-align: center;" name="dni" readonly value="{{old('dni',$user->dni)}}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col" style="width: 230px;">
                                                <div class="mb-3">
                                                    <label class="form-label" for="surnames">
                                                        <strong>Apellidos</strong>
                                                    </label>
                                                    <input class="form-control" type="text" id="surnames" name="surnames" readonly value="{{old('surnames',$user->surnames)}}">
                                                </div>
                                            </div>
                                            <div class="col" style="width: 250px;">
                                                <div class="mb-3">
                                                    <label class="form-label" for="names">
                                                        <strong>Nombres</strong>
                                                    </label>
                                                    <input class="form-control" type="text" id="names" name="names" readonly value="{{old('names',$user->names)}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="mb-3">
                                                    <label class="form-label" for="first_name">
                                                        <strong>Correo electrónico</strong>
                                                        <br>
                                                    </label>
                                                    <input class="form-control" type="text" id="email" name="email" value="{{old('email',$user->email)}}">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-xl-3" style="width: 250px;">
                                                <div class="mb-3">
                                                    <label class="form-label" for="last_name">
                                                        <strong>Teléfono</strong>
                                                        <br>
                                                    </label>
                                                    <input class="form-control" maxlength="9" type="text" id="phone" name="phone" value="{{old('phone',$user->phone)}}">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="card shadow">
                                <div class="card-header py-3">
                                    <p class="text-primary m-0 fw-bold" style="--bs-primary: #00486E;--bs-primary-rgb: 0,72,110;">
                                        Estado de Personal
                                    </p>
                                </div>
                                <div class="card-body">
                                    <form>
                                        <div class="mb-3"></div>
                                        <div class="row">
                                            <div class="col-xl-7" style="width: 200px;">
                                                <div class="mb-3">
                                                    <label class="form-label" for="city">
                                                        <strong>Grupo</strong>
                                                    </label>
                                                </div>
                                                <div class="dropdown show" style="margin-top: -20px;">
                                                    <button class="btn btn-primary dropdown-toggle" aria-expanded="true" data-bs-toggle="dropdown" type="button" style="--bs-primary: #00486E;--bs-primary-rgb: 0,72,110;background: #00486E;width: 170px;border-style: none;">Seleccione&nbsp;</button>
                                                    <div class="dropdown-menu show" data-bs-popper="none" style="width: 170px;">
                                                        <a class="dropdown-item" href="#" data-bs-target="Medicos" style="--bs-primary: #00486E;--bs-primary-rgb: 0,72,110;">
                                                            Médico
                                                        </a>
                                                        <a class="dropdown-item" href="#">
                                                            Secretaria
                                                        </a>
                                                        <a class="dropdown-item" href="#">
                                                            Administrador
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="mb-3">
                                                    <label class="form-label" for="country">
                                                        <strong>Estado</strong>
                                                    </label>
                                                    <div>
                                                        <div class="btn-group" role="group" aria-label="Basic radio toggle button group" style="--bs-primary: #00486E;--bs-primary-rgb: 0,72,110;">
                                                            <input type="radio" id="btnradio1" class="btn-check" name="btnradio" autocomplete="off" checked>
                                                            <label class="form-label btn btn-outline-primary" for="btnradio1" style="background: rgb(80,173,57); border-color: #00486E;color: white;">
                                                                Activo
                                                            </label>
                                                            <input type="radio" id="btnradio2" class="btn-check" name="btnradio" autocomplete="off">
                                                            <label class="form-label btn btn-outline-primary" for="btnradio2" style="background: #d9a238; border-color: #00486E; color: white;">
                                                                Inactivo
                                                            </label>
                                                            <input type="radio" id="btnradio3" class="btn-check" name="btnradio" autocomplete="off">
                                                            <label class="form-label btn btn-outline-primary" for="btnradio3" style="background: #d23838; border-color: #00486E; color: white;">
                                                                Baja
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3" style="margin-top: 20px;">
                                            <button class="btn btn-primary btn-sm" type="submit" style="--bs-primary: #00486E;--bs-primary-rgb: 0,72,110;background: #00486E;border-style: none;">
                                                Guardar Cambios
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card shadow mb-5"></div>
        </div>   
    @endsection
    @push('js')
    <script>
        $('#phone').on('input', function () {
            this.value = this.value.replace(/\D/g, '');
        });
    </script>
    @endpush