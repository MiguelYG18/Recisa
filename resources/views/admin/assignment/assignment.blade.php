@extends('layouts.app')
@section('title', 'Asignación')
@push('css')
    <!--Alertas-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
    <!--CSS TABLA-->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.bootstrap5.css">
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
    <div class="d-sm-flex justify-content-between align-items-center mb-4">
        <h3 class="text-dark mb-0">Asignación</h3>
    </div>
    <div class="row">
        <div class="col" style="margin-top: 20px;">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="text-primary fw-bold m-0">Asignar Doctor a Especialidad</h6>
                </div>
                <div class="card-body">
                    <div class="col-md-12">
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert" id="auto-close-alert">
                                <i class="fa-solid fa-circle-exclamation"></i>
                                {{ implode(' ', $errors->all()) }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
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
                        <div class="row g-3">
                            <div class="col-md-7">
                                <div class="mb-3">
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon3">Especialidad</span>
                                        <select title="...." data-style="btn-secondary" data-size="3"
                                            class="form-control selectpicker show-tick" id="id_specialization"
                                            name="id_specialization">
                                            @foreach ($specializations as $specialization)
                                                <option value="{{ $specialization->id }}"
                                                    data-voucher="{{ $specialization->quantity_voucher }}"
                                                    {{ old('id_specialization') == $specialization->id ? 'selected' : '' }}>
                                                    {{ $specialization->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="input-group mb-3">
                                    <label class="input-group-text" for="quantity_voucher">Cupos</label>
                                    <input type="text" class="form-control" maxlength="5" id="max_voucher" readonly
                                        name="max_voucher" aria-describedby="basic-addon3 basic-addon4"
                                        value="{{ old('max_voucher') }}">
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon3">Doctor</span>
                                    <select title="...." data-style="btn-secondary" data-size="3"
                                        id="id_doctor" class="form-control selectpicker show-tick"
                                        style="width: 120px;" name="id_doctor">
                                        @foreach ($doctor as $userDoctor)
                                            <option value="{{ $userDoctor->id }}"
                                                {{ old('id_doctor') == $userDoctor->id ? 'selected' : '' }}>
                                                {{ $userDoctor->names }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="input-group">
                                    <label class="input-group-text" for="quantity_voucher">Asignar</label>
                                    <input type="text" class="form-control" maxlength="5" id="basic-url"
                                        name="vaucher_specialization"
                                        aria-describedby="basic-addon3 basic-addon4"
                                        onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                                        value="{{ old('vaucher_specialization') }}">
                                </div>
                            </div>
                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-primary" style="background-color: #00476D !important;">Guardar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col" style="margin-top: 20px;">
            <div class="card shadow">
                <div class="card-header py-3">
                    <p class="text-primary m-0 fw-bold">Lista de Especialidades</p>
                </div>
                <div class="card-body">
                    <div class="table-responsive table mt-2" id="dataTable-1" role="grid"
                        aria-describedby="dataTable_info">
                        <table class="table my-0" id="asignacion">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nombre Doctor</th>
                                    <th>Especialidad</th>
                                    <th>Cupos</th>
                                    <th>Creado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $count = 0; // Inicializamos el contador
                                @endphp
                                @foreach ($userSpecializations as $index => $value)
                                        <tr data-id="{{ $index + 1 }}">
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $value->user->names }} {{ $value->user->surnames }}</td>
                                            <td>
                                                {{ $value->specialization->name }}
                                            </td>
                                            <td>
                                                {{ $value->cupo_doctor}}
                                            </td>
                                            <td>{{ date('d-m-Y', strtotime($value->created_at)) }}</td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <button type="button" class="btn btn-danger" style="background: #EB5C5E;" data-bs-toggle="modal" data-bs-target="#delete-{{ $value->id }}">
                                                        <i class="far fa-trash-alt"></i>
                                                    </button>
                                                    <!-- Modal Delete-->
                                                    <div class="modal fade" id="delete-{{ $value->id }}"
                                                        data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">
                                                                        Desea Eliminar el doctor asigando con su especialidad</h1>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    La especialización {{$value->specialization->name}} será eliminado con el doctor {{ $value->user->names }}.
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Cancelar</button>
                                                                    <a href="{{ url('admin/assignment/delete/' . $value->id) }}"
                                                                        class="btn btn-danger"style="background: #EB5C5E;">
                                                                        Eliminar
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
    <script>
        $('#asignacion').DataTable({
            responsive: true,
            autoWidth: false,
            "language": {
                "lengthMenu": "Mostrar " +
                    `<select class="custom-select custom-select-sm w-50 form-select form-select-sm mb-2">
                                        <option value="5">5</option>
                                        <option value="10">10</option>
                                        <option value="15">15</option>
                                        <option value="20">20</option>
                                    </select>`,
                "zeroRecords": "No se encontró nada - lo siento",
                "info": "Mostrando la página _PAGE_ de _PAGES_ de _TOTAL_ usuarios",
                "infoEmpty": "No hay registros disponibles",
                "infoFiltered": "(filtrado de _MAX_ registros totales)",
                "search": "Buscar:",
                "paginate": {
                    "next": ">",
                    "previous": "<"
                }
            }
        });
    </script>
    <script>
        const selectElement = document.getElementById('id_specialization');
        const max_voucher = document.getElementById('max_voucher')

        selectElement.addEventListener('change', function() {
            const voucherValue = this.options[this.selectedIndex].getAttribute('data-voucher');
            max_voucher.value = voucherValue;
        });
    </script>
    
@endpush
