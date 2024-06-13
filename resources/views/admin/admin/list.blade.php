@extends('layouts.app')
@section('title', 'Usuarios')
@push('css')
    <!--Alertas-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!--CSS TABLA-->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.bootstrap5.css">
@endpush
@section('content')
    @if (session('success'))
        <script>
            let message = "{{ session('success') }}";
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
        <a class="btn btn-primary btn-sm d-none d-sm-inline-block me-4" id="btn-doctores" role="button" data-bs-toggle="modal"
            data-bs-target="#modalDoctores"
            style="--bs-primary: #00486E;--bs-primary-rgb: 0,72,110;--bs-body-bg: #00476D;background: #00476D !important;">
            <i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Generar Reporte Doctores
        </a>
        <a class="btn btn-primary btn-sm d-none d-sm-inline-block" target="_blank" role="button"
            href="{{ url('admin/admin/reporte') }}"
            style="--bs-primary: #00486E;--bs-primary-rgb: 0,72,110;--bs-body-bg: #00476D;background: #00476D !important;">
            <i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Generar Reporte
        </a>
    </div>
    {{-- Modal --}}
    <div class="modal fade" id="modalDoctores" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ url('/recisa/admin/reporte/doctor') }}" method="GET" id="form-doctor" target="_blank">
                    @csrf
                    <input type="hidden" name="quota_id" id="quota_id">
                    <input type="hidden" name="user_id" id="user_id">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Buscar doctores para su reporte</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-12 mt-2">
                            <div class="input-group">
                                <label class="input-group-text" for="id_area">Doctor y Especialidad</label>
                                <select name="id_select" id="id_select" data-style="btn-secondary" data-live-search="true"
                                    data-size="3" class="form-control selectpicker">
                                    <option value="" disabled selected>Seleccionar</option>
                                    @foreach ($quotas as $quota)
                                        <optgroup label="{{ $quota->user->surnames }}, {{ $quota->user->names }}">
                                            <option value="{{ $quota->id }}" data-quota-id="{{ $quota->specialization->id }}"
                                                data-user-id="{{ $quota->user->id }}">
                                                {{ $quota->specialization->name }}
                                            </option>
                                        </optgroup>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" id="realizar" class="btn btn-danger"
                            style="background: #EB5C5E;">Realizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header py-3">
                    <p class="text-primary m-0 fw-bold">Lista de Usuarios</p>
                </div>
                <div class="card-body">
                    <div class="table-responsive table" id="dataTable-2" role="grid" aria-describedby="dataTable_info">
                        <table id="usuarios" class="table my-0">
                            <thead>
                                <tr style="">
                                    <th style="width: 20px;text-align: center !important; font-weight:bold">Foto</th>
                                    <th style="width: 100px;text-align: center !important; font-weight:bold">DNI</th>
                                    <th style="width: 1000px;text-align: center !important; font-weight:bold">Usuario</th>
                                    <th style="width: 100px;text-align: center !important; font-weight:bold">Celular</th>
                                    <th style="width: 300px;text-align: center !important; font-weight:bold">Email</th>
                                    <th style="width: 100px;text-align: center !important; font-weight:bold">Rol</th>
                                    <th style="width: 150px;text-align: center !important; font-weight:bold">Estado</th>
                                    <th style="width: 300px;text-align: center !important; font-weight:bold">Creación</th>
                                    <th class="title-table"
                                        style="width: 300px;text-align: center !important; font-weight:bold">Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>
                                            <div class="nav-item dropdown no-arrow">
                                                @if ($user->image == null)
                                                    <img src="https://i.postimg.cc/hjSBbZX4/doctor.png"
                                                        class="rounded-circle" alt="imagen circular"
                                                        style="width: 80px; height: 80px; border: 2px solid #00476D !important;">
                                                @else
                                                    <img src="{{ Storage::url('public/perfiles/' . $user->image) }}"
                                                        class="rounded-circle" alt="imagen circular"
                                                        style="width: 80px; height: 80px; border: 2px solid #00476D !important;">
                                                @endif
                                            </div>
                                        </td>
                                        <td>{{ $user->dni }}</td>
                                        <td>{{ $user->names }}, {{ $user->surnames }}</td>
                                        <td>{{ $user->phone }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @switch($user->user_level)
                                                @case(1)
                                                    Admin
                                                @break

                                                @case(2)
                                                    Secretaria
                                                @break

                                                @case(3)
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
                                        <td>{{ date('d-m-Y', strtotime($user->created_at)) }}</td>
                                        <td class="text-center">
                                            <div class="btn-group" role="group">
                                                <a href="{{ url('admin/admin/edit/' . $user->slug) }}"
                                                    class="btn btn-primary" style="background: #7BDE7C;"><i
                                                        class="fas fa-pencil-alt"></i></a>
                                                <button type="button" class="btn btn-danger"
                                                    style="background: #EB5C5E;" data-bs-toggle="modal"
                                                    data-bs-target="#staticBackdrop-{{ $user->id }}">
                                                    <i class="far fa-trash-alt"></i>
                                                </button>
                                                <!-- Modal -->
                                                <div class="modal fade" id="staticBackdrop-{{ $user->id }}"
                                                    data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="staticBackdropLabel">
                                                                    Desea
                                                                    Eliminar el Usuario</h1>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                El usuario {{ $user->names }} debe ser informado después
                                                                de haber realizado esta acción.
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Cancelar</button>
                                                                <a href="{{ url('admin/admin/delete/' . $user->id) }}"
                                                                    class="btn btn-danger"style="background: #EB5C5E;">
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
            autoWidth: false,
            "language": {
                "lengthMenu": "Mostrar " +
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
                "emptyTable": "No hay datos disponibles en la tabla",
                "paginate": {
                    "next": ">",
                    "previous": "<"
                }
            }
        });
    </script>
    <script>
        document.getElementById('realizar').addEventListener('click', function() {
            var select = document.getElementById('id_select');
            if (select.value === "" || select.value === null) {
                showModal("Por favor seleccione un doctor y especialidad", "error");
            } else {
                var form = document.getElementById('form-doctor');
                form.submit(); // Envía el formulario
            }
        });

        function showModal(message, icon = "error", callback = null) {
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
                icon: icon,
                title: message
            }).then((result) => {
                if (result.dismiss === Swal.DismissReason.timer && callback) {
                    callback();
                }
            });
        }
    </script>
    <script>
        $(document).ready(function() {
            $('#id_select').on('change', function() {
                var selectedOption = $(this).find('option:selected');
                $('#quota_id').val(selectedOption.data('quota-id'));
                $('#user_id').val(selectedOption.data('user-id'));
            });
        });
    </script>
@endpush
