@extends('Layouts.app')
@section('title', 'Atención')
@push('css')
    <!--Alertas-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
@endpush
@section('content')
    <div class="row mt-3">
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header py-3">
                    <p class="text-primary m-0 fw-bold">Especialidad</p>
                </div>
                <div class="card-body text-center">
                    <p class="text-muted mb-4">{{ $appointment->doctor->specialization->name }}</p>
                </div>
            </div>
            <div class="card mb-4 mb-lg-0">
                <div class="card-header py-3">
                    <p class="text-primary m-0 fw-bold">Detalles de la cita</p>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card mb-4 mb-lg-0">
                                <div class="card-body p-0">
                                    <ul class="list-group list-group-flush rounded-3">
                                        <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                            <i class="fa-regular fa-calendar-check text-success" aria-hidden="true"></i>
                                            <p class="mb-0">{{$appointment->date}}</p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card mb-4 mb-lg-0">
                                <div class="card-body p-0">
                                    <ul class="list-group list-group-flush rounded-3">
                                        <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                            <i class="fa-regular fa-clock text-success" aria-hidden="true"></i>
                                            <p class="mb-0">{{$appointment->time}}</p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-4 mb-lg-0 mt-3">
                <div class="card-header py-3">
                    <p class="text-primary m-0 fw-bold">Estado de la cita</p>
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
                    <div class="d-flex justify-content-center mb-2">
                        @if ($appointment->status == 0)
                            <form action="{{ url('/doctor/attend/edit/' . $appointment->id) }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-stethoscope"></i></span>
                                        <select class="form-select" id="status" name="status">
                                            <option selected>Atención...</option>
                                            <option value="1" {{old('status') == '1' ? 'selected' : ''}}>Atendido</option>
                                            <option value="2" {{old('status') == '1' ? 'selected' : ''}}>No asistio</option>
                                        </select>                                          
                                    </div>
                                    <div id="description-div" style="display: none;">
                                        <label for="exampleFormControlTextarea1" class="form-label">Descripción</label>
                                        <textarea class="form-control" id="description" name="description" style="text-align: left;">
                                            {{old('description')}}
                                        </textarea>
                                    </div>
                                    <div class="col-md-12 text-center mt-3">
                                        <button type="submit" class="btn btn-primary" style="background-color: #00476D !important;">Atender</button>
                                    </div>
                                </div>
                            </form>    
                        @else
                            <button type="button" class="btn btn-outline-success ms-1">Atendido</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header py-3">
                    <p class="text-primary m-0 fw-bold">Paciente</p>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Apellidos y Nombre</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0">{{ $appointment->patient->surnames }},
                                {{ $appointment->patient->names }}</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">DNI</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0">{{ $appointment->patient->dni }}</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Historial Clínico</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0">{{ $appointment->patient->history_number }}</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Celular</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0">{{ $appointment->patient->phone }}</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Edad</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0">{{ $appointment->patient->age }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4 mb-md-0">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 fw-bold">Historial Clínico</p>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive table" id="dataTable-2" role="grid"
                                aria-describedby="dataTable_info">
                                <table id="usuarios" class="table my-0">
                                    <thead>
                                        <tr style="">
                                            <th style="width: 1000px;text-align: center !important; font-weight:bold">Número del Historial</th>
                                            <th style="width: 1000px;text-align: center !important; font-weight:bold">Fecha de creación</th>
                                            <th style="width: 1000px;text-align: center !important; font-weight:bold">PDF</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($clinical_histories as $clinical_history)
                                        <tr>
                                            <td class="text-center">{{$clinical_history->source_pdf}}</td>
                                            <td class="text-center">{{$clinical_history->datetime_created}}</td>
                                            <td class="text-center">
                                                <a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" target="_blank"
                                                    href="{{Storage::url('public/clinical_histories/'.$clinical_history->source_pdf)}}"
                                                    style="--bs-primary: #00486E;--bs-primary-rgb: 0,72,110;--bs-body-bg: #00476D;background: #00476D !important;">
                                                    <i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Ver historial
                                                </a>
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
    </div>
@endsection
@push('js')
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
    <script>
        function toggleTextarea() {
            var selectElement = document.getElementById('status');
            var textareaDivElement = document.getElementById('description-div');
            if (selectElement.value === '2') {
                textareaDivElement.style.display = 'block';
            } else {
                textareaDivElement.style.display = 'none';
            }
        }

        window.onload = function() {
            // Inicializa el estado del div que contiene el textarea cuando se carga la página
            toggleTextarea();
            // Agrega el event listener al select para cambiar la visibilidad del div que contiene el textarea
            document.getElementById('status').addEventListener('change', toggleTextarea);
        };
    </script>
@endpush
