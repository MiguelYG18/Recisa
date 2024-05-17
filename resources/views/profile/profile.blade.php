@extends('layouts.app')
@section('title', 'Perfil')
@push('css')
    <!--Alertas-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!--Anderson-->
    <style>
        /* Estilo para cuando el botón de radio no está seleccionado */
        .btn-check:not(:checked)+.btn-outline-primary {
            box-shadow: none;
        }

        /* Estilo para cuando el botón de radio está seleccionado */
        .btn-check:checked+.btn-outline-primary {
            box-shadow: 0 0 0 3.5px rgba(19, 85, 120, 0.5);
        }
    </style>
    <!--Anderson-->
@endpush
@section('content')
    @if (session('success'))
        <script>
            let message = "{{ session('success') }}";
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
        <h3 class="text-dark mb-4">Perfil - {{ $user->names }}</h3>
        <div class="row mb-3">
            <div class="col-lg-4">
                <div class="col-md-12">
                    @if ($errors->has('image'))
                        @foreach ($errors->all() as $image)
                            <div class="alert alert-danger alert-dismissible fade show" role="alert" id="auto-close-alert-image">
                                <i class="fa-solid fa-circle-exclamation"></i> {{$image}}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            <script>
                                // Después de 2 segundos (2000 ms), cierra la alerta automáticamente
                                setTimeout(function() {
                                    var alert = document.getElementById("auto-close-alert-image");
                                    if (alert) {
                                        var alertInstance = new bootstrap.Alert(alert);
                                        alertInstance.close();
                                    }
                                }, 2500); // 2000 milisegundos = 2 segundos
                            </script>
                        @endforeach
                    @endif 
                </div>
                <div class="card mb-3">
                    <form action="{{url($photo_url)}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="card-body text-center shadow">
                            <div class="d-flex align-items-center justify-content-center position-relative">
                                <div class="text-center">
                                    @if ($user->image == null)
                                        <img class="rounded-circle mb-3 mt-4" src="https://i.postimg.cc/hjSBbZX4/doctor.png"
                                            width="160" height="160">
                                    @else
                                        <img id="avatar-img" src="{{Storage::url('public/perfiles/'.$user->image)}}"
                                            name="image" alt="{{ $user->name }}" class="rounded-circle p-1 bg-primary"
                                            width="160"
                                            style="max-width: 160px; height: 160px; border-radius: 50%; object-fit: contain;">
                                    @endif
                                    <input type="file" id="avatar-input" name="image" accept="image/*"
                                        style="display: none;">
                                    <label for="avatar-input" class="boton-avatar position-absolute rounded-circle bg-primary"
                                        style="width: 40px; height: 40px; bottom: -10px; left: 60%; transform: translateX(-50%); border: 2px solid white;">
                                        <i class="far fa-image text-white" style="line-height: 40px;"></i>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12 text-center mt-3">
                                <button class="btn btn-primary btn-sm" type="submit"
                                    style="background-color: #00476D !important;">
                                    Cambiar Fotografìa
                                </button>
                            </div>
                        </div>
                    </form>
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
                                <p class="text-primary m-0 fw-bold"
                                    style="border-color: #00486E;--bs-primary: #00486E;--bs-primary-rgb: 0,72,110;">
                                    Información Personal
                                </p>
                            </div>
                            <div class="card-body">
                                <div class="col-md-12">
                                    @if ($errors->hasAny(['dni','phone', 'email']))
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert" id="auto-close-alert">
                                            <i class="fa-solid fa-circle-exclamation"></i>
                                            {{ implode(' ', $errors->all()) }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                        <script>
                                            // Después de 2 segundos (2000 ms), cierra la alerta automáticamente
                                            setTimeout(function() {
                                                var alert = document.getElementById("auto-close-alert");
                                                if (alert) {
                                                    var alertInstance = new bootstrap.Alert(alert);
                                                    alertInstance.close();
                                                }
                                            }, 3500); // 2000 milisegundos = 2 segundos
                                        </script>
                                    @endif
                                </div>
                                <form action="{{$profile_url}}" method="post">
                                    {{csrf_field()}}
                                    <div class="row">
                                        <div class="col-lg-6 col-xl-3" style="width: 250px;">
                                            <div class="mb-3">
                                                <label class="form-label" for="username">
                                                    <strong>DNI</strong>
                                                    <br>
                                                </label>
                                                <div style="display: flex;align-items: center;">
                                                    <input class="form-control" type="text" id="dni"
                                                        style="width: 180px;/*float: left;*/text-align: center;"
                                                        name="dni" readonly value="{{ old('dni', $user->dni) }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col" style="width: 230px;">
                                            <div class="mb-3">
                                                <label class="form-label" for="surnames">
                                                    <strong>Apellidos</strong>
                                                </label>
                                                <input class="form-control" type="text" id="surnames" name="surnames"
                                                    readonly value="{{ old('surnames', $user->surnames) }}">
                                            </div>
                                        </div>
                                        <div class="col" style="width: 250px;">
                                            <div class="mb-3">
                                                <label class="form-label" for="names">
                                                    <strong>Nombres</strong>
                                                </label>
                                                <input class="form-control" type="text" id="names" name="names"
                                                    readonly value="{{ old('names', $user->names) }}">
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
                                                <input class="form-control" type="text" id="email" name="email"
                                                    value="{{ old('email', $user->email) }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-xl-3" style="width: 250px;">
                                            <div class="mb-3">
                                                <label class="form-label" for="last_name">
                                                    <strong>Teléfono</strong>
                                                    <br>
                                                </label>
                                                <input class="form-control" maxlength="9" type="text" id="phone"
                                                    name="phone" value="{{ old('phone', $user->phone) }}">
                                            </div>
                                        </div>
                                        <div class="mb-3" style="margin-top: 20px;">
                                            <button class="btn btn-primary btn-sm" type="submit"
                                                style="--bs-primary: #00476D !important;--bs-primary-rgb: 0,72,110;background: #135578 !important;border-style: none;">
                                                Guardar Cambios
                                            </button>
                                        </div>    
                                    </div>
                                </form>
                            </div>
                        </div>
                        @if ($user->user_level == 1)
                            <div class="card shadow">
                                <div class="card-header py-3">
                                    <p class="text-primary m-0 fw-bold"
                                        style="--bs-primary: #00486E;--bs-primary-rgb: 0,72,110;">
                                        Estado de Personal
                                    </p>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3"></div>
                                    <div class="row">
                                        <div class="col-xl-7" style="width: 200px;">
                                            <div class="mb-3">
                                                <label class="form-label" for="city">
                                                    <strong>Grupo</strong>
                                                </label>
                                            </div>
                                            <div class="dropdown show" style="margin-top: -20px;">
                                                <button class="btn btn-primary dropdown-toggle" type="button"
                                                    id="dropdownButton"
                                                    style="background: #00476D !important; width: 170px; border-style: none;">
                                                    Administrador
                                                </button>
                                                <div class="dropdown-menu" data-bs-popper="none" style="width: 170px;">
                                                    <a class="dropdown-item" href="#">Médico</a>
                                                    <a class="dropdown-item" href="#">Secretaria</a>
                                                    <a class="dropdown-item" href="#">Administrador</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="mb-3">
                                                <label class="form-label" for="country">
                                                    <strong>Estado</strong>
                                                </label>
                                                <div>
                                                    <div class="btn-group" role="group"
                                                        aria-label="Basic radio toggle button group"
                                                        style="--bs-primary: #00486E;--bs-primary-rgb: 0,72,110;">
                                                        <input type="radio" id="btnradio1" class="btn-check"
                                                            name="btnradio" autocomplete="on"
                                                            @if ($user->status == 1) checked @endif
                                                            @if ($user->status == 0) disabled @endif>
                                                        <label class="form-label btn btn-outline-primary" for="btnradio1"
                                                            style="background: rgb(80,173,57); border-color: #00486E;color: white;">
                                                            Activo
                                                        </label>
                                                        <input type="radio" id="btnradio2" class="btn-check"
                                                            name="btnradio" autocomplete="off"
                                                            @if ($user->status == 0) checked @endif disabled>
                                                        <label class="form-label btn btn-outline-primary" for="btnradio2"
                                                            style="background: #d9a238; border-color: #00486E; color: white;">
                                                            Inactivo
                                                        </label>
                                                        <input type="radio" id="btnradio3" class="btn-check"
                                                            name="btnradio" autocomplete="off" disabled>
                                                        <label class="form-label btn btn-outline-primary" for="btnradio3"
                                                            style="background: #d23838; border-color: #00486E; color: white;">
                                                            Baja
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="card shadow mb-5"></div>
    </div>
@endsection
@push('js')
    <script src="{{ asset('assets/js/digitos_numericos.js') }}"></script>
    <script src="{{ asset('assets/js/manejo_carga_imagen.js') }}"></script>
    <script src="{{ asset('assets/js/profile_manejo.js') }}"></script>
    <script>
        $(document).ready(function() {
            var userLevel = {{ $user->user_level }}; // Nivel del usuario desde PHP/Laravel
            var dropdownButton = $('#dropdownButton'); // El botón del dropdown

            switch (userLevel) {
                case 1:
                    dropdownButton.text("Administrador");
                    break;
                case 2:
                    dropdownButton.text("Secretaria");
                    break;
                case 3:
                    dropdownButton.text("Médico");
                    break;
                default:
                    dropdownButton.text("Seleccione");
                    break;
            }
        });
    </script>
    <script>
        // Prevenir el despliegue del dropdown
        $(document).ready(function() {
            $('#dropdownButton').on('click', function(event) {
                event.preventDefault(); // Prevenir el comportamiento predeterminado
                // Puedes añadir acciones adicionales aquí, si es necesario
            });
        });
    </script>
@endpush
