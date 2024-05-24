@extends('Layouts.app')
@section('title', 'Ver Cita')
@push('css')
@endpush
@section('content')
    <div class="row mt-3">
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header py-3">
                    <p class="text-primary m-0 fw-bold">Doctor</p>
                </div>
                <div class="card-body text-center">
                    @if ($appointment->doctor->user->image == null)
                        <img src="https://i.postimg.cc/hjSBbZX4/doctor.png" class="rounded-circle" alt="imagen circular"
                            style="width: 150px; height: 150px; border: 2px solid #00476D !important;">
                    @else
                        <img src="{{ Storage::url('public/perfiles/' . $appointment->doctor->user->image) }}"
                            class="rounded-circle" alt="imagen circular"
                            style="width: 150px; height: 150px; border: 2px solid #00476D !important;">
                    @endif
                    <h5 class="my-3">{{ $appointment->doctor->user->names }}</h5>
                    <p class="text-muted mb-1">{{ $appointment->doctor->user->surnames }}</p>
                    <p class="text-muted mb-4">Especialidad: {{ $appointment->doctor->specialization->name }}</p>
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
                    <div class="d-flex justify-content-center mb-2">
                        @switch($appointment->status)
                            @case(0)
                                <button type="button" class="btn btn-outline-warning ms-1">Por atender</button>
                                @break
                            @case(1)
                                <button type="button" class="btn btn-outline-success ms-1">Atendido</button>
                                @break
                            @case(2)
                                <button type="button" class="btn btn-outline-danger ms-1">No Asistio</button>
                                @break
                            @default
                        @endswitch
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
                                            <th style="width: 1000px;text-align: center !important; font-weight:bold">Número
                                                del Historial</th>
                                            <th style="width: 1000px;text-align: center !important; font-weight:bold">Fecha
                                                de creación</th>
                                            <th style="width: 1000px;text-align: center !important; font-weight:bold">PDF
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($clinical_histories as $clinical_history)
                                        <tr>
                                            <td class="text-center">{{$clinical_history->history_number}}</td>
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
@endpush
