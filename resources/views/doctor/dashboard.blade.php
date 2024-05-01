@extends('layouts.app')
@section('title', 'Doctor')
    @push('css')
    @endpush
    @section('content')
    <div class="row">
        <div class="col" style="margin-top: 20px;">
            <div class="card shadow">
                <div class="card-header py-3">
                    <p class="text-primary m-0 fw-bold">Cupos por Médico</p>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 text-nowrap">
                            <div id="dataTable_length-1" class="dataTables_length" aria-controls="dataTable"><label class="form-label">Show&nbsp;<select class="d-inline-block form-select form-select-sm">
                                        <option value="10" selected="">10</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select>&nbsp;</label></div>
                        </div>
                        <div class="col-md-6">
                            <div class="text-md-end dataTables_filter" id="dataTable_filter-1"><label class="form-label"><input type="search" class="form-control form-control-sm" aria-controls="dataTable" placeholder="Search"></label></div>
                        </div>
                    </div>
                    <div class="table-responsive table mt-2" id="dataTable-1" role="grid" aria-describedby="dataTable_info">
                        <table class="table my-0" id="dataTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Paciente</th>
                                    <th>Fecha</th>
                                    <th>Hora</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($appointments as $index => $appointment)
                                    <tr>
                                        <td>1</td>
                                        <td>{{ $appointment->patient->names}}</td>
                                        <td>{{ $appointment->date }}</td>
                                        <td>{{ $appointment->time }}</td>
                                        <td>
                                            @switch($appointment->status)
                                                @case(0)
                                                    <span class="fw-bolder p-1 rounded bg-success text-white">Atentido</span>
                                                    @break
                                                @case(1)
                                                    <span class="fw-bolder p-1 rounded bg-warning text-white">Por atender</span>
                                                    @break
                                                @case(2)
                                                    <span class="fw-bolder p-1 rounded bg-danger text-white">No atendido</span>
                                                    @break
                                                @default                    
                                            @endswitch
                                        </td> 
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-md-6 align-self-center">
                            <p id="dataTable_info-1" class="dataTables_info" role="status" aria-live="polite">Showing 1 to 10 of 27</p>
                        </div>
                        <div class="col-md-6">
                            <nav class="d-lg-flex justify-content-lg-end dataTables_paginate paging_simple_numbers">
                                <ul class="pagination">
                                    <li class="page-item disabled"><a class="page-link" aria-label="Previous" href="#"><span aria-hidden="true">«</span></a></li>
                                    <li class="page-item active" style="color: #00486E;"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" aria-label="Next" href="#"><span aria-hidden="true">»</span></a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col" style="margin-top: 20px;">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="text-primary fw-bold m-0">Cupos por Especialidad</h6>
                </div>
                <div class="card-body">
                    <h4 class="small fw-bold">Medicina General<span class="float-end">20%</span></h4>
                    <div class="progress progress-sm mb-3">
                        <div class="progress-bar bg-danger" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%;"><span class="visually-hidden">20%</span></div>
                    </div>
                    <h4 class="small fw-bold">Odontología<span class="float-end">40%</span></h4>
                    <div class="progress progress-sm mb-3">
                        <div class="progress-bar bg-warning" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%;"><span class="visually-hidden">40%</span></div>
                    </div>
                    <h4 class="small fw-bold">Obstetricia<span class="float-end">60%</span></h4>
                    <div class="progress progress-sm mb-3">
                        <div class="progress-bar bg-primary" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"><span class="visually-hidden">60%</span></div>
                    </div>
                    <h4 class="small fw-bold">Pediatria<span class="float-end">80%</span></h4>
                    <div class="progress progress-sm mb-3">
                        <div class="progress-bar bg-info" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%;"><span class="visually-hidden">80%</span></div>
                    </div>
                    <h4 class="small fw-bold">Psicología<span class="float-end">Complete!</span></h4>
                    <div class="progress progress-sm mb-3">
                        <div class="progress-bar bg-success" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"><span class="visually-hidden">100%</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div> 
    @endsection
    @push('js')
    @endpush
