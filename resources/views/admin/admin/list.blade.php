@extends('layouts.app')
@section('title','Usuarios')
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
        <div class="d-sm-flex justify-content-between align-items-center mb-4">
            
            <a class="btn btn-primary btn-sm d-none d-sm-inline-block" target="_blank" role="button" href="{{url('admin/admin/reporte')}}" style="--bs-primary: #00486E;--bs-primary-rgb: 0,72,110;--bs-body-bg: #00486E;background: #00486E;">
                <i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Generar Reporte
            </a>
        </div>
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header py-3">
                        <p class="text-primary m-0 fw-bold">Lista de Usuarios</p>
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
                                        <th style="width: 100px;">Rol</th>
                                        <th style="width: 150px;">Estado</th>
                                        <th style="width: 300px;">Creación</th>
                                        <th class="text-center">Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>
                                                <div class="nav-item dropdown no-arrow">
                                                    @if ($user->image == null)
                                                        <img id="avatar-img" src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="Admin"   name="image" class="rounded-circle p-1 bg-primary" width="110" style="max-width: 100px; height: 100px; border-radius: 50%; object-fit: cover;">
                                                    @else
                                                        <img class="border rounded-circle img-profile" src="{{url('public/storage/perfiles/' .$user->image)}}" alt="{{$user->names}}" style="max-width: 80px; height: 80px;">
                                                    @endif
                                                </div>
                                            </td>
                                            <td>{{$user->dni}}</td>
                                            <td>{{$user->names}}, {{$user->surnames}}</td>
                                            <td>{{$user->phone}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>
                                                @switch($user)
                                                    @case($user->user_level == 1)
                                                        Admin
                                                        @break
                                                    @case($user->user_level == 2)
                                                        Secretaria
                                                        @break
                                                    @case($user->user_level == 3)
                                                        Doctor
                                                        @break    
                                                    @default                                                   
                                                @endswitch
                                            </td>
                                            <td> 
                                                @if ($user->status == 1)
                                                    <span class="fw-bolder p-1 rounded bg-success text-white">Activo</span>
                                                @else
                                                    <span class="fw-bolder p-1 rounded bg-danger text-white">Desactivado</span>
                                                @endif
                                            </td>
                                            <td>{{date('d-m-Y', strtotime($user->created_at))}}</td>
                                            <td class="text-center">
                                                <div class="btn-group" role="group">
                                                    <a href="{{ url('admin/admin/edit/' . $user->slug) }}" class="btn btn-primary" style="background: #7BDE7C;"><i class="fas fa-pencil-alt"></i></a>
                                                    <button type="button" class="btn btn-danger" style="background: #EB5C5E;" data-bs-toggle="modal" data-bs-target="#staticBackdrop-{{$user->id}}">
                                                        <i class="far fa-trash-alt"></i>
                                                    </button>
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="staticBackdrop-{{$user->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Desea Eliminar el Usuario</h1>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    El usuario {{$user->names}} debe ser informado después de haber realizado esta acción.
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                                    <a href="{{url('admin/admin/delete/'.$user->id)}}" class="btn btn-danger"style="background: #EB5C5E;">
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