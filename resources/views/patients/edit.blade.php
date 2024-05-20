@extends('layouts.app')
@section('title','Editar Paciente')
    @push('css')
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
        <!--JQuery-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>             
    @endpush

    @section('content')
        <div class="row">
            <div class="col-8" style="margin-top: 20px; margin-left:auto; margin-right:auto;">
                <div class="card shadow">
                    <div class="card-header py-3">
                        <p class="text-primary m-0 fw-bold">Formulario del Paciente - {{$patient->names}}</p>
                    </div>
                    <div class="card-body">
                        <div class="col-md-12">
                            @if ($errors->hasAny(['dni', 'names', 'surnames', 'phone', 'age']))
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
                        <form action="{{ url('/admin/patients/edit/'.$patient->slug) }}" method="post">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-2">
                                    <label for="dni" class="form-label">DNI:</label>
                                    <input readonly class="form-control" type="text" name="dni" id="dni" value="{{old('dni',$patient->dni)}}">
                                </div>
                                <div class="col-md-3">
                                    <label for="names" class="form-label">Nombres:</label>
                                    <input readonly class="form-control" type="text" name="names" id="names" value="{{old('names',$patient->names)}}">
                                </div>
                                <div class="col-md-4">
                                    <label for="surnames" class="form-label">Apellido:</label>
                                    <input readonly class="form-control" type="text" name="surnames" id="surnames" value="{{old('surnames',$patient->surnames)}}">
                                </div>
                                <div class="col-md-3" style="width:15% !important">
                                    <label for="phone" class="form-label">Celular:</label>
                                    <input class="form-control" maxlength="9" minlength="9" type="text" name="phone" id="phone" value="{{old('phone',$patient->phone)}}">
                                </div>
                                <div class="col-md-3" style="width:8% !important">
                                    <label for="age" class="form-label">Edad:</label>
                                    <input class="form-control" type="text" name="age" id="age" value="{{old('age',$patient->age)}}">
                                </div>
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary" style="background-color: #00476D !important;">Guardar</button>
                                </div>                                
                            </div>
                        </form>                            
                    </div>
                </div>
            </div>
        </div> 
    @endsection
    @push('js')
        <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
        <script>
            $('#phone,#age').on('input', function () {
                this.value = this.value.replace(/\D/g, '');
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