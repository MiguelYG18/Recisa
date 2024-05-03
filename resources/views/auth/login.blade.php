<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>RECISA| Login</title>
    <link rel="stylesheet" href="{{('public/assets/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="{{('public/assets/fonts/fontawesome-all.min.css')}}">
    <link rel="stylesheet" href="{{('public/assets/css/Footer-Basic-icons.css')}}">
    <link rel="icon" href="{{ url('public/assets/img/escudo.png') }}">
</head>

<body class="bg-gradient-primary" style="background: radial-gradient(#007ea7 0%, #1a4669 100%), #007ea7;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9 col-lg-12 col-xl-10">
                <div style="margin-top: 50px;height: 100px;text-align: center;"><img src="public/assets/img/PCM-Salud.webp" width="266" height="56" style="float: left;text-align: center;box-shadow: 5px 5px 20px #fff;"></div>
                <div class="card shadow-lg o-hidden border-0 my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-flex">
                                <div class="flex-grow-1 bg-login-image" style="background-image: url(&quot;public/assets/img/dogs/Red%20de%20Salud.png&quot;);"></div>
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h3 class="text-dark mb-4" style="font-weight: bold;">INICIO DE SESIÓN</h3>
                                        @if ($errors->any())
                                            @foreach ($errors->all() as $item)
                                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                    <i class="fa-solid fa-circle-exclamation"></i> {{$item}}
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>
                                            @endforeach
                                        @endif 
                                    </div>
                                    <form method="post" action="{{url('login')}}" class="user">
                                        {{ csrf_field() }} 
                                        <div class="mb-3"><input class="form-control form-control-user" maxlength="8" type="text" id="dni" aria-describedby="emailHelp" placeholder="DNI" name="dni" value="{{ session('dni') ? session('dni') : '' }}"></div>
                                        <div class="mb-3"><input class="form-control form-control-user" type="password" id="password" placeholder="Contraseña" name="password"></div>
                                        <div class="mb-3">
                                            <div class="custom-control custom-checkbox small">
                                                <div class="form-check">
                                                    <input class="form-check-input custom-control-input" type="checkbox" id="remember" name="remember">
                                                    <label class="form-check-label custom-control-label" for="remember" style="">Recordar</label>
                                                </div>
                                            </div>
                                        </div><button class="btn btn-primary d-block btn-user w-100" type="submit" style="background: #1a4669 !important; font-size: 16px;font-weight:700px" onmouseover="this.style.boxShadow='2px 2px 10px #405157'" onmouseout="this.style.boxShadow='none'">Acceder</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{url('public/assets/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{url('public/assets/js/theme.js')}}"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script>
        $('#dni').on('input', function () {
            this.value = this.value.replace(/\D/g, '');
        });
    </script>
</body>

</html>