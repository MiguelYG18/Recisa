@extends('layouts.app')
@section('title','Crear Usuario')
    @push('css')
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
        <!--Alertas-->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>    
    @endpush

    @section('content')
        <div class="d-sm-flex justify-content-between align-items-center mb-4">
            <h3 class="text-dark mb-0">Crear Usuario</h3>
        </div>        
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header py-3">
                        <p class="text-primary m-0 fw-bold">Formulario del Usuario</p>
                    </div>
                    <div class="card-body">
                        <div class="col-md-12">
                            <label for="documento" class="form-label">CONSULTA DE DNI:</label>
                            <div class="input-group mb-3">
                                <input  type="text" maxlength="8" minlength="8" id="documento" class="form-control" placeholder="Ingrese el DNI" aria-label="Ingrese el DNI" aria-describedby="button-addon2">
                                <button class="btn btn-outline-secondary" type="button" id="buscar">Buscar</button>
                            </div>
                        </div>
                        <form action="" method="post" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label for="dni" class="form-label">DNI:</label>
                                    <input readonly class="form-control" type="text" name="dni" id="dni" value="{{old('dni')}}">
                                    @error('dni')
                                        <small class="text-danger">{{'*'.$message}}</small>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="names" class="form-label">Nombres:</label>
                                    <input readonly class="form-control" type="text" name="names" id="names" value="{{old('names')}}">
                                    @error('names')
                                        <small class="text-danger">{{'*'.$message}}</small>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="surnames" class="form-label">Apellido:</label>
                                    <input readonly class="form-control" type="text" name="surnames" id="surnames" value="{{old('surnames')}}">
                                    @error('surnames')
                                        <small class="text-danger">{{'*'.$message}}</small>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="phone" class="form-label">Celular:</label>
                                    <input class="form-control" maxlength="9" autocomplete="off" minlength="9" type="text" name="phone" id="phone" value="{{old('phone')}}">
                                    @error('phone')
                                        <small class="text-danger">{{'*'.$message}}</small>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="email" class="form-label">Email:</label>
                                    <input class="form-control" type="text" autocomplete="off" name="email" id="email" value="{{old('email')}}">
                                    @error('email')
                                        <small class="text-danger">{{'*'.$message}}</small>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="role" class="form-label">Rol:</label>
                                    <select title="Seleccione el rol..." name="user_level" id="user_level" data-style="btn-secondary" data-size="2" class="form-control selectpicker show-tick">
                                        @foreach ($rol as $item)
                                            <option value="{{$item->group_level}}" {{old('user_level') == $item->group_level ? 'selected':''}}>
                                                @switch($item)
                                                    @case($item->group_level == 1)
                                                        Admin
                                                        @break
                                                    @case($item->group_level == 2)
                                                        Secretaria
                                                        @break
                                                    @case($item->group_level == 3)
                                                        Doctor
                                                        @break   
                                                    @default
                                                @endswitch
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('user_level')
                                        <small class="text-danger">{{'*'.$message}}</small>
                                    @enderror
                                </div>                                
                                <div class="col-md-6">
                                    <label for="password" class="form-label">Contraseña:</label>
                                    <input class="form-control" type="text" autocomplete="off" name="password" id="password" value="">
                                    @error('password')
                                        <small class="text-danger">{{'*'.$message}}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="password_confirm" class="form-label">Confirmar Contraseña:</label>
                                    <input class="form-control" type="text" autocomplete="off" name="password_confirm" id="password_confirm" value="">
                                    @error('password_confirm')
                                        <small class="text-danger">{{'*'.$message}}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="status" class="form-label">Estado:</label>
                                    <select title="Seleccione el estado..." name="status" id="status" data-style="btn-secondary" data-size="2" class="form-control selectpicker show-tick">
                                        <option value="0" {{old('status') == '0' ? 'selected' : ''}}>Desactivado</option>
                                        <option value="1" {{old('status') == '1' ? 'selected' : ''}}>Activado</option> 
                                    </select>
                                    @error('status')
                                        <small class="text-danger">{{'*'.$message}}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="image" class="form-label">Imagen:</label>
                                    <input type="file" name="image" id="image" class="form-control" accept="image/*">
                                    @error('image')
                                        <small class="text-danger">{{'*'.$message}}</small>
                                    @enderror
                                </div>
                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div> 
    @endsection

    @push('js')
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
        <script>
        // Función para realizar la búsqueda
            function buscarDNI() {
                var dni = $('#documento').val();
                // Validar longitud del DNI
                if (dni.length !== 8) {
                    showModal('El DNI debe tener 8 dígitos');
                }
                if (!dni.trim()) {
                    showModal('Por favor, ingrese el DNI');
                }

                $.ajax({
                    url: '{{ url('/admin/admin/add-consulta') }}', // Ruta para la consulta del DNI
                    type: 'POST',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'dni': dni
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.numeroDocumento == dni) {
                            var nombreCompleto = response.apellidoPaterno + ' ' + response.apellidoMaterno;
                            $('#surnames').val(nombreCompleto);
                            $('#names').val(response.nombres);
                            $('#dni').val(response.numeroDocumento);
                            $('#documento').val('');
                        }
                    }
                });
            }

            // Asociar evento click al botón #buscar
            $('#buscar').click(buscarDNI);

            // Asociar evento de teclado al campo #dni
            $('#documento').keypress(function(event) {
                // Verificar si la tecla presionada es Enter (código 13)
                if (event.which == 13) {
                    buscarDNI(); // Llamar a la función de búsqueda
                }
            });
            function showModal(message,icon="error"){
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
            $('#documento,#phone').on('input', function () {
                this.value = this.value.replace(/\D/g, '');
            });
        </script>
    @endpush