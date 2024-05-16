@extends('layouts.app')
@section('title', 'Crear Paciente')
@push('css')
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
    <!--Alertas-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

@section('content')
    <div class="row" style="justify-content: center;">
        <div class="col-8" style="margin-top: 20px;">
            <div class="card shadow">
                <div class="card-header py-3">
                    <p class="text-primary m-0 fw-bold">Formulario del Paciente</p>
                </div>
                <div class="card-body">
                    <div class="col-md-12">
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert"
                                id="auto-close-alert">
                                <i class="fa-solid fa-circle-exclamation"></i>
                                {{ implode(' ', $errors->all()) }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
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
                            </div>
                        @endif
                    </div>
                    <div class="col-md-12">
                        <label for="documento" class="form-label">CONSULTA DE DNI:</label>

                        <div class="input-group mb-3">
                            <input type="text" maxlength="8" minlength="8" id="documento" class="form-control"
                                placeholder="Ingrese el DNI" aria-label="Ingrese el DNI" aria-describedby="button-addon2"
                                style="border-radius: 10px 0px 0px 10px !important">
                            <button class="btn btn-primary btn-sm" type="button" id="buscar"
                                style="background-color: #00476D !important; border:none  ;color: #ffff ">Buscar</button>
                        </div>
                    </div>
                    <form action="" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row g-3">
                            <div class="col-md-2">
                                <label for="dni" class="form-label">DNI:</label>
                                <input readonly class="form-control" type="text" name="dni" id="dni"
                                    value="{{ old('dni') }}">
                            </div>
                            <div class="col-md-3">
                                <label for="names" class="form-label">Nombres:</label>
                                <input readonly class="form-control" type="text" name="names" id="names"
                                    value="{{ old('names') }}">
                            </div>
                            <div class="col-md-4">
                                <label for="surnames" class="form-label">Apellido:</label>
                                <input readonly class="form-control" type="text" name="surnames" id="surnames"
                                    value="{{ old('surnames') }}">
                            </div>
                            <div class="col-md-3">
                                <label for="phone" class="form-label">Celular:</label>
                                <input class="form-control" maxlength="9" minlength="9" type="text" name="phone"
                                    id="phone" value="{{ old('phone') }}">
                            </div>
                            <div class="col-md-3">
                                <label for="age" class="form-label">Edad:</label>
                                <input class="form-control" type="text" name="age"
                                    id="age" value="{{ old('age') }}">
                            </div>
                            <div class="col-md-12 text-center mt-3">
                                <button class="btn btn-primary btn-sm" type="submit"
                                    style="background-color: #00476D !important;">
                                    Guardar
                                </button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row g-3" style="justify-content:center; text-align: center;">
            <div class="col-md-2">
                <a href="{{ url('admin/admin/addHistoryPatient') }}">
                    <img src="{{ url('public/assets/img/avatars/historia-clinica.png') }}" alt=""
                        style="height: 128px; box-shadow:8px 8px 20px #0000"><br>

                    <span style="color:#00476D;">Historias Clínicas</span>
                </a>
            </div>
            <div class="col-md-2">
                <a href="{{ url('admin/patient/list') }}">
                    <img src="{{ url('public/assets/img/avatars/lista.png') }}" alt=""
                        style="height: 134px; box-shadow:8px 8px 20px #0000; margin-top:-8px"><br>
                    <span style="color:#00476D;">Lista de Pacientes</span>
                </a>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
    <script>
        // Función para realizar la búsqueda
        function buscarDNI() {
            var dni = $('#documento').val();
            // Validar longitud del DNI
            if (dni.length !== 8) {
                showModal('El DNI debe tener 8 dígitos');
            }
            if (!dni.trim()) {
                showModal('Por favor, ingrese el DNI');
            }

            $.ajax({
                url: '{{ url('/admin/patient/add-consulta') }}', // Ruta para la consulta del DNI
                type: 'POST',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'dni': dni
                },
                dataType: 'json',
                success: function(response) {
                    if (response.numeroDocumento == dni) {
                        var nombreCompleto = response.apellidoPaterno + ' ' + response.apellidoMaterno;
                        $('#surnames').val(nombreCompleto);
                        $('#names').val(response.nombres);
                        $('#dni').val(response.numeroDocumento);
                        $('#documento').val('');
                    }
                }
            });
        }

        // Asociar evento click al botón #buscar
        $('#buscar').click(buscarDNI);

        // Asociar evento de teclado al campo #dni
        $('#documento').keypress(function(event) {
            // Verificar si la tecla presionada es Enter (código 13)
            if (event.which == 13) {
                buscarDNI(); // Llamar a la función de búsqueda
            }
        });

        function showModal(message, icon = "error") {
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
                icon: icon,
                title: message
            });
        }
        $('#documento,#phone,#age').on('input', function() {
            this.value = this.value.replace(/\D/g, '');
        });
    </script>
    <script>
        $(document).ready(function() {
            // Mostrar/ocultar contraseña
            $('#show_password').click(function() {
                Password('password');
            });

            // Mostrar/ocultar confirmación de contraseña
            $('#show_password_confirm').click(function() {
                Password_Confirm('password_confirm');
            });

            function Password(inputId) {
                var cambio = $('#' + inputId);
                if (cambio.attr('type') == 'password') {
                    cambio.attr('type', 'text');
                    $('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
                } else {
                    cambio.attr('type', 'password');
                    $('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
                }
            }

            function Password_Confirm(inputId) {
                var cambio = $('#' + inputId);
                if (cambio.attr('type') == 'password') {
                    cambio.attr('type', 'text');
                    $('.icon_confirm').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
                } else {
                    cambio.attr('type', 'password');
                    $('.icon_confirm').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
                }
            }
        });
    </script>
@endpush
