@extends('layouts.app')
@section('title','Roles')
    @push('css')
        <!--Alertas-->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header py-3">
                    <p class="text-primary m-0 fw-bold">Lista de Roles</p>
                </div>
                <div class="card-body">
                    <div class="table-responsive table" id="dataTable-2" role="grid" aria-describedby="dataTable_info">
                        <table class="table my-0" id="dataTable">
                            <thead>
                                <tr>
                                    <th style="width: 20px;">#</th>
                                    <th style="width: 250px;">Nivel de Usuario</th>
                                    <th style="width: 200px;">Estado</th>
                                    <th style="width: 200px;">NÚmero de usuarios</th>
                                    <th style="width: 200px;">Creación</th>
                                    <th class="text-center">Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $count = 1; // Inicializamos el contador
                                @endphp
                                @foreach ($roles as $index=>$value)
                                    <tr>
                                        <td>{{$index + 1}}</td>
                                        <td>
                                            @switch($value)
                                                @case($value->group_level == 1)
                                                    Admin
                                                    @break
                                                @case($value->group_level == 2)
                                                    Secretaria
                                                    @break
                                                @case($value->group_level == 3)
                                                    Doctor
                                                    @break    
                                                @default                                                   
                                            @endswitch
                                        </td>
                                        <td> 
                                            @if ($value->group_status == 1)
                                                <span class="fw-bolder p-1 rounded bg-success text-white">Activo</span>
                                            @else
                                                <span class="fw-bolder p-1 rounded bg-danger text-white">Desactivado</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @switch($value)
                                                @case($value->group_level == 1)
                                                    {{$admin}}
                                                    @break
                                                @case($value->group_level == 2)
                                                    {{$secretary}}
                                                    @break
                                                @case($value->group_level == 3)
                                                    {{$doctor}}
                                                    @break      
                                                @default                                                   
                                            @endswitch
                                        </td>
                                        <td>{{date('d-m-Y', strtotime($value->created_at))}}</td>
                                        <td class="text-center">
                                            <div class="btn-group" role="group">
                                                <a href="{{url('admin/rol/edit/'.$value->slug)}}" class="btn btn-primary" style="background: #7BDE7C;"><i class="fas fa-pencil-alt"></i></a>
                                                <button type="button" class="btn btn-danger" style="background: #EB5C5E;" data-bs-toggle="modal" data-bs-target="#staticBackdrop-{{$value->id}}">
                                                    <i class="far fa-trash-alt"></i>
                                                </button>
                                               <!-- Modal -->
                                                <div class="modal fade" id="staticBackdrop-{{$value->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Desea Eliminar el Rol</h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Esto afectara a los usuarios que estan relacionados directamente con este rol.
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                                <a href="{{url('admin/rol/delete/'.$value->id)}}" class="btn btn-danger"style="background: #EB5C5E;">
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
    @endpush