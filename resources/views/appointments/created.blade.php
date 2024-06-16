@extends('Layouts.app')
@section('title', 'Crear Cita')
@push('css')
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
    <!--CSS TABLA-->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.bootstrap5.css">
@endpush
@section('content')
    <div class="row mt-3">
        <div class="row">
            <div class="col-md-7">
                <div class="card shadow">
                    <div class="card-header py-3">
                        <p class="text-primary m-0 fw-bold">Formulario de Registro de Citas</p>
                    </div>
                    <div class="card-body">
                        <div class="col-md-12">
                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <i class="mdi mdi-alert-circle"></i> {{ implode(' ', $errors->all()) }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                        </div>
                        <form method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-12 mt-2">
                                    <div class="input-group">
                                        <label class="input-group-text" for="id_area">Reserva</label>
                                        <select name="id_quota" id="id_quota" data-style="btn-secondary"
                                            data-live-search="true" data-size="3" class="form-control selectpicker">
                                            <option value="" disabled selected>Seleccionar</option>
                                            @foreach ($quotas as $quota)
                                                <optgroup label="{{ $quota->user->surnames }}, {{ $quota->user->names }} -> cupos: {{ $quota->cupo_doctor }}">
                                                    <option value="{{ $quota->id }}"
                                                        {{ old('id_quota') == $quota->id ? 'selected' : '' }}
                                                        {{ $quota->cupo_doctor == 0 ? 'disabled' : '' }}>
                                                        {{ $quota->specialization->name}}
                                                    </option>
                                                </optgroup>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <div class="input-group">
                                        <label class="input-group-text" for="id_area">Paciente</label>
                                        <select name="id_patient" id="id_patient" title="Seleccione..."
                                            data-style="btn-secondary" data-live-search="true" data-size="3"
                                            class="form-control selectpicker">
                                            @foreach ($patients as $patient)
                                                <option value="{{ $patient->id }}" {{old('id_patient') == $patient->id ? 'selected':''}}>
                                                    {{ $patient->surnames }},
                                                    {{ $patient->names }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!--Fecha-->
                                <div class="col-md-6 mt-3">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="inputGroup-sizing-default">Fecha</span>
                                        <input readonly type="date" name="date" id="date" class="form-control boder-success"
                                        value="<?php echo date("Y-m-d");?>">
                                    </div>
                                </div>
                                <!--hora-->
                                <div class="col-md-6 mt-3">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="inputGroup-sizing-default">Hora de atención</span>
                                        <input type="time" name="time" id="time" class="form-control boder-success"
                                            value="{{ old('time') }}">
                                    </div>
                                </div>
                                <div class="col-md-12 text-center mt-2">
                                    <button type="submit" class="btn btn-primary me-2"
                                        style="background-color: #00476D !important;">Guardar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card shadow">
                    <div class="card-header py-3">
                        <p class="text-primary m-0 fw-bold">Citas</p>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive table mt-2" id="dataTable-1" role="grid" aria-describedby="dataTable_info">
                            <table class="table my-0" id="asignaciones">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Doctor</th>
                                        <th>Especialides</th>
                                        <th>Ver</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $count = 0; // Inicializamos el contador
                                    @endphp
                                    @foreach ($doctors as $index => $value)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $value->names }} {{ $value->surnames }}</td>
                                                <td>
                                                    <ul class="list-group list-group-flush">
                                                        @foreach ($value->specializations as $specialization)
                                                            <li class="list-group-item">{{ $specialization->specialization->name}}</li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#ver-{{ $value->id }}">
                                                        <i class="fa-solid fa-eye"></i>
                                                    </button>
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="ver-{{ $value->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Citas Registradas para hoy <strong>{{$today}}</strong> del doctor {{$value->names}}</h1>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        @foreach ($value->specializations as $specialization)
                                                                            <div class="col-md-12 text-center">
                                                                                <p class="h3" style="color: #00476D !important;">{{ $specialization->specialization->name}}</p>
                                                                            </div>
                                                                            <div class="col-md-12">
                                                                                <div class="table-responsive table mt-2" id="dataTable-1" role="grid" aria-describedby="dataTable_info">
                                                                                    <table class="table my-0" id="citas-{{$specialization->specialization->id}}">
                                                                                        <thead>
                                                                                            <tr>
                                                                                                <th class="text-center">#</th>
                                                                                                <th class="text-center">Paciente</th>
                                                                                                <th class="text-center">Hora</th>
                                                                                            </tr>
                                                                                        </thead>
                                                                                        <tbody>
                                                                                            @foreach ($specialization->appointment as $index=>$appointment)
                                                                                                @if ($appointment->status == 0 && $appointment->date == $today)
                                                                                                    <tr>
                                                                                                        <td class="text-center">{{$index + 1}}</td>
                                                                                                        <td class="text-center">{{$appointment->patient->surnames}}, {{$appointment->patient->names}}</td>
                                                                                                        <td class="text-center">{{$appointment->time}}</td>
                                                                                                    </tr>  
                                                                                                @endif
                                                                                            @endforeach
                                                                                        </tbody>
                                                                                    </table>
                                                                                </div> 
                                                                            </div>
                                                                        @endforeach
                                                                    </div>                                                                   
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
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
    </div>
@endsection
@push('js')
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
    <script>
        $(document).ready(function() {
            var commonSettings = {
                responsive: true,
                autoWidth: false
            };
            $('#asignaciones').DataTable($.extend({}, commonSettings, {
                "language": {
                    "lengthMenu": 'Mostrar ' +
                        '<select class="custom-select custom-select-sm w-50 form-select form-select-sm mb-3">' +
                            '<option value="5">5</option>' +
                            '<option value="10">10</option>' +
                            '<option value="15">15</option>' +
                            '<option value="20">20</option>' +
                        '</select>',
                    "zeroRecords": "No se encontró nada - lo siento",
                    "info": "Mostrando la página _PAGE_ de _PAGES_ de _TOTAL_ doctores",
                    "infoEmpty": "No hay registros disponibles",
                    "infoFiltered": "(filtrado de _MAX_ registros totales)",
                    "search": "Buscar:",
                    "emptyTable": "No hay datos disponibles en la tabla",
                    "paginate": {
                        "next": ">",
                        "previous": "<"
                    }
                }
            }));
            $('table[id^="citas-"]').each(function() {
                $(this).DataTable($.extend({}, commonSettings, {
                    "language": {
                        "lengthMenu": 'Mostrar ' +
                            '<select class="custom-select custom-select-sm w-50 form-select form-select-sm mb-3">' +
                                '<option value="5">5</option>' +
                                '<option value="10">10</option>' +
                                '<option value="15">15</option>' +
                                '<option value="20">20</option>' +
                            '</select>',
                        "zeroRecords": "No se encontró nada - lo siento",
                        "infoEmpty": "No hay registros disponibles",
                        "info": "Mostrando la página _PAGE_ de _PAGES_ de _TOTAL_ citas",
                        "infoFiltered": "(filtrado de _MAX_ registros totales)",
                        "search": "Buscar:",
                        "emptyTable": "No hay datos disponibles en la tabla",
                        "paginate": {
                            "next": ">",
                            "previous": "<"
                        }
                    }
                }));
            });
        });
    </script>    
@endpush
