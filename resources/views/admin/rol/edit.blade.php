@extends('layouts.app')
@section('title','Crear Usuario')
    @push('css')
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">  
    @endpush

    @section('content')
        <div class="d-sm-flex justify-content-between align-items-center mb-4">
            <h3 class="text-dark mb-0">Editar el rol - 
                @switch($usergroup)
                    @case($usergroup->group_level == 1)
                        Admin
                        @break
                    @case($usergroup->group_level == 2)
                        Secretaria
                        @break
                    @case($usergroup->group_level == 3)
                        Doctor
                        @break    
                    @default           
                @endswitch
            </h3>
        </div>        
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header py-3">
                        <p class="text-primary m-0 fw-bold">Formulario del Rol</p>
                    </div>
                    <div class="card-body">
                        <form action="" method="post">
                            {{csrf_field()}}
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="group_level" class="form-label">Nivel de Usuario:</label>
                                    <select title="Seleccione el nivel de usuario..." name="group_level" id="group_level" data-style="btn-secondary" data-size="2" class="form-control selectpicker show-tick">
                                        <option value="1" {{old('group_level') == '1' || $usergroup->group_level=='1' ? 'selected' : ''}}>Admin</option>
                                        <option value="2" {{old('group_level') == '2' || $usergroup->group_level=='2' ? 'selected' : ''}}>Secretaria</option> 
                                        <option value="3" {{old('group_level') == '3' || $usergroup->group_level=='3' ? 'selected' : ''}}>Doctor</option>
                                    </select>
                                    @error('group_level')
                                        <small class="text-danger">{{'*'.$message}}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="group_status" class="form-label">Estado:</label>
                                    <select title="Seleccione el estado..." name="group_status" id="group_status" data-style="btn-secondary" data-size="2" class="form-control selectpicker show-tick">
                                        <option value="0" {{old('group_status') == '0' || $usergroup->group_status=='0' ? 'selected' : ''}}>Desactivado</option>
                                        <option value="1" {{old('group_status') == '1' || $usergroup->group_status=='1' ? 'selected' : ''}}>Activado</option> 
                                    </select>
                                    @error('group_status')
                                        <small class="text-danger">{{'*'.$message}}</small>
                                    @enderror
                                </div>
                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-primary">Actualizar</button>
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
    @endpush