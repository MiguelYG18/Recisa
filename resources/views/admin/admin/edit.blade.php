@extends('layouts.app')
@section('title','Editar Usuario')
    @push('css')
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
        <!--JQuery-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>             
    @endpush

    @section('content')
        <div class="d-sm-flex justify-content-between align-items-center mb-4">
            <h3 class="text-dark mb-0">Editar al Usuario - {{$user->names}}</h3>
        </div>
        <form action="" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
            <div class="row">
                <div class="col-8" style="margin-top: 20px;">
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 fw-bold">Formulario del Usuario</p>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label for="dni" class="form-label">DNI:</label>
                                    <input readonly class="form-control" type="text" name="dni" id="dni" value="{{old('dni',$user->dni)}}">
                                    @error('dni')
                                        <small class="text-danger">{{'*'.$message}}</small>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="names" class="form-label">Nombres:</label>
                                    <input readonly class="form-control" type="text" name="names" id="names" value="{{old('names',$user->names)}}">
                                    @error('names')
                                        <small class="text-danger">{{'*'.$message}}</small>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="surnames" class="form-label">Apellido:</label>
                                    <input class="form-control" type="text" name="surnames" id="surnames" value="{{old('surnames',$user->surnames)}}">
                                    @error('surnames')
                                        <small class="text-danger">{{'*'.$message}}</small>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label for="phone" class="form-label">Celular:</label>
                                    <input class="form-control" maxlength="9" minlength="9" type="text" name="phone" id="phone" value="{{old('phone',$user->phone)}}">
                                    @error('phone')
                                        <small class="text-danger">{{'*'.$message}}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email:</label>
                                    <input class="form-control" type="text" name="email" id="email" value="{{old('email',$user->email)}}">
                                    @error('email')
                                        <small class="text-danger">{{'*'.$message}}</small>
                                    @enderror
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
                                    @error('user_level')
                                        <small class="text-danger">{{'*'.$message}}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="nombre" class="form-label">Contraseña:</label>
                                    <input class="form-control" type="text" name="password" id="password" value="">
                                    @error('password')
                                        <small class="text-danger">{{'*'.$message}}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="nombre" class="form-label">Confirmar Contraseña:</label>
                                    <input class="form-control" type="text" name="password_confirm" id="password_confirm" value="">
                                    @error('password_confirm')
                                        <small class="text-danger">{{'*'.$message}}</small>
                                    @enderror
                                </div>
                                <div class="col-md-9"></div>
                                <div class="col-md-3">
                                    <label for="status" class="form-label">Estado:</label>
                                    <select title="Seleccione el estado..." name="status" id="status" data-style="btn-secondary" data-size="2" class="form-control selectpicker show-tick">
                                        <option value="0"  {{ old('status') == '0' || $user->status=='0' ? 'selected' : '' }}>Desactivado</option>
                                        <option value="1"  {{ old('status') == '1' || $user->status=='1' ? 'selected' : '' }}>Activado</option> 
                                    </select>
                                    @error('status')
                                        <small class="text-danger">{{'*'.$message}}</small>
                                    @enderror
                                </div>                               
                            </div>                            
                        </div>
                    </div>
                </div>
                <div class="col-4" style="margin-top: 20px;">
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 fw-bold">Foto de Perfil</p>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="d-flex align-items-center justify-content-center position-relative">
                                    <div class="text-center">
                                        @if ($item->image != null)
                                            <img id="avatar-img" src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="Admin"   name="image" class="rounded-circle p-1 bg-primary" width="110" style="max-width: 100px; height: 100px; border-radius: 50%; object-fit: contain;">
                                        @else
                                            <img id="avatar-img" src="{{url('public/storage/perfiles/' .$user->image)}}" name="image" alt="{{$user->name}}" class="rounded-circle p-1 bg-primary" width="110" style="max-width: 100px; height: 100px; border-radius: 50%; object-fit: contain;">
                                        @endif
                                        <input type="file" id="avatar-input" name="image" accept="image/*" style="display: none;">
                                        <label for="avatar-input" class="boton-avatar position-absolute rounded-circle bg-primary" style="width: 40px; height: 40px; bottom: -10px; left: 60%; transform: translateX(-50%); border: 2px solid white;">
                                            <i class="far fa-image text-white" style="line-height: 40px;"></i>
                                        </label>       
                                    </div>                                
                                </div>
                                @error('image')
                                    <small class="text-danger text-center">{{'*'.$message}}</small>
                                @enderror 
                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-primary">Actualizar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </form>
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
    @endpush