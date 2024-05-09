@extends('layouts.app')
@section('title', 'Doctor-Especialidad')
    @push('css')
        <style>
            .custom-tooltip-class{
                --bs-tooltip-bg: var(--bs-primary);
            }
        </style>
    @endpush
    @section('content')
    <div class="row">
        <div class="col-8" style="margin-top: 20px;">
            <div class="card shadow">
                <div class="card-header py-3">
                    <p class="text-primary m-0 fw-bold">Cupos por Médico</p>
                </div>
                <div class="card-body">
                    <div class="table-responsive table mt-2" id="dataTable-1" role="grid" aria-describedby="dataTable_info">
                        <table class="table my-0" id="dataTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Especialidad</th>
                                    <th>Cantidad de pacientes</th>
                                    <th>Cupos Disponibles</th>
                                    <th>Pacientes</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($specialization as $index)
                                    <tr>
                                        <td>1</td>
                                        <td>{{$index->specialization_name}}</td>
                                        <td class="text-center">
                                            <a href="#" class="btn rounded bg-warning"
                                                data-bs-toggle="tooltip" 
                                                data-bs-placement="right"                                                 
                                                data-bs-title="{{$index->Total_Appointments}}"
                                                data-bs-custom-class="custom-tooltip-class">
                                                <i class="fa-solid fa-bed-pulse"></i>
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            @if ($index->cupo_doctor == 0)
                                                <a href="#" class="btn btn-danger rounded"
                                                    data-bs-toggle="tooltip" 
                                                    data-bs-placement="right" 
                                                    data-bs-title="{{$index->cupo_doctor}}"
                                                    data-bs-custom-class="custom-tooltip-class">
                                                    <i class="fa-solid fa-circle-exclamation"></i>
                                                </a>
                                            @else
                                                <a href="#" class="btn btn-success rounded"
                                                    data-bs-toggle="tooltip" 
                                                    data-bs-placement="right" 
                                                    data-bs-title="{{$index->cupo_doctor}}"
                                                    data-bs-custom-class="custom-tooltip-class">
                                                    <i class="fa-regular fa-calendar-check"></i>
                                                </a>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a href="#" class="btn btn-primary" style="background: #dcde7b;">
                                                <i class="fa-solid fa-eye"></i>
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
    <script>
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    </script>
    @endpush
