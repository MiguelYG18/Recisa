@extends('layouts.app')
@section('title','Crear Rol')
    @push('css')
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">  
    @endpush

    @section('content')      
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header py-3">
                        <p class="text-primary m-0 fw-bold">Formulario del Rol</p>
                    </div>
                    <div class="card-body">
                        <div class="col-md-12">
                            @if ($errors->any())
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
                        <form action="" method="post">
                            {{csrf_field()}}
                            <div class="row g-3 justify-content-center">
                                <div class="col-md-4">
                                    <label for="group_level" class="form-label">Nivel de Usuario:</label>
                                    <select title="Seleccione el nivel de usuario..." name="group_level" id="group_level" data-style="btn-secondary" data-size="3" class="form-control selectpicker show-tick">
                                        <option value="1" {{old('group_level') == '1' ? 'selected' : ''}}>Admin</option>
                                        <option value="2" {{old('group_level') == '2' ? 'selected' : ''}}>Secretaria</option> 
                                        <option value="3" {{old('group_level') == '3' ? 'selected' : ''}}>Doctor</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="group_status" class="form-label">Estado:</label>
                                    <select title="Seleccione el estado..." name="group_status" id="group_status" data-style="btn-secondary" data-size="2" class="form-control selectpicker show-tick">
                                        <option value="0" {{old('group_status') == '0' ? 'selected' : ''}}>Desactivado</option>
                                        <option value="1" {{old('group_status') == '1' ? 'selected' : ''}}>Activado</option> 
                                    </select>
                                </div>
                                <div class="col-md-4" style="display: none;">
                                    <label for="slug" class="form-label">Enlace:</label>
                                    <input readonly type="text" id="slug" name="slug" class="form-control">
                                </div>
                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-primary" style="background: #00486E;border-style: none;">Guardar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div> 
    @endsection

    @push('js')
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
        <script>
            $(document).ready(function () {
                // Cuando cambia el valor del campo select
                $('#group_level').on('change', function () {
                    var selectedValue = $(this).val(); // Obtén el valor seleccionado
                    var slugValue = ''; // Valor para el campo de texto
                    // Asigna un valor al campo de texto según la selección
                    if (selectedValue == '1') {
                        slugValue = 'admin';
                    } else if (selectedValue == '2') {
                        slugValue = 'secretaria';
                    } else if (selectedValue == '3') {
                        slugValue = 'doctor';
                    }
                    // Establece el valor del campo de texto
                    $('#slug').val(slugValue);
                });
            });
            </script>
    @endpush