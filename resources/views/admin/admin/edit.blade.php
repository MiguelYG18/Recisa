@extends('layouts.app')
@section('title','Editar Usuario')
    @push('css')
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
        <!--JQuery-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>             
    @endpush

    @section('content')
        <div class="row">
            <div class="col-md-8" style="margin-top: 20px;">
                <div class="card shadow">
                    <div class="card-header py-3">
                        <p class="text-primary m-0 fw-bold">Formulario del Usuario - {{$user->names}}</p>
                    </div>
                    <div class="card-body">
                        <div class="col-md-12">
                            @if ($errors->hasAny(['dni', 'names', 'surnames', 'phone', 'email', 'status', 'user_level', 'password', 'password_confirm']))
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
                        <form action="{{ url('/admin/admin/edit/'.$user->slug) }}" method="post">
                            {{csrf_field()}}
                            <div class="row g-3">
                                <div class="col-md-2">
                                    <label for="dni" class="form-label">DNI:</label>
                                    <input readonly class="form-control" type="text" name="dni" id="dni" value="{{old('dni',$user->dni)}}">
                                </div>
                                <div class="col-md-3">
                                    <label for="names" class="form-label">Nombres:</label>
                                    <input readonly class="form-control" type="text" name="names" id="names" value="{{old('names',$user->names)}}">
                                </div>
                                <div class="col-md-4">
                                    <label for="surnames" class="form-label">Apellido:</label>
                                    <input readonly class="form-control" type="text" name="surnames" id="surnames" value="{{old('surnames',$user->surnames)}}">
                                </div>
                                <div class="col-md-3">
                                    <label for="phone" class="form-label">Celular:</label>
                                    <input class="form-control" maxlength="9" minlength="9" type="text" name="phone" id="phone" value="{{old('phone',$user->phone)}}">
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email:</label>
                                    <input class="form-control" type="text" name="email" id="email" value="{{old('email',$user->email)}}">
                                </div>
                                <div class="col-md-3">
                                    <label for="status" class="form-label">Estado:</label>
                                    <select title="Seleccione el estado..." data-style="btn-secondary" name="status" id="status" data-size="2" class="form-control selectpicker show-tick">
                                        <option value="0"  {{ old('status') == '0' || $user->status=='0' ? 'selected' : '' }}>Desactivado</option>
                                        <option value="1"  {{ old('status') == '1' || $user->status=='1' ? 'selected' : '' }}>Activado</option> 
                                    </select>
                                </div>  
                                <div class="col-md-3">
                                    <label for="role" class="form-label">Rol:</label>
                                    <select title="Seleccione el rol..." name="user_level" id="user_level" data-style="btn-secondary" data-size="2" class="form-control selectpicker show-tick">
                                        @foreach ($rol as $item)
                                            @if ($user->user_level == $item->group_level)
                                                <option selected value="{{$item->group_level}}" {{old('user_level') == $item->group_level ? 'selected':''}}>
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
                                            @else
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
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <input type="password" name="password" id="password" class="form-control" placeholder="Password" autocomplete="off">
                                        <button id="show_password" class="btn btn-primary" onclick="mostrarPassword()" type="button" style="background-color: #00476D !important;">
                                            <span class="fa fa-eye-slash icon"></span>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <input type="password" name="password_confirm" id="password_confirm" class="form-control" placeholder="Confirmar password" autocomplete="off">
                                        <button id="show_password_confirm" class="btn btn-primary" onclick="mostrarPasswordConfirm()" type="button" style="background-color: #00476D !important;">
                                            <span class="fa fa-eye-slash icon_confirm"></span>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary" style="background-color: #00476D !important;">Guardar</button>
                                </div>                                
                            </div>
                        </form>                            
                    </div>
                </div>
            </div>
            <div class="col-md-4" style="margin-top: 20px;">
                <div class="card shadow">
                    <div class="card-header py-3">
                        <p class="text-primary m-0 fw-bold">Foto de Perfil</p>
                    </div>
                    <div class="card-body">
                        <div class="col-md-12">
                            @if ($errors->has('image'))
                                @foreach ($errors->all() as $image)
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert" id="auto-close-alert-image">
                                        <i class="fa-solid fa-circle-exclamation"></i> {{$image}}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                    <script>
                                        // Después de 2 segundos (2000 ms), cierra la alerta automáticamente
                                        setTimeout(function() {
                                            var alert = document.getElementById("auto-close-alert-image");
                                            if (alert) {
                                                var alertInstance = new bootstrap.Alert(alert);
                                                alertInstance.close();
                                            }
                                        }, 2500); // 2000 milisegundos = 2 segundos
                                    </script>
                                @endforeach
                            @endif 
                        </div>
                        <div class="row g-3">
                            <form action="{{ url('admin/admin/edit/photo/' . $user->slug) }}" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="d-flex align-items-center justify-content-center position-relative">
                                    <div class="text-center">
                                        @if ($user->image == null)
                                            <img class="rounded-circle mb-3 mt-4" src="https://i.postimg.cc/hjSBbZX4/doctor.png" width="160" height="160">
                                        @else
                                            <img id="avatar-img" src="{{Storage::url('public/perfiles/'.$user->image)}}" name="image" alt="{{$user->name}}" class="rounded-circle p-1 bg-primary" width="160" style="max-width: 160px; height: 160px; border-radius: 50%; object-fit: contain;">
                                        @endif
                                        <input type="file" id="avatar-input" name="image" accept="image/*" style="display: none;">
                                        <label for="avatar-input" class="boton-avatar position-absolute rounded-circle bg-primary" style="width: 40px; height: 40px; bottom: -10px; left: 60%; transform: translateX(-50%); border: 2px solid white;">
                                            <i class="far fa-image text-white" style="line-height: 40px;"></i>
                                        </label>       
                                    </div>                                
                                </div>
                                <div class="col-md-12 text-center mt-3">
                                    <button class="btn btn-primary btn-sm" type="submit" style="background-color: #00476D !important;">
                                        Cambiar Fotografìa
                                    </button>
                                </div>   
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    @endsection
    @push('js')
        <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
        <script>
            $('#phone').on('input', function () {
                this.value = this.value.replace(/\D/g, '');
            });
        </script>
        <script>
            // JavaScript para manejar la carga de imagen
            const avatarInput = document.getElementById('avatar-input');
            const avatarImg = document.getElementById('avatar-img');

            avatarInput.addEventListener('change', function() {
                const file = this.files[0];

                if (file) {
                    const reader = new FileReader();

                    reader.addEventListener('load', function() {
                        avatarImg.src = this.result;
                    });

                    reader.readAsDataURL(file);
                }
            });
        </script>
        <script>
            $(document).ready(function () {
                // Mostrar/ocultar contraseña
                $('#show_password').click(function () {
                    Password('password');
                });

                // Mostrar/ocultar confirmación de contraseña
                $('#show_password_confirm').click(function () {
                    Password_Confirm('password_confirm');
                });

                function Password(inputId) {
                    var cambio = $('#' + inputId);
                    if (cambio.attr('type') == 'password') {
                        cambio.attr('type', 'text');
                        $('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
                    } else {
                        cambio.attr('type', 'password');
                        $('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
                    }
                }
                function Password_Confirm(inputId) {
                    var cambio = $('#' + inputId);
                    if (cambio.attr('type') == 'password') {
                        cambio.attr('type', 'text');
                        $('.icon_confirm').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
                    } else {
                        cambio.attr('type', 'password');
                        $('.icon_confirm').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
                    }
                }
            });
        </script>       
    @endpush