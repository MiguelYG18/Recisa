@extends('layouts.app')
@section('title', 'Subir Historial Clíncio')
@push('css')
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
    <!--Alertas-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!--Subida de Arcivos-->
    <script src="https://kit.fontawesome.com/0ffeb346a7.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap"rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/css/style_history_patient.css') }}" />
    <!--Subida de Arcivos-->
@endpush

@section('content')
    <div class="row" style="justify-content: center;">
        <div class="col-md-4" style="margin-top: 4.5em;">
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
                    <form action="" method="post" id="form_assignment">
                        {{ csrf_field() }}
                        <div class="row g-3" style="justify-content:center">
                            <div class="col-md-12" style="height: 50px !important">
                                <div class="mb-5">
                                    <div class="input-group mb-3">
                                        <label class="input-group-text" for="quantity_voucher">DNI</label>
                                        <input type="text" class="form-control"
                                            style="border-radius:0px 0px 0px 0px !important; height:38px" maxlength="8"
                                            id="max_voucher" name="max_voucher" aria-describedby="basic-addon3 basic-addon4"
                                            value="{{ old('max_voucher') }}">
                                        <button id="" class="btn btn-primary" onclick="mostrarPasswordConfirm()"
                                            type="button" style="background-color: #00476D !important;height:38px">
                                            <span class="fa fa-search"></span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12" style="height: 50px !important">
                                <div class="input-group mb-3">
                                    <label class="input-group-text" for="quantity_voucher">Nombres</label>
                                    <input type="text" class="form-control"
                                        style="border-radius:0px 10px 10px 0px !important; height:38px" maxlength="5"
                                        id="max_voucher" readonly name="max_voucher"
                                        aria-describedby="basic-addon3 basic-addon4" value="{{ old('max_voucher') }}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon3">Especialidad</span>
                                    <select title="...." data-style="btn-info" data-size="3"
                                    class="form-control selectpicker show-tick" id="id_specialization"
                                    name="id_specialization">
                                    <option value="">Odoptología</option>
                                </select>
                                </div>
                            </div>
                            <div class="col-12 text-center" class="col-md-7" style="margin-top: 30px !important">
                                <button type="submit" class="btn btn-primary"
                                    style="background-color: #00476D !important;">Guardar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8" style="margin-top: 20px; width:55% !important">
            <div class="container_files">
                <input type="file" id="file-input" multiple />
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
    </div>
@endsection

@push('js')
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
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
    <script src="{{ asset('assets/js/history_patient.js') }}"></script>
@endpush
