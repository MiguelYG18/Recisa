@extends('layouts.app')
@section('title','Citas')
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
        @endif   

        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header py-3">
                        <p class="text-primary m-0 fw-bold">Lista de Citas</p>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive table" id="dataTable-2" role="grid" aria-describedby="dataTable_info">
                            <table id="citas" class="table my-0">
                                <thead>
                                    <tr>
                                        <th style="width: 20px; font-weight:bold; text-align:center">#</th>
                                        <th style="width: 250px;">Paciente</th>
                                        <th style="width: 300px;">Doctor</th>
                                        <th style="width: 250px;">Especialidad</th>
                                        <th style="width: 300px;">Fecha</th>
                                        <th style="width: 150px;">Hora</th>
                                        <th style="width: 150px;">Estado</th>
                                        <th class="text-center">Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($appointments as $index=>$appointment)
                                        <tr>
                                            <td>{{$index + 1}}</td>
                                            <td>{{$appointment->patient->names}} {{$appointment->patient->surnames}}</td>
                                            <td>{{$appointment->doctor->user->names}} {{$appointment->doctor->user->surnames}}</td>
                                            <td>{{$appointment->doctor->specialization->name}}</td>
                                            <td>{{date('d-m-Y', strtotime($appointment->date))}}</td>
                                            <td>{{$appointment->time}}</td>
                                            <td class="text-center">
                                                @switch($appointment->status)
                                                    @case(0)
                                                        <span class="fw-bolder p-1 rounded border border-warning border-2">Por atender</span>
                                                        @break
                                                    @case(1)
                                                        <span class="fw-bolder p-1 rounded border border-success border-2">Atendido</span>
                                                        @break
                                                    @case(2)
                                                        <span class="fw-bolder p-1 rounded border border-danger border-2">No Asistio</span>
                                                        @break
                                                    @default
                                                @endswitch
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="{{url('recisa/appoitnment/show/'.$appointment->id)}}" class="btn btn-primary" style="background: #48C9B0 !important;"><i class="fa-solid fa-eye"></i></a>
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
        <script>
            $('#citas').DataTable({
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
                    "info": "Mostrando la página _PAGE_ de _PAGES_ de _TOTAL_ citas",
                    "infoEmpty": "No hay registros disponibles",
                    "infoFiltered": "(filtrado de _MAX_ registros totales)",
                    "search": "Buscar:",
                    "emptyTable": "No hay datos disponibles en la tabla",
                    "paginate":{
                        "next":">",
                        "previous":"<"
                    }
                }
            });
        </script>    
    @endpush