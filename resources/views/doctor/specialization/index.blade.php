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
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header py-3">
                        <p class="text-primary m-0 fw-bold">Especialidades a Cargo</p>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive table" id="dataTable-2" role="grid" aria-describedby="dataTable_info">
                            <table id="especialidades" class="table my-0">
                                <thead>
                                    <tr>
                                        <th style="width: 20px; font-weight:bold; text-align:center">#</th>
                                        <th style="width: 250px; text-align:center;">Especialidad</th>
                                        <th style="width: 150px; text-align:center;">Cupos disponibles</th>
                                        <th style="width: 150px; text-align:center;">Total de Citas</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($asignaciones as $index=>$value)
                                        <tr>
                                            <td class="text-center">{{$index + 1}}</td>
                                            <td class="text-center">{{$value->specialization->name}}</td>
                                            <td class="text-center">{{$value->cupo_doctor}}</td>
                                            <td class="text-center">{{$value->appointment_count}}</td>
                                        </tr>                                      
                                    @endforeach
                                </tbody>                                
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="text-primary fw-bold m-0">Avance de Atención</h6>
                    </div>
                    <div class="card-body">
                        @foreach ($asignaciones as $asignacion)
                            <h4 class="small fw-bold">{{$asignacion->specialization->name}}<span class="float-end">20%</span></h4>
                            <div class="progress progress-sm mb-3">
                                <div class="progress-bar bg-success" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%;">
                                    <span class="visually-hidden">20%</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>            
        </div>   
    @endsection
    @push('js')
        <script>
            $('#especialidades').DataTable({
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
                    "info": "Mostrando la página _PAGE_ de _PAGES_ de _TOTAL_ especialidades a cargo",
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