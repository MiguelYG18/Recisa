@extends('layouts.app')
@section('title', 'Especialidades')
@push('css')
    <!--Alertas-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
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
        <div class="col-md-4" style="margin-top: 20px;">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="text-primary fw-bold m-0">Registrar Especialidad</h6>
                </div>
                <div class="card-body">
                    <div class="col-md-12">
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert" id="auto-close-alert">
                                <i class="fa-solid fa-circle-exclamation"></i>
                                {{ implode(' ', $errors->all()) }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            <script>
                                // Después de 2 segundos (2000 ms), cierra la alerta automáticamente
                                setTimeout(function() {
                                    var alert = document.getElementById("auto-close-alert");
                                    if (alert) {
                                        var alertInstance = new bootstrap.Alert(alert);
                                        alertInstance.close();
                                    }
                                }, 3500); // 2000 milisegundos = 2 segundos
                            </script>
                        @endif
                    </div>
                    <form action="" method="post">
                        {{ csrf_field() }}
                        <div class="row g-3">
                            <div class="col-md-7">
                                <div class="mb-3">
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon3">Nombre</span>
                                        <input type="text" class="form-control" maxlength="30" id="basic-url"
                                            name="name_insert" aria-describedby="basic-addon3 basic-addon4"
                                            value="{{ old('name_insert') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="input-group mb-3">
                                    <label class="input-group-text" for="quantity_voucher">Cupos</label>
                                    <select title="...." data-style="btn-secondary" data-size="3"
                                        class="form-control selectpicker show-tick" id="quantity_voucher_insert"
                                        name="quantity_voucher_insert">
                                        <option value="1"
                                            {{ old('quantity_voucher_insert') == '1' ? 'selected' : '' }}>1</option>
                                        <option value="2"
                                            {{ old('quantity_voucher_insert') == '2' ? 'selected' : '' }}>2</option>
                                        <option value="3"
                                            {{ old('quantity_voucher_insert') == '3' ? 'selected' : '' }}>3</option>
                                        <option value="4"
                                            {{ old('quantity_voucher_insert') == '4' ? 'selected' : '' }}>4</option>
                                        <option value="5"
                                            {{ old('quantity_voucher_insert') == '5' ? 'selected' : '' }}>5</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-primary" style="background-color: #00476D !important;">Guardar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8" style="margin-top: 20px;">
            <div class="card shadow">
                <div class="card-header py-3">
                    <p class="text-primary m-0 fw-bold">Lista de Especialidades</p>
                </div>
                <div class="card-body">
                    <div class="table-responsive table mt-2" id="dataTable-1" role="grid"
                        aria-describedby="dataTable_info">
                        <table class="table my-0" id="especialidades">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Cupos</th>
                                    <th>Creado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $count = 1; // Inicializamos el contador
                                @endphp
                                @foreach ($specializations as $index => $value)
                                    <tr data-id="{{ $value->id }}">
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $value->name }}</td>
                                        <td>
                                            <form action="{{ url('admin/specialization/edit/' . $value->id) }}" method="post">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="specialization_id" value="{{ $value->id }}">
                                                <input type="text" class="form-control quantity_voucher_update_input" style="width: 50px;" maxlength="2"
                                                    id="quantity_voucher_update" name="quantity_voucher_update" aria-describedby="basic-addon3 basic-addon4"
                                                    value="{{ old('quantity_voucher_update', $value->quantity_voucher) }}">
                                            </form>
                                        </td>
                                        <td>{{ date('d-m-Y', strtotime($value->created_at)) }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button type="button" class="btn btn-primary edit-btn" style="background: #7BDE7C;">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </button>
                                                <button type="button" class="btn btn-danger" style="background: #EB5C5E;" data-bs-toggle="modal" data-bs-target="#delete-{{ $value->id }}">
                                                    <i class="far fa-trash-alt"></i>
                                                </button>
                                                <!-- Modal Delete-->
                                                <div class="modal fade" id="delete-{{ $value->id }}"
                                                    data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="staticBackdropLabel">
                                                                    Desea Eliminar la Especialidad</h1>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                La especialización {{ $value->name }} será eliminadan.
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Cancelar</button>
                                                                <a href="{{ url('admin/specialization/delete/' . $value->id) }}"
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
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
    <script>
        $('#especialidades').DataTable({
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
                "paginate": {
                    "next": ">",
                    "previous": "<"
                }
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.edit-btn').click(function() {
                var row = $(this).closest('tr');
                var id = row.data('id');
                var form = row.find('form');
                var input = row.find('.quantity_voucher_update_input');

                if (!input.val().trim()) {
                    showModal('Ingrese la cantidad para los cupos');
                    return; 
                }
                
                if (isNaN(input.val()) || input.val() < 1 || input.val() > 20) {
                    showModal('La especialidad debe tener mínimo 1 cupo o máximo 20');
                    return;
                }
              
                form.attr('action', '{{ url("admin/specialization/edit/") }}/' + id);
                form.submit();
            });
        function showModal(message, icon = "error") {
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
                });
            }
        });
        $(document).on("keypress", ":input:not(textarea)", function(event) {
            if (event.which == 13) {
                event.preventDefault();
            }
        });
        $('#quantity_voucher_update').on('input', function () {
            this.value = this.value.replace(/\D/g, '');
        });
    </script>
@endpush
