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
        <div class="d-sm-flex justify-content-between align-items-center mb-4">
            <h3 class="text-dark mb-0">Citas</h3>
            <a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" href="#" style="--bs-primary: #00486E;--bs-primary-rgb: 0,72,110;--bs-body-bg: #00486E;background: #00486E;">
                <i class="fas fa-user fa-sm text-white-50"></i>&nbsp;Crear Cita
            </a>
        </div>
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header py-3">
                        <p class="text-primary m-0 fw-bold">Lista de Citas</p>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive table" id="dataTable-2" role="grid" aria-describedby="dataTable_info">
                            <table id="usuarios" class="table my-0">
                                <thead>
                                    <tr>
                                        <th style="width: 20px;">Foto</th>
                                        <th style="width: 250px;">DNI</th>
                                        <th style="width: 300px;">Usuario</th>
                                        <th style="width: 250px;">Celular</th>
                                        <th style="width: 300px;">Email</th>
                                        <th style="width: 150px;">Rol</th>
                                        <th style="width: 200px;">Estado</th>
                                        <th style="width: 200px;">Creación</th>
                                        <th class="text-center">Opciones</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>   
    @endsection
    @push('js')
        <script>
            $('#usuarios').DataTable({
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
                    "info": "Mostrando la página _PAGE_ de _PAGES_ de _TOTAL_ usuarios",
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