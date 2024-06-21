@extends('layouts.app')
@section('title','Pacientes')
    @push('css')
        <!--Alertas-->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <!--CSS TABLA-->
        <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.bootstrap5.css">
   
    @endpush 
    @section('content')
        @if (session('success'))
            <script>
                let message ="{{session('success')}}";
                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
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
        @endif   
        <div class="d-sm-flex align-items-center mb-4" style="justify-content: right;">
            <a class="btn btn-primary btn-sm d-none d-sm-inline-block" target="_blank" role="button" href="{{url('recisa/patients/reporte')}}" style="--bs-primary: #00486E;--bs-primary-rgb: 0,72,110;--bs-body-bg: #00476D;background: #00476D !important;">
                <i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Generar Reporte
            </a>
        </div>
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header py-3">
                        <p class="text-primary m-0 fw-bold">Lista de Pacientes</p>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive table" id="dataTable-2" role="grid" aria-describedby="dataTable_info">
                            <table id="pacientes" class="table my-0">
                                <thead>
                                    <tr style="">
                                        <th style="width: 100px;text-align: center !important; font-weight:bold">DNI</th>
                                        <th style="width: 1000px;text-align: center !important; font-weight:bold">Paciente</th>
                                        <th style="width: 1000px;text-align: center !important; font-weight:bold">Número Historial</th>
                                        <th style="width: 100px;text-align: center !important; font-weight:bold">Celular</th>
                                        <th style="width: 300px;text-align: center !important; font-weight:bold">Fecha de Nacimiento</th>
                                        <th style="width: 300px;text-align: center !important; font-weight:bold">Creación</th>
                                        <th class="title-table" style="width: 300px;text-align: center !important; font-weight:bold">Opciones</th>
                                        <th class="title-table" style="width: 300px;text-align: center !important; font-weight:bold">Reporte</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($patients as $patient)
                                        <tr>
                                            <td>{{$patient->dni}}</td>
                                            <td>{{$patient->names}}, {{$patient->surnames}}</td>
                                            <td class="text-center">{{$patient->history_number}}</td>
                                            <td>{{$patient->phone}}</td>
                                            <td class="text-center">{{$patient->date}}</td>
                                            <td>{{date('d-m-Y', strtotime($patient->created_at))}}</td>
                                            <td class="text-center">
                                                <div class="btn-group" role="group">
                                                    <a href="{{ url('recisa/patients/edit/' . $patient->slug) }}" class="btn btn-primary" style="background: #7BDE7C;"><i class="fas fa-pencil-alt"></i></a>
                                                    <button type="button" class="btn btn-danger" style="background: #EB5C5E;" data-bs-toggle="modal" data-bs-target="#staticBackdrop-{{$patient->id}}">
                                                        <i class="far fa-trash-alt"></i>
                                                    </button>
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="staticBackdrop-{{$patient->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Desea Eliminar el Paciente</h1>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    El paciente {{$patient->names}} debe ser informado después de haber realizado esta acción.
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                                    <a href="{{url('recisa/patients/delete/'.$patient->id)}}" class="btn btn-danger"style="background: #EB5C5E;">
                                                                        Eliminar
                                                                    </a>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> 
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <a href="{{url('recisa/patients/reporte/'.$patient->dni)}}" target="_blank" class="btn btn-primary" style="background: #58D68D !important;"><i class="fa-solid fa-file-pdf"></i></a>                                               
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
        <script>
            $('#pacientes').DataTable({
                responsive: true,
                autoWidth:false,
                "language": {
                    "lengthMenu": "Mostrar "+
                                    `<select class="custom-select custom-select-sm w-50 form-select form-select-sm mb-2">
                                        <option value="5">5</option>
                                        <option value="10">10</option>
                                        <option value="15">15</option>
                                        <option value="20">20</option>
                                    </select>`,
                    "zeroRecords": "No se encontró nada - lo siento",
                    "info": "Mostrando la página _PAGE_ de _PAGES_ de _TOTAL_ pacientes",
                    "infoEmpty": "No hay registros disponibles",
                    "infoFiltered": "(filtrado de _MAX_ registros totales)",
                    "search": "Buscar:",
                    "paginate":{
                        "next":">",
                        "previous":"<"
                    }
                }
            });
        </script>    
    @endpush