@extends('layouts.app')
@section('title', 'Subir Historial Clíncio')
@push('css')
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
    <!--Anderson DOC-->
    <link rel="stylesheet" href="{{ asset('assets/css/style_history_patient.css') }}" />
    <script src="https://kit.fontawesome.com/0ffeb346a7.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet" />
    <!--Alertas-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
    @elseif(session('error'))
        <script>
            let message = "{{ session('error') }}";
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
                icon: "error",
                title: message
            });
        </script>
    @endif
    <div class="row" style="justify-content: center;">
        <div class="col-md-5" style="margin-top: 4.5em;">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="text-primary fw-bold m-0">Buscar Paciente</h6>
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
                    <div class="row g-3" style="justify-content:center">
                        <div class="col-md-12" style="height: 50px !important">
                            <div class="mb-5">
                                <div class="input-group mb-3">
                                    <label class="input-group-text" for="quantity_voucher">DNI</label>
                                    <input type="text" class="form-control"
                                        style="border-radius:0px 0px 0px 0px !important; height:38px" maxlength="8"
                                        minlength="8" id="dni" name="dni"
                                        aria-describedby="basic-addon3 basic-addon4">
                                    <button id="searchButton" class="btn btn-primary" type="button"
                                        style="background-color: #00476D !important;height:38px">
                                        <span class="fa fa-search"></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form action="" method="post" id="form_assignment" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-3 mt-1" style="justify-content:center">
                            <div class="col-md-12">
                                <div class="input-group mb-3">
                                    <label class="input-group-text" for="quantity_voucher">Paciente</label>
                                    <input type="text" class="form-control"
                                        style="border-radius:0px 10px 10px 0px !important; height:38px" id="full_name"
                                        readonly name="full_name" aria-describedby="basic-addon3 basic-addon4"
                                        value="{{ old('full_name') }}">
                                    <input type="hidden" name="id_patient" id="id_patient" value="{{ old('id_patient') }}">
                                    <input type="hidden" id="datetime_created" name="datetime_created"
                                        value="{{ old('datetime_created') }}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="input-group">
                                    <label class="input-group-text" for="quantity_voucher">Número Historial</label>
                                    <input type="text" class="form-control"
                                        style="border-radius:0px 10px 10px 0px !important; height:38px" maxlength="10"
                                        minlength="10" id="history_number" name="history_number"
                                        aria-describedby="basic-addon3 basic-addon4" value="{{ old('history_number') }}">
                                </div>
                            </div>
                            <div class="col-12 text-center" class="col-md-7" style="margin-top: 30px !important">
                                <button type="submit" class="btn btn-primary"
                                    style="background-color: #00476D !important;">
                                    Guardar
                                </button>
                            </div>
                        </div>
                </div>
            </div>
        </div>
        <div class="col-md-7" style="margin-top: 20px; width:55% !important">
            <div class="container_files">
                <input type="file" id="file-input" name="files[]" accept=".pdf" multiple />
                <label for="file-input" class="label">
                    <i class="fa-solid fa-arrow-up-from-bracket"></i>
                    &nbsp; Seleccione archivos a subir
                </label>
                <div id="num-of-files">No selecciono ningún archivo</div>
                <ul id="files-list"></ul>
            </div>
            <div id="popup"
                style="display: none; position: fixed; width: 100%; height: 100%; top: 0; left: 0; background: rgba(0, 0, 0, 0.7); align-items: center; justify-content: center;">
                <div style="background: white; padding: 20px;">
                    <button id="close-popup" style="float: right;">Cerrar</button>
                    <img id="file-preview" src="" style="max-width: 100%;" />
                </div>
            </div>
        </div>
        </form>
    </div>
@endsection

@push('js')
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
    <script src="{{ asset('assets/js/history_patient.js') }}"></script>
    <script>
        const fileInput = document.getElementById('file-input');
        const filePreview = document.getElementById('file-preview');
        const popup = document.getElementById('popup');
        const closePopup = document.getElementById('close-popup');

        fileInput.addEventListener('change', function() {
            const file = this.files[0];

            if (file) {
                const reader = new FileReader();

                reader.addEventListener('load', function() {
                    filePreview.src = this.result;
                    popup.style.display = 'flex';
                });

                reader.readAsDataURL(file);
            }
        });

        closePopup.addEventListener('click', function() {
            popup.style.display = 'none';
        });
    </script>
    <script>
        function buscarPaciente() {
            var dni = $('#dni').val().trim();
            $.ajax({
                url: '{{ url('/recisa/clinicalhistories/sheare-patient') }}', // Ruta para la consulta del DNI
                type: 'POST',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'dni': dni
                },
                success: function(patient) {
                    if (patient) {
                        var nombreCompleto = patient.names + ' ' + patient.surnames;
                        $('#full_name').val(nombreCompleto);
                        $('#id_patient').val(patient.id);
                        $('#dni').val('');
                    } else {
                        showModal('El paciente no está registrado', 'error');
                        $('#full_name').val('');
                        $('#id_patient').val('');
                        $('#dni').val('');
                    }
                },
                error: function(xhr, status, error) {
                    // En caso de error en la solicitud AJAX
                    showModal('Error el paciente no esta registrado', 'error');
                },
                complete: function() {
                    // Validar longitud del DNI
                    if (dni.length !== 8) {
                        showModal('El DNI debe tener 8 dígitos');
                    }
                    // Validar si el campo está vacío
                    else if (!dni.trim()) {
                        showModal('Por favor, ingrese el DNI');
                    }
                }
            });
        }
        // Asociar evento click al botón de búsqueda
        $('#searchButton').click(buscarPaciente);
        // Asociar evento de teclado al campo de DNI
        $('#dni').keypress(function(event) {
            // Verificar si la tecla presionada es Enter (código 13)
            if (event.which == 13) {
                buscarPaciente(); // Llamar a la función de búsqueda
            }
        });
        // Función para mostrar modal con SweetAlert
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
        // Permitir solo números en los campos de DNI y number_history
        $('#dni,#history_number').on('input', function() {
            this.value = this.value.replace(/\D/g, '');
        });
    </script>
    <script>
        function updateTime() {
            var now = new Date();
            var formattedTime = now.getFullYear() + '-' + (now.getMonth() + 1).toString().padStart(2, '0') + '-' + now
                .getDate().toString().padStart(2, '0') + ' ' + now.getHours().toString().padStart(2, '0') + ':' + now
                .getMinutes().toString().padStart(2, '0') + ':' + now.getSeconds().toString().padStart(2, '0');
            document.getElementById('datetime_created').value = formattedTime;
        }
        setInterval(updateTime, 1000);
        updateTime();
    </script>
    
@endpush
