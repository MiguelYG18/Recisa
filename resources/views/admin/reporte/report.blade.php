<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Reporte de Usuarios</title>
    <link rel="stylesheet" href="{{('public/assets/css/style.css')}}" media="all">
</head>

<body>
    <header class="clearfix">
        <div id="logo">
            <img src="public/assets/img/logo.png" alt="Logo" style=" width: 90px; height: 90px;">
        </div>
        <div id="company" class="clearfix">
            <div><h2>CENTRO DE SALUD DE SANTA ROSA DE OCOCA</h2></div>
            <div>CENTRO MÉDICO</div>
            <div>Concepción-Santa Rosa</div>
            <div>12200</div>
        </div>
            <br>
        <div id="project">
            <div><span>Administrador: </span>{{Auth::user()->names}}</div>
        </div>
        <div id="project2">
            <div><span>FECHA: </span>{{ date('d/m/Y') }}</div>
        </div>
    </header>
    <main>
        <p>Usuarios</p>
        <table>
            <thead>
                <tr>
                    <th class="qty">DNI</th>
                    <th class="desc">Nombre</th>
                    <th class="desc">Apellidos</th>
                    <th class="qty">Celular</th>
                    <th class="desc">Email</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user) 
                    <tr>
                        <td>{{ $user->dni }}</td>
                        <td>{{ $user->names }}</td>
                        <td>{{ $user->surnames }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ $user->email }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>  
    </main>
    <footer>

    </footer>
</body>

</html>